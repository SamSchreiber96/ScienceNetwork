CREATE TABLE IF NOT EXISTS Followings(
user_id VARCHAR(20) NOT NULL,
following_id VARCHAR(20) NOT NULL,
PRIMARY KEY (user_id, following_id),
FOREIGN KEY (user_id) REFERENCES Users(user_id),
FOREIGN KEY (following_id) REFERENCES Users(user_id)
);
