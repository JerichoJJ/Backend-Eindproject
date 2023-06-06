DROP DATABASE IF EXISTS billboard_songs;
DROP DATABASE IF EXISTS billboard100;
DROP DATABASE IF EXISTS user_data;


CREATE DATABASE billboard100;

USE billboard100;

DROP  TABLE IF EXISTS hot100;
CREATE TABLE hot100 (
likes INT,
rank INT,
song VARCHAR(255),
artist VARCHAR(255),
last_week INT,
peak_rank INT,
weeks_on_board INT,
id INT NOT NULL AUTO_INCREMENT,
PRIMARY key (id)
);

DROP  TABLE IF EXISTS users;
CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
is_admin BOOLEAN NOT NULL DEFAULT 0,
PRIMARY KEY (id)
);

CREATE TABLE user_likes (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  song_id INT NOT NULL,
  created_at DATE NOT NULL,
  type VARCHAR(255) NOT NULL,
  PRIMARY KEY (id)
);
ALTER TABLE user_likes ADD CONSTRAINT unique_user_song UNIQUE (user_id, song_id);

/*
Dummy data
INSERT INTO hot100 (likes, rank, song, artist, last_week, peak_rank, weeks_on_board)

VALUES
(0, 1, 'Easy On Me', 'Adele', 1, 1, 3),
(0, 2, 'Stay', 'The Kid LAROI & Justin Bieber', 2, 1, 16),
(0, 3, 'Industry Baby', 'Lil Nas X & Jack Harlow', 3, 1, 14),
(0, 4, 'Fancy Like', 'Walker Hayes', 4, 3, 19),
(0, 5, 'Bad Habits', 'Ed Sheeran', 5, 2, 18),
(0, 6, 'Way 2 Sexy', 'Drake Featuring Future & Young Thug', 6, 1, 8),
(0, 7, 'Shivers', 'Ed Sheeran', 9, 7, 7),
(0, 8, 'Good 4 U', 'Olivia Rodrigo', 7, 1, 24),
(0, 9, 'Need To Know', 'Doja Cat', 11, 9, 20),
(0, 10, 'Levitating', 'Dua Lipa', 8, 2, 56),
(0, 11, 'Essence', 'Wizkid Featuring Justin Bieber & Tems', 12, 9, 17),
(0, 12, 'Kiss Me More', 'Doja Cat Featuring SZA', 10, 3, 29),
(0, 13, 'Heat Waves', 'Glass Animals', 14, 12, 41),
(0, 14, 'Beggin', 'Maneskin', 15, 14, 18),
(0, 15, 'Cold Heart (PNAU Remix)', 'Elton John & Dua Lipa', 21, 15, 8),
(0, 16, 'You Right', 'Doja Cat & The Weeknd', 16, 11, 18),
(0, 17, 'Save Your Tears', 'The Weeknd & Ariana Grande', 17, 1, 46),
(0, 18, 'If I Didn''t Love You', 'Jason Aldean & Carrie Underwood', 23, 15, 14),
(0, 19, 'Traitor', 'Olivia Rodrigo', 22, 9, 23),
(0, 20, 'My Universe', 'Coldplay x BTS', 13, 1, 5),
(0, 21, 'Who Want Smoke??', "Nardo Wick Featuring G Herbo, Lil Durk & 21 Savage", 19, 17, 3),
(0, 22, 'Knife Talk', 'Drake Featuring 21 Savage & Project Pat', 18, 4, 8),
(0, 23, 'Meet Me At Our Spot', 'THE ANXIETY: WILLOW & Tyler Cole', 32, 23, 7),
(0, 24, 'Montero (Call Me By Your Name)', 'Lil Nas X', 24, 1, 31),
(0, 25, 'Chasing After You', 'Ryan Hurd With Maren Morris', 25, 23, 26),
(0, 26, 'Girls Want Girls', 'Drake Featuring Lil Baby', 26, 2, 8),
(0, 27, 'Moth To A Flame', 'Swedish House Mafia & The Weeknd', 0, 27, 1),
(0, 28, "Let's Go Brandon", 'Bryson Gray Featuring Tyson James & Chandler Crump', 0, 28, 1),
(0, 29, 'Thats What I Want', 'Lil Nas X', 28, 10, 6),
(0, 30, 'Pepas', 'Farruko', 29, 25, 14),
(0, 31, 'Love Nwantiti (Ah Ah Ah)', 'CKay', 31, 31, 6),
(0, 32, 'Take My Breath', 'The Weeknd', 27, 6, 12),
(0, 33, 'Happier Than Ever', 'Billie Eilish', 30, 11, 13),
(0, 34, 'Wockesha', 'Moneybagg Yo', 33, 20, 27),
(0, 35, 'Better Days', 'NEIKED X Mae Muller X Polo G', 57, 35, 2),
(0, 36, 'Buy Dirt', 'Jordan Davis Featuring Luke Bryan', 34, 34, 12),
(0, 37, 'Ghost', 'Justin Bieber', 38, 32, 5),
(0, 38, 'Lets Go Brandon', 'Loza Alexander', 45, 38, 2),
(0, 39, 'Cold As You', 'Luke Combs', 41, 39, 13),
(0, 40, 'A-O-K', 'Tai Verdes', 36, 34, 17),
(0, 41, 'You Should Probably Leave', 'Chris Stapleton', 40, 40, 17),
(0, 42, 'Leave The Door Open', 'Silk Sonic (Bruno Mars & Anderson .Paak)', 44, 1, 34),
(0, 43, "Thinking 'Bout You", 'Dustin Lynch Featuring Lauren Alaina Or MacKenzie Porter', 51, 43, 11),
(0, 44, "Memory I Don't Mess With", 'Lee Brice', 35, 33, 14),
(0, 45, 'Bubbly', 'Young Thug With Drake & Travis Scott', 20, 20, 2),
(0, 46, 'Wild Side', 'Normani Featuring Cardi B', 47, 14, 15),
(0, 47, 'Sharing Locations', 'Meek Mill Featuring Lil Baby & Lil Durk', 43, 22, 9),
(0, 48, 'Gyalis', 'Capella Grey', 46, 38, 13),
(0, 49, 'I Was On A Boat That Day', 'Old Dominion', 42, 37, 17),
(0, 50, 'Family Ties', 'Baby Keem & Kendrick Lamar', 52, 18, 9),
(0, 51, 'Have Mercy', 'Chloe', 53, 28, 7),
(0, 52, 'Fair Trade', 'Drake Featuring Travis Scott', 48, 3, 8),
(0, 53, 'Same Boat', 'Zac Brown Band', 55, 53, 6),
(0, 54, 'My Boy', 'Elvie Shane', 37, 28, 18),
(0, 55, 'Hurricane', 'Kanye West', 58, 6, 9),
(0, 56, 'Chosen', 'Blxst & Tyga Featuring Ty Dolla $ign', 63, 56, 5),
(0, 57, 'Baddest', '"Yung Bleu, Chris Brown & 2 Chainz"', 59, 56, 13),
(0, 58, 'Knowing You', 'Kenny Chesney', 64, 58, 11),
(0, 59, 'Memory', 'Kane Brown X blackbear', 62, 50, 16),
(0, 60, 'Cold Beer Calling My Name', 'Jameson Rodgers Featuring Luke Combs', 54, 26, 17),
(0, 61, 'Not In The Mood', '"Lil Tjay, Fivio Foreign & Kay Flock"', 0, 61, 1),
(0, 62, 'Pissed Me Off', 'Lil Durk', 39, 39, 2),
(0, 63, 'Woman', 'Doja Cat', 65, 62, 13),
(0, 64, 'Sand In My Boots', 'Morgan Wallen', 74, 32, 15),
(0, 65, "Til You Can't", 'Cody Johnson', 76, 65, 3),
(0, 66, 'Love Again', 'Dua Lipa', 61, 41, 15),
(0, 67, 'Whiskey And Rain', 'Michael Ray', 81, 67, 4),
(0, 68, 'One Mississippi', 'Kane Brown', 80, 68, 5),
(0, 69, 'Switches & Dracs', 'Moneybagg Yo Featuring Lil Durk & EST Gee', NULL, 69, 1),
(0, 70, 'Jugaste y Sufri', 'Eslabon Armado Featuring DannyLux', 77, 69, 4),
(0, 71, 'Too Easy', 'Gunna & Future', 71, 38, 5),
(0, 72, 'Esta Danada', 'Ivan Cornejo', 66, 61, 4),
(0, 73, 'Volvi', 'Aventura x Bad Bunny', 75, 22, 13),
(0, 74, 'Tequila Little Time', 'Jon Pardi', 83, 74, 3),
(0, 75, 'Whole Lotta Money', 'BIA Featuring Nicki Minaj', 70, 16, 16),
(0, 76, '2055', 'Sleepy Hallow', 72, 51, 15),
(0, 77, 'Maybach', '42 Dugg Featuring Future', 85, 68, 5),
(0, 78, 'WFM', 'Realestk', 67, 67, 3),
(0, 79, 'Poke It Out', 'Wale Featuring J. Cole', NULL, 79, 1),
(0, 80, 'Praise God', 'Kanye West', 89, 20, 5),
(0, 81, 'Lo Siento BB:/', 'Tainy, Bad Bunny & Julieta Venegas', 73, 51, 3),
(0, 82, 'Freedom Was A Highway', 'Jimmie Allen & Brad Paisley', 84, 82, 3),
(0, 83, 'For Tonight', 'Giveon', 88, 83, 4),
(0, 84, 'Thot Shit', 'Megan Thee Stallion', 82, 16, 20),
(0, 85, 'Like A Lady', 'Lady A', 99, 85, 3),
(0, 86, 'Get Into It (Yuh)', 'Doja Cat', 86, 68, 12),
(0, 87, 'Scorpio', 'Moneybagg Yo', NULL, 87, 1),
(0, 88, 'Big Energy', 'Latto', NULL, 88, 1),
(0, 89, 'Half Of My Hometown', 'Kelsea Ballerini Featuring Kenny Chesney', NULL, 89, 1),
(0, 90, 'Money', 'Lisa', NULL, 90, 1),
(0, 91, 'No Friends In The Industry', 'Drake', 87, 11, 8),
(0, 92, 'Ya Superame (En Vivo Desde Culiacan, Sinaloa)', 'Grupo Firme', 92, 92, 2),
(0, 93, "Who's In Your Head", 'Jonas Brothers', 96, 93, 3),
(0, 94, 'In The Bible', 'Drake Featuring Lil Durk & Giveon', 94, 7, 8),
(0, 95, 'Just About Over You', 'Priscilla Block', 100, 95, 3),
(0, 96, 'To Be Loved By You', 'Parker McCollum', NULL, 96, 1),
(0, 97, "Ain't Shit", 'Doja Cat', NULL, 24, 14),
(0, 98, 'Life Goes On', 'Oliver Tree', NULL, 91, 2),
(0, 99, 'Come Through', 'H.E.R. Featuring Chris Brown', NULL, 64, 16),
(0, 100, 'Nevada', 'YoungBoy Never Broke Again', NULL, 58, 4);


-- Set the number of users and songs
SET @num_users = 50;
SET @num_songs = 100;

-- Set the desired number of dummy data rows
SET @num_dummy_data = 4000; -- Adjust this number as per your requirement

-- Generate random like values
INSERT INTO user_likes (user_id, song_id, created_at, type)
SELECT
  FLOOR(RAND() * (@num_users - 1 + 1) + 1) AS user_id,
  FLOOR(RAND() * (@num_songs - 1 + 1) + 1) AS song_id,
  DATE_FORMAT(FROM_UNIXTIME(UNIX_TIMESTAMP() - RAND() * UNIX_TIMESTAMP()), '%Y-%m-%d') AS created_at,
  IF(RAND() <= 0.65, 'like', 'dislike') AS type
FROM
  (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) t1,
  (SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6) t2
LIMIT @num_dummy_data;
