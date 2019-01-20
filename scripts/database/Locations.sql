CREATE TABLE IF NOT EXISTS Countries (
country_id INT(20) NOT NULL,
name VARCHAR(100) NOT NULL,
PRIMARY KEY (country_id),
UNIQUE KEY (name)
);

CREATE TABLE States (
state_id INT(20) NOT NULL,
name VARCHAR(100) NOT NULL,
country_id INT(20) NOT NULL,
PRIMARY KEY (state_id),
UNIQUE KEY (name,country_id)
);

CREATE TABLE Cities (
city_id INT(20) NOT NULL,
name VARCHAR(100) NOT NULL,
state_id INT(20) NOT NULL,
PRIMARY KEY (city_id),
UNIQUE KEY (name,state_id)
);
