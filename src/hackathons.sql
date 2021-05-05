DROP TABLE Mentors;
DROP TABLE Attends;
DROP TABLE Sponsors;
DROP TABLE ParticipatesIn;
DROP TABLE RegistersFor;
DROP TABLE Contains;
DROP TABLE HelpsRun;
DROP TABLE Workshop;
DROP TABLE CompanyRepresentative;
DROP TABLE Volunteer;
DROP TABLE Company;
DROP TABLE GuestSpeaker;
DROP TABLE Mentor;
DROP TABLE Hospitality;
DROP TABLE MarketingRecruitment;
DROP TABLE SponsorshipOutreach;
DROP TABLE Hackathon;
DROP TABLE Participant;
DROP TABLE Guest;
DROP TABLE ParticipantSchool;
DROP TABLE Caterer;
DROP TABLE Organizer;
 
 -------------- GROUP 1 ----------------
CREATE TABLE Organizer(
	email    CHAR(40) PRIMARY KEY,
	oname     CHAR(30),
	phoneNum CHAR(20));

GRANT SELECT ON Organizer TO public;

CREATE TABLE Caterer(
	cname   CHAR(30) PRIMARY KEY,
	budget INTEGER);

GRANT SELECT ON Caterer TO public;

CREATE TABLE ParticipantSchool(
	psname   CHAR(40) PRIMARY KEY,
	pslocation CHAR(30));
	
GRANT SELECT ON ParticipantSchool TO public;

CREATE TABLE Guest(
	gID   INTEGER PRIMARY KEY,
	gname CHAR(30));

GRANT SELECT ON Guest TO public;

 -------------- GROUP 2 ----------------
CREATE TABLE Participant(
	ID       INTEGER  PRIMARY KEY,
	pname     CHAR(30),
	email    CHAR(40),
	school   CHAR(40),
	FOREIGN KEY (school) REFERENCES ParticipantSchool(psname) ON DELETE CASCADE);

GRANT SELECT ON Participant TO public;

CREATE TABLE Hackathon(
	hname     CHAR(30) PRIMARY KEY,
	Oemail   CHAR(40) NOT NULL,
	hdate    DATE,
	hlocation CHAR(40),
	FOREIGN KEY (Oemail) REFERENCES Organizer(email) ON DELETE CASCADE);

GRANT SELECT ON Hackathon TO public;

CREATE TABLE SponsorshipOutreach(
	email    CHAR(40) PRIMARY KEY,
	industry CHAR(30),
FOREIGN KEY (email) REFERENCES Organizer(email) ON DELETE CASCADE);

GRANT SELECT ON SponsorshipOutreach TO public;

CREATE TABLE MarketingRecruitment(
	email               CHAR(40) PRIMARY KEY,
	socialMediaPlatform CHAR(30),
FOREIGN KEY (email) REFERENCES Organizer(email) ON DELETE CASCADE);

GRANT SELECT ON MarketingRecruitment TO public;

CREATE TABLE Hospitality(
	email   CHAR(40) PRIMARY KEY,
	caterer CHAR(30) UNIQUE,
FOREIGN KEY (caterer) REFERENCES Caterer,
FOREIGN KEY (email) REFERENCES Organizer(email) ON DELETE CASCADE);

GRANT SELECT ON Hospitality TO public;

CREATE TABLE Mentor(
	ID      		 INTEGER PRIMARY KEY,
	bestLanguage 	 CHAR(20),
	areaOfExpertise CHAR(30),
FOREIGN KEY (ID) REFERENCES Guest(gID) ON DELETE CASCADE);

GRANT SELECT ON Mentor TO public;

CREATE TABLE GuestSpeaker(
	ID    INTEGER PRIMARY KEY,
	topic CHAR(50),
FOREIGN KEY (ID) REFERENCES Guest(gID) ON DELETE CASCADE);

GRANT SELECT ON GuestSpeaker TO public;

 -------------- GROUP 3 ----------------
CREATE TABLE Volunteer(
	ID       INTEGER PRIMARY KEY,
	MRemail  CHAR(40) NOT NULL,
	vname     CHAR(40),
	vrole     CHAR(20),
	email    CHAR(40),
	phoneNum CHAR(20),
	FOREIGN KEY (MRemail) REFERENCES MarketingRecruitment(email) ON DELETE CASCADE);

GRANT SELECT ON Volunteer TO public;

CREATE TABLE Company(
	cname     CHAR(30) PRIMARY KEY,
	SOemail  CHAR(40),
	phoneNum CHAR(20),
	email    CHAR(40),
FOREIGN KEY (SOemail) REFERENCES SponsorshipOutreach(email) ON DELETE CASCADE);

GRANT SELECT ON Company TO public;

 -------------- GROUP 4 ----------------
CREATE TABLE CompanyRepresentative
  (ID    INTEGER PRIMARY KEY,
   Cname CHAR(30) NOT NULL,
   FOREIGN KEY(ID)    REFERENCES Guest ON DELETE CASCADE,
   FOREIGN KEY(Cname) REFERENCES Company(cname) ON DELETE CASCADE);

GRANT SELECT ON CompanyRepresentative TO public;

 -------------- GROUP 4 ----------------
CREATE TABLE Workshop(
	title   CHAR(80) PRIMARY KEY,
	wtime   CHAR(30),
	roomNum CHAR(20));

GRANT SELECT ON Workshop TO public;

CREATE TABLE HelpsRun
  (vID   INTEGER,
   hName CHAR(30),
   FOREIGN KEY(vID)   REFERENCES Volunteer ON DELETE CASCADE,
   FOREIGN KEY(hName) REFERENCES Hackathon ON DELETE CASCADE,
   PRIMARY KEY(vID, hName));

GRANT SELECT ON HelpsRun TO public;

CREATE TABLE Contains
  (hName  CHAR(30),
   wTitle CHAR(80),
   FOREIGN KEY(hName)  REFERENCES Hackathon(hname) ON DELETE CASCADE,
   FOREIGN KEY(wTitle) REFERENCES Workshop(title)  ON DELETE CASCADE,
   PRIMARY KEY(hName, wTitle));

GRANT SELECT ON Contains TO public;

CREATE TABLE RegistersFor
  (pID    INTEGER,
   wTitle CHAR(80),
   FOREIGN KEY(pID)    REFERENCES Participant(ID) ON DELETE CASCADE,
   FOREIGN KEY(wTitle) REFERENCES Workshop(title) ON DELETE CASCADE,
   PRIMARY KEY(pID, wTitle));

GRANT SELECT ON RegistersFor TO public;

CREATE TABLE ParticipatesIn
  (pID   INTEGER,
   hName CHAR(30),
   FOREIGN KEY(pID)   REFERENCES Participant(ID)  ON DELETE CASCADE,
   FOREIGN KEY(hName) REFERENCES Hackathon(hname) ON DELETE CASCADE,
   PRIMARY KEY(pID, hName));

GRANT SELECT ON ParticipatesIn TO public;

CREATE TABLE Sponsors
  (hName CHAR(30),
   cName CHAR(30),
   FOREIGN KEY(hName) REFERENCES Hackathon(hname) ON DELETE CASCADE,
   FOREIGN KEY(cName) REFERENCES Company(cname) ON DELETE CASCADE,
   PRIMARY KEY(hName, cName));

GRANT SELECT ON Sponsors TO public;

CREATE TABLE Attends
  (gID   INTEGER,
   hName CHAR(30),
   FOREIGN KEY(gID)   REFERENCES Guest(gID) ON DELETE CASCADE,
   FOREIGN KEY(hName) REFERENCES Hackathon(hname) ON DELETE CASCADE,
   PRIMARY KEY(gID, hName));

GRANT SELECT ON Attends TO public;

CREATE TABLE Mentors
  (mID INTEGER,
   pID INTEGER,
   FOREIGN KEY(mID) REFERENCES Mentor(ID) ON DELETE CASCADE,
   FOREIGN KEY(pID) REFERENCES Participant(ID) ON DELETE CASCADE,
   PRIMARY KEY(mID, pID));

GRANT SELECT ON Mentors TO public;

-- ///////////////////////////////////////////////////////////

--------------------------- Group 1 INSERT -------------------------------
INSERT INTO Organizer VALUES ('kevinli@gmail.com','Kevin Li','604-523-5326');
INSERT INTO Organizer VALUES ('harriet.092@hotmail.com','Harriet Richards','604-886-7455');
INSERT INTO Organizer VALUES ('n.jordan@gmail.com','Nahla Jordan','778-285-0038');
INSERT INTO Organizer VALUES ('adnaan_bread@yahoo.com','Adnaan Turner','778-593-3060');
INSERT INTO Organizer VALUES ('wilburdmitriyev@gmail.com','Wilbur Dmitriyev','605-876-9993');
INSERT INTO Organizer VALUES ('robsonstreet@live.com','Andreas Robson','604-346-6363');
INSERT INTO Organizer VALUES ('maryzhang@gmail.com','Mary Zhang','299-649-3685');
INSERT INTO Organizer VALUES('jeff.brew@hotmail.com','Jeffrey Brewer','604-622-4969');
INSERT INTO Organizer VALUES ('itsjen@hotmail.com','Jennifer Fitspatrick','778-326-9999');
INSERT INTO Organizer VALUES ('hannahhayes@ubc.ca','Hannah Hayes','238-683-4781');
INSERT INTO Organizer VALUES ('eastofeden@gmail.com','Eden Preece','235-554-9080');
INSERT INTO Organizer VALUES ('lilypad101@hotmail.com','Lily Wang','778-112-1420');
INSERT INTO Organizer VALUES ('notrickyweston@gmail.com','Ricky Easton','604-292-0880');
INSERT INTO Organizer VALUES ('kkkchen@hotmail.com','Kevin Chen','604-789-2051');
INSERT INTO Organizer VALUES ('andyn3@hotmail.com','Andy Nguyen','604-203-6209');
INSERT INTO Organizer VALUES ('beaufortm@live.com','Monica Beaufort','635-129-5802');
INSERT INTO Organizer VALUES ('clairdelune7@yahoo.com','Clair Mathis','778-221-1593');
INSERT INTO Organizer VALUES ('harryds@bing.com','Harry De Santiago','778-373-5944');
INSERT INTO Organizer VALUES ('aster.l@gmail.com','Aster Lu','604-209-5328');

INSERT INTO Caterer VALUES('Tim Horton''s', 3070);
INSERT INTO Caterer VALUES('Subway', 500);
INSERT INTO Caterer VALUES('Domino''s Pizza', 800);
INSERT INTO Caterer VALUES('Canadian Liquor Store', 2000);
INSERT INTO Caterer VALUES('Purdy''s Chocolates', 440);

INSERT INTO ParticipantSchool VALUES ('UBC','Vancouver, BC');
INSERT INTO ParticipantSchool VALUES ('SFU','Burnaby, BC');
INSERT INTO ParticipantSchool VALUES ('UW','Waterloo, ON');
INSERT INTO ParticipantSchool VALUES ('UofT','Toronto, ON');
INSERT INTO ParticipantSchool VALUES ('UVic','Victoria, BC');

INSERT INTO Guest VALUES(1, 'Santa Oyes');
INSERT INTO Guest VALUES(2, 'Leo Ramirez');
INSERT INTO Guest VALUES(3, 'Amelia-Grace Campos');
INSERT INTO Guest VALUES(4, 'Sian Molloy');
INSERT INTO Guest VALUES(5, 'Kaydan Kirk');
INSERT INTO Guest VALUES(6, 'Dante Baird');
INSERT INTO Guest VALUES(7, 'Zainab Dolan');
INSERT INTO Guest VALUES(8, 'Iylah Ramsey');
INSERT INTO Guest VALUES(9, 'Wendy Carrillo');
INSERT INTO Guest VALUES(10, 'Kwabena Hale');
INSERT INTO Guest VALUES(11, 'Joao Fellows');
INSERT INTO Guest VALUES(12, 'Fynley Figueroa');
INSERT INTO Guest VALUES(13, 'Christine Francis');
INSERT INTO Guest VALUES(14, 'Yahya Schaefer');
INSERT INTO Guest VALUES(15, 'Finnian Wharton');
INSERT INTO Guest VALUES(16, 'Daanyaal Hernandez');
INSERT INTO Guest VALUES(17, 'Reyansh Chaudhri');

--------------------------- Group 2 INSERT -------------------------------
INSERT INTO Participant VALUES (1,'Amy Huynh','amyh32@gmail.com','UBC');
INSERT INTO Participant VALUES (2,'Laurel Swanson','lswan@gmail.com','UBC');
INSERT INTO Participant VALUES (3,'Zuzanna Spooner','aforkandaspoon@hotmail.com','SFU');
INSERT INTO Participant VALUES (4,'Florrie Tate','florriexd@gmail.com','UBC');
INSERT INTO Participant VALUES (5,'Aiysha Little','little.aiysh@yahoo.com','UW');
INSERT INTO Participant VALUES (6,'Alannah Serrano','alannah.serrano@hotmail.com','UW');
INSERT INTO Participant VALUES (7,'Malikah Mcfarlane','purple_dinosaur@gmail.com','UofT');
INSERT INTO Participant VALUES (8,'Elliott Finley','elliotfinleyy@gmail.com','UBC');
INSERT INTO Participant VALUES (9,'Thiago Beltran','thiagoisme@live.com','UVic');
INSERT INTO Participant VALUES (10,'Aj Dale','saymy_name@hotmail.com','UBC');

INSERT INTO Hackathon VALUES('nwHucks', 'maryzhang@gmail.com', TO_DATE('2021/01/13 08:00:00', 'yyyy/mm/dd hh24:mi:ss'), 'Vancouver, BC');
INSERT INTO Hackathon VALUES('cmdM','itsjen@hotmail.com', TO_DATE('2021/03/12 13:00:00', 'yyyy/mm/dd hh24:mi:ss'), 'Vancouver, BC');
INSERT INTO Hackathon VALUES('HuckCamp','notrickyweston@gmail.com', TO_DATE('2021/10/25 11:00:00', 'yyyy/mm/dd hh24:mi:ss'), 'Vancouver, BC');
INSERT INTO Hackathon VALUES('Code the Difference','itsjen@hotmail.com', TO_DATE('2021/7/15 12:00:00', 'yyyy/mm/dd hh24:mi:ss'), 'Burnaby, BC');
INSERT INTO Hackathon VALUES('Huckleberry Finn', 'notrickyweston@gmail.com', TO_DATE('2021/12/12 07:00:00', 'yyyy/mm/dd hh24:mi:ss'), 'Surrey, BC');
INSERT INTO Hackathon VALUES('ChillyHucks', 'andyn3@hotmail.com', TO_DATE('2021/6/21 15:00:00', 'yyyy/mm/dd hh24:mi:ss'), 'Chilliwack, BC');

INSERT INTO SponsorshipOutreach VALUES('aster.l@gmail.com', 'Technology');
INSERT INTO SponsorshipOutreach VALUES('harryds@bing.com', 'Finance');
INSERT INTO SponsorshipOutreach VALUES('beaufortm@live.com', 'Consumer');
INSERT INTO SponsorshipOutreach VALUES('eastofeden@gmail.com', 'Entertainment');
INSERT INTO SponsorshipOutreach VALUES('hannahhayes@ubc.ca', 'Manufacturing');

INSERT INTO MarketingRecruitment VALUES('kevinli@gmail.com', 'Twitter');
INSERT INTO MarketingRecruitment VALUES('robsonstreet@live.com', 'Facebook');
INSERT INTO MarketingRecruitment VALUES('wilburdmitriyev@gmail.com', 'Instagram');
INSERT INTO MarketingRecruitment VALUES('lilypad101@hotmail.com', 'TikTok');
INSERT INTO MarketingRecruitment VALUES('clairdelune7@yahoo.com', 'LinkedIn');

INSERT INTO Hospitality VALUES('harriet.092@hotmail.com', 'Tim Horton''s');
INSERT INTO Hospitality VALUES('n.jordan@gmail.com', 'Subway');
INSERT INTO Hospitality VALUES('adnaan_bread@yahoo.com', 'Domino''s Pizza');
INSERT INTO Hospitality VALUES('jeff.brew@hotmail.com', 'Canadian Liquor Store');
INSERT INTO Hospitality VALUES('kkkchen@hotmail.com', 'Purdy''s Chocolates');

INSERT INTO Mentor VALUES(4, 'Python', 'Machine Learning');
INSERT INTO Mentor VALUES(5, 'C', 'IoT');
INSERT INTO Mentor VALUES(10, 'SQL', 'Databases');
INSERT INTO Mentor VALUES(14, 'Javascript', 'Web Development');
INSERT INTO Mentor VALUES(15, 'Java', 'Backend');
INSERT INTO Mentor VALUES(17, 'Swift', 'iOS');

INSERT INTO GuestSpeaker VALUES(1, 'I Am Once Again Asking');
INSERT INTO GuestSpeaker VALUES(7, 'Saving the Planet through Technology');
INSERT INTO GuestSpeaker VALUES(8, 'Saving the Planet through Technology');
INSERT INTO GuestSpeaker VALUES(14, 'The Superiority of Dynamically-typed Languages');
INSERT INTO GuestSpeaker VALUES(3, 'Networking Tips: How To Remember Someone''s Name');
INSERT INTO GuestSpeaker VALUES(12, 'Connecting Industry to Code');

--------------------------- Group 3 INSERT -------------------------------
INSERT INTO Company VALUES ('Macrohard','eastofeden@gmail.com','604-232-3632','info@macrohard.com');
INSERT INTO Company VALUES ('Rainforest','harryds@bing.com','235-547-7347','support@rainforest.com');
INSERT INTO Company VALUES ('Goggle','aster.l@gmail.com','604-882-7313','goggle@goggle.com');
INSERT INTO Company VALUES ('StickerDonkey','hannahhayes@ubc.ca','604-830-4540','hr@stickerdonkey.com');
INSERT INTO Company VALUES ('Chirpsuite','beaufortm@live.com','888-628-9074','bird@chirpsuite.com');

INSERT INTO Volunteer VALUES ('1','robsonstreet@live.com','Naveed Gonzales','Tech Support','ngonzales@hotmail.com','604-735-2247');
INSERT INTO Volunteer VALUES ('2','wilburdmitriyev@gmail.com','Meghan Dillard','General Assistance','megh.dill89@gmail.com','778-288-4785');
INSERT INTO Volunteer VALUES ('3','lilypad101@hotmail.com','Mustafa Derrick','Runner','d_mustafaax@gmail.com','435-036-7441');
INSERT INTO Volunteer VALUES ('4','robsonstreet@live.com','King Perez','Tech Support','iamtheking@live.com','888-757-8748');
INSERT INTO Volunteer VALUES ('5','robsonstreet@live.com','Jamel Hastings','Tech Support','strawberry-jam123@yahoo.ca','604-203-6930');
INSERT INTO Volunteer VALUES ('6','kevinli@gmail.com','Aras Golden','General Assistance','arasg@gmail.com','604-774-0474');
INSERT INTO Volunteer VALUES ('7','robsonstreet@live.com','Allie Yoshida','Runner','allielovesyou@hotmail.com','778-989-6675');

--------------------------- Group 4 INSERT -------------------------------
INSERT INTO CompanyRepresentative VALUES(2, 'StickerDonkey');
INSERT INTO CompanyRepresentative VALUES(6, 'Chirpsuite');
INSERT INTO CompanyRepresentative VALUES(7, 'Rainforest');
INSERT INTO CompanyRepresentative VALUES(8, 'Rainforest');
INSERT INTO CompanyRepresentative VALUES(11, 'Goggle');
INSERT INTO CompanyRepresentative VALUES(16, 'StickerDonkey');

--------------------------- Group 5 INSERT -------------------------------
INSERT INTO Workshop VALUES ('Git 101: How to use the popular VCS','14:00:00','230');
INSERT INTO Workshop VALUES ('Introduction to Python','16:00:00','100A');
INSERT INTO Workshop VALUES ('Getting Started with Goggle Cloud Tools','09:00:00','3305');
INSERT INTO Workshop VALUES ('Architecture of Cup Towers','19:00:00','7');
INSERT INTO Workshop VALUES ('Surviving the Night at a Hackathon','21:00:00','444');

INSERT INTO HelpsRun VALUES(1, 'nwHucks');
INSERT INTO HelpsRun VALUES(1, 'cmdM');
INSERT INTO HelpsRun VALUES(1, 'HuckCamp');
INSERT INTO HelpsRun VALUES(1, 'Code the Difference');
INSERT INTO HelpsRun VALUES(1, 'Huckleberry Finn');
INSERT INTO HelpsRun VALUES(1, 'ChillyHucks');
INSERT INTO HelpsRun VALUES(2, 'nwHucks');
INSERT INTO HelpsRun VALUES(3, 'nwHucks');
INSERT INTO HelpsRun VALUES(4, 'Code the Difference');
INSERT INTO HelpsRun VALUES(5, 'Huckleberry Finn');
INSERT INTO HelpsRun VALUES(6, 'nwHucks');
INSERT INTO HelpsRun VALUES(6, 'Code the Difference');
INSERT INTO HelpsRun VALUES(7, 'cmdM');
INSERT INTO HelpsRun VALUES(7, 'ChillyHucks');

INSERT INTO Contains VALUES('nwHucks', 'Introduction to Python');
INSERT INTO Contains VALUES('nwHucks', 'Getting Started with Goggle Cloud Tools');
INSERT INTO Contains VALUES('cmdM', 'Git 101: How to use the popular VCS');
INSERT INTO Contains VALUES('Code the Difference', 'Surviving the Night at a Hackathon');
INSERT INTO Contains VALUES('Code the Difference', 'Git 101: How to use the popular VCS');
INSERT INTO Contains VALUES('ChillyHucks', 'Architecture of Cup Towers');

INSERT INTO RegistersFor VALUES(1, 'Introduction to Python');
INSERT INTO RegistersFor VALUES(2, 'Introduction to Python');
INSERT INTO RegistersFor VALUES(10, 'Git 101: How to use the popular VCS');
INSERT INTO RegistersFor VALUES(10, 'Architecture of Cup Towers');
INSERT INTO RegistersFor VALUES(7, 'Surviving the Night at a Hackathon');

INSERT INTO ParticipatesIn VALUES(1, 'nwHucks');
INSERT INTO ParticipatesIn VALUES(2, 'nwHucks');
INSERT INTO ParticipatesIn VALUES(3, 'cmdM');
INSERT INTO ParticipatesIn VALUES(4, 'HuckCamp');
INSERT INTO ParticipatesIn VALUES(5, 'nwHucks');
INSERT INTO ParticipatesIn VALUES(6, 'Code the Difference');
INSERT INTO ParticipatesIn VALUES(7, 'Code the Difference');
INSERT INTO ParticipatesIn VALUES(8, 'Huckleberry Finn');
INSERT INTO ParticipatesIn VALUES(9, 'nwHucks');
INSERT INTO ParticipatesIn VALUES(10, 'ChillyHucks');
INSERT INTO ParticipatesIn VALUES(10, 'cmdM');

INSERT INTO Sponsors VALUES('nwHucks', 'Macrohard');
INSERT INTO Sponsors VALUES('nwHucks', 'StickerDonkey');
INSERT INTO Sponsors VALUES('Code the Difference', 'Rainforest');
INSERT INTO Sponsors VALUES('Huckleberry Finn', 'Chirpsuite');
INSERT INTO Sponsors VALUES('ChillyHucks', 'Goggle');

INSERT INTO Mentors VALUES(5, 4);
INSERT INTO Mentors VALUES(10, 6);
INSERT INTO Mentors VALUES(14, 1);
INSERT INTO Mentors VALUES(15, 9);
INSERT INTO Mentors VALUES(17, 10);

INSERT INTO Attends VALUES(1, 'nwHucks');
INSERT INTO Attends VALUES(1, 'cmdM');
INSERT INTO Attends VALUES(5, 'HuckCamp');
INSERT INTO Attends VALUES(10, 'Code the Difference');
INSERT INTO Attends VALUES(12, 'Code the Difference');
