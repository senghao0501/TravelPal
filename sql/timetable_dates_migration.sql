-- Run this once on existing TravelPal databases before deploying multi-day timetables.
-- Existing timetable entries are preserved and placed on today's date.
ALTER TABLE trip_timetable_items ADD COLUMN schedule_date DATE NULL AFTER user_id;
UPDATE trip_timetable_items SET schedule_date = CURDATE() WHERE schedule_date IS NULL;
ALTER TABLE trip_timetable_items MODIFY schedule_date DATE NOT NULL;
ALTER TABLE trip_timetable_items ADD KEY idx_timetable_user_date (user_id, schedule_date);
