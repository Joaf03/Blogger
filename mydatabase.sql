DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Posts;

CREATE TABLE Users (
    userID INTEGER PRIMARY KEY AUTOINCREMENT,
    username VARCHAR(255) NOT NULL
);

CREATE TABLE Posts (
    postID INTEGER PRIMARY KEY AUTOINCREMENT,
    userID INT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userID) REFERENCES Users(userID)
);

INSERT INTO Users (username) VALUES ('John Doe');
INSERT INTO Users (username) VALUES ('Jane Doa');
INSERT INTO Users (username) VALUES ('Josh Smith');
INSERT INTO Posts (title, content) VALUES ('First Post', 'Content of the first post');
INSERT INTO Posts (title, content) VALUES ('Second Post', 'Content of the second post');