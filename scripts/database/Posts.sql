CREATE TABLE IF NOT EXISTS Posts(
post_id int(20) NOT NULL,
user_id int(20) NOT NULL,
subject VARCHAR(255),
type ENUM('text', 'image', 'video'),
post_url VARCHAR(255) NOT NULL,
date_created  DATE NOT NULL,
dated_updated DATE,
PRIMARY KEY (post_id),
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
