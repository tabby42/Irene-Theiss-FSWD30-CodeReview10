DROP DATABASE IF EXISTS cr10_irene_theiss_biglibrary;

CREATE DATABASE IF NOT EXISTS cr10_irene_theiss_biglibrary DEFAULT CHARACTER SET utf8;

USE cr10_irene_theiss_biglibrary;

-- create tables
CREATE TABLE IF NOT EXISTS media (
	id INT unsigned NOT NULL AUTO_INCREMENT,
    title NVARCHAR(255) NOT NULL,
    image_url NVARCHAR(255) NOT NULL,
	fk_author_id  INT unsigned NOT NULL,
    isbn NVARCHAR(55),
	short_description NVARCHAR(1000) ,
	publish_date DATE NOT NULL,
	fk_publisher_id  INT unsigned NOT NULL,
    mediatype ENUM('Book', 'DVD', 'CD') NOT NULL,
    fk_genre_id INT unsigned NOT NULL,
    reserved ENUM('true', 'false') NOT NULL DEFAULT 'false',
    CONSTRAINT pk_media PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS author (
	id INT unsigned NOT NULL AUTO_INCREMENT,
    firstname NVARCHAR(55) NOT NULL,
    lastname NVARCHAR(55),
    CONSTRAINT pk_author PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS publisher (
	id INT unsigned NOT NULL AUTO_INCREMENT,
    pub_name NVARCHAR(55) NOT NULL,
    size ENUM('small', 'medium', 'big') NOT NULL,
	address NVARCHAR(255) NOT NULL,
    fk_city_id INT unsigned NOT NULL,
    CONSTRAINT pk_publisher PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS genre (
	id INT unsigned NOT NULL AUTO_INCREMENT,
    genre_name NVARCHAR(55) NOT NULL,
    CONSTRAINT pk_genre PRIMARY KEY(id)
);


CREATE TABLE IF NOT EXISTS city (
	id INT unsigned NOT NULL AUTO_INCREMENT,
    zipcode NVARCHAR(16) NOT NULL,
    city_name NVARCHAR(55) NOT NULL,
    fk_country_id INT unsigned NOT NULL,
    CONSTRAINT pk_city PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS country (
	id INT unsigned NOT NULL AUTO_INCREMENT,
    country_code NVARCHAR(8) NOT NULL,
    country_name NVARCHAR(55) NOT NULL,
    CONSTRAINT pk_country PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS user (
    id INT unsigned NOT NULL  AUTO_INCREMENT,
    firstname NVARCHAR(55) NOT NULL ,
    lastname NVARCHAR(55) NOT NULL ,
    pwd NVARCHAR(255) NOT NULL,
    email NVARCHAR(255) NOT NULL,
    CONSTRAINT pk_user PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS user_media (
	id INT unsigned NOT NULL  AUTO_INCREMENT,
    fk_user_id INT unsigned NOT NULL,
    fk_media_id INT unsigned NOT NULL,
    rental_date DATE NOT NULL,
    CONSTRAINT pk_user_media PRIMARY KEY(id)
);

-- create foreign keys
ALTER TABLE media 
ADD CONSTRAINT fk_media_author
FOREIGN KEY (fk_author_id) REFERENCES author(id);

ALTER TABLE media 
ADD CONSTRAINT fk_media_publisher
FOREIGN KEY (fk_publisher_id) REFERENCES publisher(id);

ALTER TABLE media 
ADD CONSTRAINT fk_media_genre
FOREIGN KEY (fk_genre_id) REFERENCES genre(id);

ALTER TABLE publisher 
ADD CONSTRAINT fk_publisher_city
FOREIGN KEY (fk_city_id) REFERENCES city(id);

ALTER TABLE city 
ADD CONSTRAINT fk_city_country
FOREIGN KEY (fk_country_id) REFERENCES country(id);

ALTER TABLE user_media 
ADD CONSTRAINT fk_user_media__user
FOREIGN KEY (fk_user_id) REFERENCES user (id);

ALTER TABLE user_media 
ADD CONSTRAINT fk_user_media__media
FOREIGN KEY (fk_media_id) REFERENCES media (id);

-- create views
CREATE VIEW getMedia AS
SELECT media.id, title, image_url, isbn, short_description, DATE_FORMAT(publish_date, '%d.%m.%Y'), mediatype, 
				CONCAT(author.firstname, ' ', author.lastname), genre_name, pub_name, reserved
FROM media 
JOIN author ON media.fk_author_id = author.id
JOIn genre ON media.fk_genre_id = genre.id
JOIN publisher ON media.fk_publisher_id = publisher.id
ORDER BY title;

-- SELECT * FROM getMedia WHERE id = 1;

CREATE VIEW getRentedMedia AS
SELECT user.id, title, CONCAT(author.firstname, ' ', author.lastname), DATE_FORMAT(rental_date, '%d.%m.%Y'), 
				DATE_FORMAT(DATE_ADD(rental_date ,INTERVAL 2 WEEK), '%d.%m.%Y') AS return_date
FROM user 
JOIN user_media ON user.id = user_media.fk_user_id
JOIN media ON user_media.fk_media_id = media.id
JOIN author ON media.fk_author_id = author.id
ORDER BY title;

-- SELECT * FROM getRentedMedia WHERE id= 1;


