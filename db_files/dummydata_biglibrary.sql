USE cr10_irene_theiss_biglibrary;

INSERT INTO country (country_code, country_name) 
VALUES 
('USA', 'United Staes of America'),
('D', 'Germany'), 
('UK', 'United Kingdom'),
('CH', 'Switzerland'); 

INSERT INTO city (zipcode, city_name, fk_country_id) 
VALUES 
('98672', 'New York', 1),
('12345', 'Munich', 2),
('6754', 'London', 3),
('97222', 'Milwaukee', 1),
('8268', 'Salenstein', 4);

INSERT INTO publisher (pub_name, size, address, fk_city_id)
VALUES
('John Murray', 'medium', 'Somestreet 45', 3),
('Hodder', 'small', 'Differentstreet 45', 3),
('Penguin', 'big', 'Anotherstreet 123', 3),
('Ashton Productions', 'big', 'Hauptstraße 77', 2),
('ECM', 'big', 'Some Avenue 453', 1),
('Dark Horse', 'small', '10956 SE Main Street', 4),
('Niggli Verlag', 'small', 'Arenenbergstrasse 2', 5);

INSERT INTO author (firstname, lastname)
VALUES
('Randall', 'Munroe'),
('Tana', 'French'),
('Art', 'Spiegelman'),
('George', 'Lucas'),
('Kazuo', 'Koike'),
('Billy', 'Wilder'),
('Keith', 'Jarrett'),
('Bad', 'Religion'),
('Jost', 'Hochuli'),
('Fiona', 'Apple');

INSERT INTO genre (genre_name)
VALUES
('Fiction'),
('Non-Fiction'),
('Comics'),
('Jazz'),
('Punk'),
('Science Fiction'),
('Comedy'),
('Alternative');

INSERT INTO media (title, image_url, fk_author_id, isbn, short_description, publish_date, fk_publisher_id, mediatype, fk_genre_id, reserved)
VALUES
('What if', 'img/whatif.jpg', 1, '12345678', 'From the creator of the wildly popular xkcd.com, hilarious and informative answers to important questions you probably never thought to ask.',
'2015-09-24', 1, 'Book', 2, 'false'),
('The Trespasser', 'img/trespasser.jpg', 2, '12345678', 'Dublin detective Antoinette Conway returns in French’s absorbing tale of a murder that looks like a lovers’ tiff.',
'2017-11-01', 2, 'Book', 1, 'false'),
('Maus', 'img/maus.jpg', 3, '12345678', 'The Pulitzer Prize-winning Maus tells the story of Vladek Spiegelman, a Jewish survivor of Hitler''s Europe, and his son, a cartoonist coming to terms with his father''s story. Maus approaches the unspeakable through the diminutive.',
'1986-01-01', 3, 'Book', 3, 'false'),
('Lady Snowblood', 'img/snowblood.jpg', 5, '12345678', 'A story of pure vengeance, Lady Snowblood tells the tale of a daughter born of a singular purpose, to avenge the death of her family at the hands of a gang of thugs, a purpose woven into her soul from the time of her gestation. ',
'2005-03-12', 6, 'Book', 3, 'false'),
('The Last Jedi', 'img/lastjedi.jpg', 4, NULL, 'With the destruction of the Republic, the evil First Order reigns. Now, Supreme Leader Snoke looks to crush what''s left of the Resistance and cement his grip on the galaxy.',
'2017-12-01', 4, 'DVD', 6, 'false'),
('Some like it hot', 'img/somelike.jpg', 6, NULL, 'When two male musicians witness a mob hit, they flee the state in an all-female band disguised as women, but further complications set in.',
'1959-09-17', 4, 'DVD', 7, 'false'),
('Stranger than Fiction', 'img/stranger.jpg', 8, NULL, 'With sales continuing 24 years after its release, Stranger Than Fiction is one of Bad Religion''s most successful albums.',
'1994-06-19', 5, 'CD', 5, 'false'),
('Radiance', 'img/radiance.jpg', 7, NULL, 'Radiance is not just a return to form; it''s an instant classic of solo improvisation that is destined to rank highly among Jarrett''s strongest work. ',
'2006-08-10', 5, 'CD', 4, 'false'),
('Das Detail in der Typographie', 'img/typo.jpg', 9, '78754578', 'Der Schweizer Typograf und Buchgestalter Jost Hochuli gibt in dieser Broschüre eine knapp gefasste, informative Einführung in die Mikro- oder Detailtypografie. Es geht um die grundlegenden Einheiten: Buchstabe, Buchstabenabstand, Wort, Wortabstand, Zeile, Zeilenabstand, Kolumne. ',
'1994-11-01', 7, 'Book', 2, 'true'),
('The Idler Wheel Is Wiser Than The Driver Of The Screw', 'img/idler.jpeg', 10, NULL, 'Musically, Idler Wheel confirms Apple’s preference for piano-driven arrangements and for a contralto and belting style of singing to emphasize the emotion in her lyrics. Many of the traits that were developing in her earlier albums come into full bloom here. ',
'2012-06-19', 5, 'CD', 8, 'true');

INSERT INTO user (firstname, lastname, pwd, email)
VALUES
('Test', 'Tester', '$2y$10$41UCfabFdgaYz4h0dEWeO.tuOefScad84vUeXcDH5FjvfNWNEjmau', 'test@gmx.at');

INSERT INTO user_media (fk_user_id, fk_media_id, rental_date)
VALUES
(1, 9, '2018-01-31'),
(1, 10, '2018-02-09');







