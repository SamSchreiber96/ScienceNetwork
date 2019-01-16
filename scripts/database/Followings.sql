CREATE TABLE IF NOT EXISTS Followings(
user_id INT NOT NULL,
following_id INT NOT NULL,
PRIMARY KEY (user_id, following_id),
FOREIGN KEY (user_id) REFERENCES Users(user_id),
FOREIGN KEY (following_id) REFERENCES Users(user_id)
);
