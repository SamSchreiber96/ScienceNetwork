CREATE TABLE  IF NOT EXISTS Messages(
message_id VARCHAR(20) NOT NULL,
user_id_from VARCHAR(20) NOT NULL,
user_id_to VARCHAR(20) NOT NULL,
content text NOT NULL,
date_created DATE NOT NULL,
PRIMARY KEY (message_id),
FOREIGN KEY (user_id_from) REFERENCES Users(user_id),
FOREIGN KEY (user_id_to) REFERENCES Users(user_id)
);
