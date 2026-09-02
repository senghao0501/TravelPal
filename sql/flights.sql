CREATE DATABASE IF NOT EXISTS flight_booking;
USE flight_booking;

CREATE TABLE IF NOT EXISTS states (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(10) NOT NULL UNIQUE,
    airport_name VARCHAR(100),
    airport_code VARCHAR(10),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS flights (
    id INT PRIMARY KEY AUTO_INCREMENT,
    airline VARCHAR(100) NOT NULL,
    flight_no VARCHAR(20) NOT NULL,
    from_state VARCHAR(100) NOT NULL,
    from_code VARCHAR(10) NOT NULL,
    to_state VARCHAR(100) NOT NULL,
    to_code VARCHAR(10) NOT NULL,
    departure_time VARCHAR(20),
    arrival_time VARCHAR(20),
    duration VARCHAR(20),
    price DECIMAL(10,2) NOT NULL,
    rating DECIMAL(3,2) DEFAULT 0,
    class_type VARCHAR(20) DEFAULT 'Economy',
    logo_url VARCHAR(500),
    description TEXT,
    stops INT DEFAULT 0,
    is_direct BOOLEAN DEFAULT TRUE,
    api_flight_id VARCHAR(100),
    departure_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_flight (flight_no, departure_date, from_code, to_code)
);

CREATE TABLE IF NOT EXISTS user_favorites (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    flight_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_favorite (user_id, flight_id)
);

INSERT INTO states (name, code, airport_name, airport_code) VALUES
('Selangor', 'KUL', 'Kuala Lumpur International Airport', 'KUL'),
('Selangor', 'SZB', 'Subang Airport', 'SZB'),
('Penang', 'PEN', 'Penang International Airport', 'PEN'),
('Johor', 'JHB', 'Senai International Airport', 'JHB'),
('Melaka', 'MKZ', 'Melaka Airport', 'MKZ'),
('Perak', 'IPH', 'Sultan Azlan Shah Airport', 'IPH'),
('Pahang', 'PKG', 'Tioman Island Airport', 'PKG'),
('Sabah', 'BKI', 'Kota Kinabalu Airport', 'BKI'),
('Sabah', 'SDK', 'Sandakan Airport', 'SDK'),
('Sabah', 'TWU', 'Tawau Airport', 'TWU'),
('Sarawak', 'KCH', 'Kuching International Airport', 'KCH'),
('Sarawak', 'MYY', 'Miri Airport', 'MYY'),
('Sarawak', 'BTU', 'Bintulu Airport', 'BTU');