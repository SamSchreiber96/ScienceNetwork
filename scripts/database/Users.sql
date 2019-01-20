CREATE TABLE IF NOT EXISTS Users(
user_id int(20) NOT NULL,
email VARCHAR(255) NOT NULL,
username VARCHAR(25) NOT NULL,
password VARCHAR(255) NOT NULL,
first_name VARCHAR(255) NOT NULL,
last_name VARCHAR(255) NOT NULL,
gender ENUM('M', 'F', 'O'),
#city_id INT(20) NOT NULL,
#country_id INT(20) NOT NULL,
profile_picture_url VARCHAR(255),
birth_date DATE,
date_created DATE NOT NULL,
/*FOREIGN KEY (city_id) REFERENCES Cities(city_id),*/
/*FOREIGN KEY (country_id REFERENCES Countries(country_id),*/
PRIMARY KEY (user_id),
UNIQUE KEY email (email),
UNIQUE KEY username (username)
);
