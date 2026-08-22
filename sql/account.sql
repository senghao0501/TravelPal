-- TravelPal account database
-- Import this file into phpMyAdmin after creating/selecting flight_booking.
-- Existing flight tables remain untouched.

CREATE DATABASE IF NOT EXISTS flight_booking;
USE flight_booking;

CREATE TABLE IF NOT EXISTS accounts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL,
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
