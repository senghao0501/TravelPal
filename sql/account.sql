-- TravelPal account database
-- Import this file into phpMyAdmin after creating/selecting flight_booking.
-- Existing flight tables remain untouched.

CREATE DATABASE IF NOT EXISTS flight_booking;
USE flight_booking;

CREATE TABLE IF NOT EXISTS accounts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL,
    language VARCHAR(10) NOT NULL DEFAULT 'EN',   -- 🌟 新加的语言栏位
    currency VARCHAR(10) NOT NULL DEFAULT 'MYR',  -- 🌟 新加的货币栏位
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_accounts_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Fallback/demo accounts.
-- Passwords are stored as password_hash values, never plain text.
INSERT INTO accounts (full_name, email, password_hash)
VALUES
    ('Aina Rahman', 'demo@travelpal.my', '$2y$12$utmdcYGLA2mKwdzJRrWNJ./Gpc5j6kItJtCBYa.9d4eSD20uJ77kW'),
    ('Daniel Tan', 'daniel@travelpal.my', '$2y$12$KAkZU9OrPn6qQ8OmKjgpqOxPWcMyfmfxiyt4YF7GIGkkg8jr8TxLi'),
    ('Nur Aisyah', 'aisyah@travelpal.my', '$2y$12$VUUE.pa4fXdogX0e8WcDle/5GKrqOHW4JQ5N43b9UCSgjKOeKLqkS')
ON DUPLICATE KEY UPDATE
    full_name = VALUES(full_name);

-- My Trips / Favorites additions. Import this whole file again, or run only
-- the statements below after the existing accounts table has been created.
CREATE TABLE IF NOT EXISTS trip_favorites (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    item_type ENUM('flight','hotel','restaurant','attraction') NOT NULL,
    item_key VARCHAR(160) NOT NULL,
    title VARCHAR(200) NOT NULL,
    subtitle VARCHAR(255) NOT NULL DEFAULT '',
    image_url TEXT NULL,
    unit_price DECIMAL(10,2) NOT NULL DEFAULT 0,
    metadata JSON NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_trip_favorite (user_id, item_type, item_key),
    CONSTRAINT fk_trip_favorites_account FOREIGN KEY (user_id) REFERENCES accounts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS trip_cart_items (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    item_type ENUM('flight','hotel','attraction') NOT NULL,
    item_key VARCHAR(160) NOT NULL,
    title VARCHAR(200) NOT NULL,
    subtitle VARCHAR(255) NOT NULL DEFAULT '',
    unit_price DECIMAL(10,2) NOT NULL,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    booking_data JSON NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_cart_booking (user_id, item_type, item_key),
    CONSTRAINT fk_cart_account FOREIGN KEY (user_id) REFERENCES accounts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS trip_orders (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    order_ref VARCHAR(32) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_status VARCHAR(30) NOT NULL DEFAULT 'Paid (demo)',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_order_ref (order_ref),
    CONSTRAINT fk_orders_account FOREIGN KEY (user_id) REFERENCES accounts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS trip_order_items (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    order_id INT UNSIGNED NOT NULL,
    item_type ENUM('flight','hotel','attraction') NOT NULL,
    title VARCHAR(200) NOT NULL,
    subtitle VARCHAR(255) NOT NULL DEFAULT '',
    unit_price DECIMAL(10,2) NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    booking_data JSON NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_order_items_order FOREIGN KEY (order_id) REFERENCES trip_orders(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS trip_timetable_items (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    schedule_date DATE NOT NULL,
    item_type ENUM('flight','hotel','restaurant','attraction') NOT NULL,
    item_key VARCHAR(160) NOT NULL DEFAULT '',
    title VARCHAR(200) NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL DEFAULT 0,
    quantity INT UNSIGNED NOT NULL DEFAULT 1,
    start_hour TINYINT UNSIGNED NOT NULL,
    end_hour TINYINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_timetable_user_date (user_id, schedule_date),
    CONSTRAINT fk_timetable_account FOREIGN KEY (user_id) REFERENCES accounts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS trip_timetable_plan_ranges (
    user_id INT UNSIGNED NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id),
    CONSTRAINT fk_timetable_range_account FOREIGN KEY (user_id) REFERENCES accounts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE trip_cart_items
    MODIFY COLUMN item_type ENUM('flight','hotel','attraction') NOT NULL;

ALTER TABLE trip_order_items
    MODIFY COLUMN item_type ENUM('flight','hotel','attraction') NOT NULL;

ALTER TABLE trip_favorites
    MODIFY COLUMN item_type ENUM('flight','hotel','restaurant','attraction') NOT NULL;

ALTER TABLE trip_timetable_items
    MODIFY COLUMN item_type ENUM('flight','hotel','restaurant','attraction') NOT NULL;
