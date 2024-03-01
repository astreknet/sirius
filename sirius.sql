CREATE TABLE IF NOT EXISTS safari (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	name varchar(60) NOT NULL unique,
	length INT2 unsigned DEFAULT 60,
	weekday INT3 DEFAULT 1111111,
	description LONG,
	time time DEFAULT "09:00:00",
    price_adult decimal(8,2) DEFAULT 0.00,
    price_solo decimal(8,2) DEFAULT 0.00,
    price_child decimal(8,2) DEFAULT 0.00,
	active bool DEFAULT TRUE,
	PRIMARY KEY (id)
); 

CREATE TABLE IF NOT EXISTS user (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	email varchar(45) NOT NULL unique,
	password char(64),
	fname varchar(18),
	lname varchar(18),
	tel varchar(18),
	userlevel INT1 unsigned DEFAULT 1,
	activation char(32), 
	updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS spare (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	name varchar(150),
	price decimal(8,2) DEFAULT 0.00,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS gig (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	user_id INT2 unsigned NOT NULL,
	safari_id INT2 unsigned DEFAULT 1,
	erp_link varchar(150),
	datetime datetime DEFAULT current_timestamp(),
	start time,
    end time,
    route varchar(150),
	weather varchar(90),
    temp DOUBLE(2,1),
    remarks varchar(450),
	issues INT1 unsigned DEFAULT FALSE,
	updated datetime ON UPDATE current_timestamp(),
	PRIMARY KEY (id),
	KEY fk_gig_user (user_id),
	KEY fk_gig_safari (safari_id),
	CONSTRAINT fk_gig_safari FOREIGN KEY (safari_id) REFERENCES safari (id) ON DELETE CASCADE,
	CONSTRAINT fk_gig_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS accident (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	user_id INT2 unsigned NOT NULL,
	gig_id INT2 unsigned DEFAULT 1,
	datetime datetime DEFAULT current_timestamp(),
	place varchar(150),
	point point,
	description varchar(300),
	customer_erp_link varchar(150),
	customer_name varchar(150),
	customer_address varchar(150),
	customer_email varchar(45),
	sm_reg_n varchar(27),
	sm_model varchar(30),
	waiver bool DEFAULT FALSE,
	total_euro decimal(8,2) DEFAULT 0.00,
	total_paid decimal(8,2) DEFAULT 0.00,
	injury varchar(300),
	first_aid bool DEFAULT FALSE,
	hospital_offer bool DEFAULT FALSE,
	hospital_visit bool DEFAULT FALSE,
	updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (id),
	KEY fk_accident_user (user_id),
	KEY fk_accident_gig (gig_id),
	CONSTRAINT fk_accident_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
	CONSTRAINT fk_accident_gig FOREIGN KEY (gig_id) REFERENCES gig (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS nearmiss (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	user_id INT2 unsigned NOT NULL,
	gig_id INT2 unsigned DEFAULT 1,
	nm_datetime datetime DEFAULT current_timestamp(),
	nm_place varchar(150),
	point point,
	nm_description varchar(300),
	guide bool DEFAULT FALSE,
	customer bool DEFAULT FALSE,
    third bool DEFAULT FALSE,
	updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (id),
	KEY fk_nearmiss_user (user_id),
	KEY fk_nearmiss_gig (gig_id),
	CONSTRAINT fk_nearmiss_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
	CONSTRAINT fk_nearmiss_gig FOREIGN KEY (gig_id) REFERENCES gig (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS incident (
	id INT2 unsigned NOT NULL AUTO_INCREMENT,
	user_id INT2 unsigned NOT NULL,
	datetime datetime DEFAULT current_timestamp(),
	place varchar(150),
	point point,
	description varchar(300),
	injury varchar(300),
	first_aid bool DEFAULT FALSE,
	hospital_visit bool DEFAULT FALSE,
	updated timestamp DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (id),
	KEY fk_issue_user (user_id),
	CONSTRAINT fk_issue_user FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS feedback (
    id INT2 unsigned NOT NULL AUTO_INCREMENT,
    datetime datetime DEFAULT current_timestamp(),
    description varchar(300),
    PRIMARY KEY (id)
);
