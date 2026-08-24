USE flight_booking;

ALTER TABLE trip_cart_items
    MODIFY COLUMN item_type ENUM('flight','hotel','attraction') NOT NULL;

ALTER TABLE trip_order_items
    MODIFY COLUMN item_type ENUM('flight','hotel','attraction') NOT NULL;

ALTER TABLE trip_favorites
    MODIFY COLUMN item_type ENUM('flight','hotel','restaurant','attraction') NOT NULL;

ALTER TABLE trip_timetable_items
    MODIFY COLUMN item_type ENUM('flight','hotel','restaurant','attraction') NOT NULL;
