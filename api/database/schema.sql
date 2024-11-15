-- SQLite3 test.db
CREATE TABLE tasks(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(45),
    description TEXT NOT NULL,
    level INT NOT NULL,
    status VARCHAR(15),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME DEFAULT NULL,
    UNIQUE(name) ON CONFLICT IGNORE
);
