/* bilboard database */
CREATE DATABASE billboard_songs;

USE billboard_songs;

CREATE TABLE hot100 (
id INT NOT NULL AUTO_INCREMENT,
title VARCHAR(255) NOT NULL,
artist VARCHAR(255) NOT NULL,
featuring VARCHAR(255),
link VARCHAR(255) NOT NULL,
PRIMARY KEY (id)
);

/*
insert voorbeeld:
INSERT INTO hot100 (title, artist, featuring, link)
VALUES ('Shape of You', 'Ed Sheeran', NULL, 'https://www.example.com/viewcount');
*/
INSERT INTO hot100 (title, artist, featuring, link)
VALUES ('Shape of You', 'Ed Sheeran', NULL, 'https://www.example.com/viewcount');