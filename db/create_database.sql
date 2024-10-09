/*
user_data [id, username, password, created_at]
events [id, name, description, user, start, end]
choices[id, name, event]
time[id, start_time, end_time, event]
availability[time, event, user, choice]
*/

CREATE TABLE user_data
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    username   TEXT NOT NULL UNIQUE,
    password   TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT ck_username_len CHECK (length(username) >= 3),
    CONSTRAINT ck_password_len CHECK (length(password) >= 8)
);

CREATE TABLE events
(
    id          INT PRIMARY KEY AUTO_INCREMENT,
    name        TEXT NOT NULL,
    description TEXT,
    user        INT  NOT NULL,
    start       DATE NOT NULL,
    end         DATE NOT NULL,
    FOREIGN KEY (user) REFERENCES user_data (id)
);

CREATE TABLE choices
(
    id    INT PRIMARY KEY AUTO_INCREMENT,
    name  TEXT NOT NULL,
    event INT  NOT NULL,
    FOREIGN KEY (event) REFERENCES events (id)
);

CREATE TABLE times
(
    id         INT PRIMARY KEY AUTO_INCREMENT,
    start_time DATETIME,
    end_time   DATETIME,
    event      INT,
    FOREIGN KEY (event) REFERENCES events (id)
);

CREATE TABLE availability
(
    time   INT NOT NULL,
    event  INT NOT NULL,
    user   INT NOT NULL,
    choice INT NOT NULL,
    FOREIGN KEY (time) REFERENCES time (id),
    FOREIGN KEY (event) REFERENCES events (id),
    FOREIGN KEY (user) REFERENCES user_data (id),
    FOREIGN KEY (choice) REFERENCES choices (id)
);
