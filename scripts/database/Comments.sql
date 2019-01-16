REATE TABLE IF NOT EXISTS Comments (
comment_id INT(20) NOT NULL,
post_id INT(20) NOT NULL,
user_id INT(20) NOT NULL,
content TEXT NOT NULL,
date_created DATE NOT NULL,
date_updated DATE,
PRIMARY KEY(comment_id),
FOREIGN KEY (post_id) REFERENCES Posts(post_id),
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
