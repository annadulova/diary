CREATE DATABASE diary;

CREATE TABLE users (
    userID 		int 		NOT NULL AUTO_INCREMENT, 
    username 	varchar(50) NOT NULL,
    email 		varchar(50) NOT NULL,
    password 	varchar(50) NOT NULL,
    regdate 	datetime 	NOT NULL,
	phonenumber varchar(20),
	PRIMARY KEY (userID)
);

CREATE TABLE diary (
    diaryID 	int 		NOT NULL AUTO_INCREMENT,
	userID 		int 		NOT NULL,
    diaryname 	varchar(100) NOT NULL,
	date 		date 		NOT NULL,
    diary 		varchar(10000) NOT NULL,
	PRIMARY KEY (diaryID),
    FOREIGN KEY (userID) REFERENCES users(userID)
);

CREATE TABLE feedback (
    userID 		int 		NOT NULL,
    subject 		varchar(50) 		NOT NULL,
    feedback 		varchar(10000) NOT NULL,
	FOREIGN KEY (userID) REFERENCES users(userID)
);

INSERT INTO `users` (`username`, `email`, `password`, `regdate`, `phonenumber`) VALUES ('test', 'test@test.de', 'test123', '2021-12-31 10:27:11', '017123456789');	