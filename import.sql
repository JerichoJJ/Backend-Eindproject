/* User database*/
CREATE DATABASE gebruiker_data;

USE gebruiker_data;

CREATE TABLE  (
  id INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  is_admin BOOLEAN NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);

/*
Gebruiker admin rechtern geven:

USE billboardtop100;

UPDATE users SET is_admin = 1 WHERE username = 'john';
*/

/*
Gebruiker handmatig toevoegen:

USE billboardtop100;

INSERT INTO users (username, password, is_admin) VALUES ('admin', 'password123', 1);
*/