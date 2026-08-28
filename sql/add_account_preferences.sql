USE flight_booking;

SET @add_language = IF(
    EXISTS(
        SELECT 1
        FROM information_schema.columns
        WHERE table_schema = DATABASE()
          AND table_name = 'accounts'
          AND column_name = 'language'
    ),
    'SELECT 1',
    'ALTER TABLE accounts ADD COLUMN language VARCHAR(10) NOT NULL DEFAULT ''EN'' AFTER email'
);
PREPARE add_language_statement FROM @add_language;
EXECUTE add_language_statement;
DEALLOCATE PREPARE add_language_statement;

SET @add_currency = IF(
    EXISTS(
        SELECT 1
        FROM information_schema.columns
        WHERE table_schema = DATABASE()
          AND table_name = 'accounts'
          AND column_name = 'currency'
    ),
    'SELECT 1',
    'ALTER TABLE accounts ADD COLUMN currency VARCHAR(10) NOT NULL DEFAULT ''MYR'' AFTER language'
);
PREPARE add_currency_statement FROM @add_currency;
EXECUTE add_currency_statement;
DEALLOCATE PREPARE add_currency_statement;
