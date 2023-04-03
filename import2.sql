/* Song database */]
CREATE DATABASE bilboard_songs;

USE bilboard_songs;

CREATE TABLE Hot100 (
  id INT NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  artist VARCHAR(255) NOT NULL,
  featuring VARCHAR(255),
  likes INT DEFAULT 0,
  dislikes INT DEFAULT 0,
  PRIMARY KEY (id)
);

/*
insert voorbeeld:
INSERT INTO songs (title, artist, featuring, likes, dislikes)
VALUES ('Shape of You', 'Ed Sheeran', NULL, 0, 0);
*/