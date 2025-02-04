#!/bin/bash

# Define the SQLite database path
DB_PATH="database/database.sqlite"

# Create the SQLite database file if it doesn't exist
if [ ! -f "$DB_PATH" ]; then
    touch "$DB_PATH"
    echo "SQLite database created at $DB_PATH"
else
    echo "SQLite database already exists at $DB_PATH"
fi

# Check if DB_CONNECTION is set to sqlite in the .env file
if ! grep -q "DB_CONNECTION=sqlite" .env; then
    # Append SQLite configuration to .env if not present
    echo "DB_CONNECTION=sqlite" >> .env
    echo "DB_DATABASE=$DB_PATH" >> .env
    echo "SQLite connection added to .env"
else
    # Update .env with SQLite connection path
    sed -i "s/^DB_CONNECTION=.*/DB_CONNECTION=sqlite/" .env
    sed -i "s|^DB_DATABASE=.*|DB_DATABASE=$DB_PATH|" .env
    echo "Updated .env with SQLite connection"
fi
