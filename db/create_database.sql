/*
user_data [id, username, password, created_at]
events [id, name, description, user, start, end]
choices[id, name, event]
availability[event, user, choice, start_time, end_time]
*/

DROP TABLE IF EXISTS availability;
DROP TABLE IF EXISTS choices;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS user_data;


CREATE TABLE IF NOT EXISTS user_data
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    username   VARCHAR(32) NOT NULL UNIQUE,
    password   TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT ck_username_len CHECK (length(username) >= 3),
    CONSTRAINT ck_password_len CHECK (length(password) >= 8)
    );

CREATE TABLE IF NOT EXISTS events
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    name        VARCHAR(255) NOT NULL,
    description VARCHAR(999),
    user        INT  NOT NULL,
    start       DATETIME NOT NULL,
    end         DATETIME NOT NULL,
    FOREIGN KEY (user) REFERENCES user_data (id)
    );

CREATE TABLE IF NOT EXISTS choices
(
    id    INT PRIMARY KEY AUTO_INCREMENT,
    name  VARCHAR(255) NOT NULL,
    event INT  NOT NULL,
    FOREIGN KEY (event) REFERENCES events (id)
    );

CREATE TABLE IF NOT EXISTS availability
(
    event  INT NOT NULL,
    user   INT NOT NULL,
    choice INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time   DATETIME NOT NULL,
    FOREIGN KEY (event) REFERENCES events (id),
    FOREIGN KEY (user) REFERENCES user_data (id),
    FOREIGN KEY (choice) REFERENCES choices (id)
    );