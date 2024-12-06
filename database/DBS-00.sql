use ccesdb;
DROP TABLE IF EXISTS pwdReset;
DROP TABLE IF EXISTS studentGrade;
DROP TABLE IF EXISTS gradeGroup;
DROP TABLE IF EXISTS weeklyReportsEval;
DROP TABLE IF EXISTS weeklyReports;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS gtaAssignment;
DROP TABLE IF EXISTS groupTable;
DROP TABLE IF EXISTS section;
drop table if exists comments;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS semester;
DROP VIEW If Exists groupview;
DROP VIEW if exists alphabetical;

CREATE TABLE semester(
        semesterid integer AUTO_INCREMENT,
        semester_name VARCHAR(12), 
        startDate timestamp,
        endDate timestamp,
        PRIMARY KEY (semesterid)
);

CREATE TABLE users(
	userid integer AUTO_INCREMENT,
	firstname varchar(20),
	lastname varchar(20),
	email varchar(255) NOT NULL,
	pass varchar(255),
  	roleofuser enum('admin', 'professor', 'GTA'),
	primary key (userid),
	activeUser integer
);
CREATE TABLE section(
        sectionid integer AUTO_INCREMENT,
        section_name VARCHAR(12),
        semesterid integer,
        professor integer,
        PRIMARY KEY (sectionid),
        FOREIGN KEY(professor) REFERENCES users(userid),
        FOREIGN KEY(semesterid) REFERENCES semester(semesterid)
);

CREATE TABLE groupTable( 
    groupid integer auto_increment,
    sectionid integer, 
    groupName varchar(50), 
    primary key(groupid), 
    foreign key(sectionid) REFERENCES section(sectionid)
);

CREATE TABLE gtaAssignment(
  gtaAssignmentid integer AUTO_INCREMENT,
  sectionid integer, 
  gta integer,
  groupid integer,
  Primary key(gtaAssignmentid),
  foreign key(sectionid) REFERENCES section(sectionid), 
  FOREIGN KEY(gta) REFERENCES users(userid),
  foreign key(groupid) REFERENCES groupTable(groupid)
 ); 
CREATE TABLE students(
	studentid integer AUTO_INCREMENT,
	accessID varchar(50) NOT NULL, 
	activeStudent integer,
	sectionid integer,
	groupid integer,
	name varchar(50),
	primary key (studentid),
	foreign key(sectionid) REFERENCES section(sectionid),
	foreign key(groupid) REFERENCES groupTable(groupid)
);

CREATE TABLE weeklyReports(
	weekid integer AUTO_INCREMENT,
	week integer,
	dateSubmitted timestamp,
	submitted enum('on time', 'late submission', 'no submission', 'revoked'),
	status enum('advanced', 'good', 'achieved', 'behind'),
	studentid integer,
	groupid integer,
	PRIMARY KEY(weekid),
	FOREIGN KEY(studentid) REFERENCES students(studentid),
	FOREIGN KEY(groupid) REFERENCES groupTable(groupid)
);
CREATE TABLE weeklyReportsEval(
	weeklyEvalid integer AUTO_INCREMENT,
	evaluation TEXT,
	weekid INTEGER,
	PRIMARY KEY(weeklyEvalid),
	FOREIGN KEY(weekid) REFERENCES weeklyReports(weekid)
);
CREATE TABLE gradeGroup(
	gradeGroupid integer AUTO_INCREMENT,
	assignment varchar(50),
	dateSubmitted timestamp,
	documentGrade varchar(2),
    consistency varchar(2),
    consistencyNotes TEXT,
    grammar varchar(2),
    grammarNotes TEXT,
    functionality varchar(2),
    functionalityNotes TEXT,
    groupStatus varchar(10),
    statusNotes TEXT,
    topicsCorrectness varchar(2),
    topicsNotes TEXT,
    resubmitDocument varchar(3),
	groupNotes TEXT,
	hasClient varchar(3),
	clientSatisfied varchar(3),
	clientNotes TEXT,
	givenByUser integer,
	groupid integer,
	PRIMARY KEY(gradeGroupid),
	FOREIGN KEY(groupid) REFERENCES groupTable(groupid),
	FOREIGN KEY(givenByUser) REFERENCES users(userid)
);

CREATE TABLE studentGrade(
	studentGradeid integer AUTO_INCREMENT,
	studentid integer,
    presentationGrade varchar(2),
	notes TEXT,
	gradeGroupid INTEGER,
    githubActivity varchar(2),
	PRIMARY KEY(studentGradeid),
    FOREIGN KEY(studentid) REFERENCES students(studentid),
	FOREIGN KEY(gradeGroupid) REFERENCES gradeGroup(gradeGroupid)
);

CREATE table pwdReset(
    pwdResetId integer PRIMARY KEY auto_increment NOT NULL,
    pwdResetEmail TEXT NOT NULL,
    pwdResetSelector TEXT NOT NULL,
    pwdResetToken LONGTEXT NOT NULL,
    pwdResetExpires TEXT NOT NULL
);
CREATE TABLE comments (
commentid integer NOT NULL PRIMARY KEY auto_increment,
 commentText text NOT NULL,
 dateSubmitted timestamp,
 status integer,
 studentid integer,
 givenByUser integer,
 givenToUser integer,
 FOREIGN KEY(studentid) REFERENCES users(userid),
 FOREIGN KEY(givenByUser) REFERENCES users(userid),
 FOREIGN KEY(givenToUser) REFERENCES users(userid)
) ;
CREATE VIEW groupview AS
select groupTable.groupid, groupTable.groupName, students.name, users.firstname, users.lastname, users.userid, students.studentid, gtaAssignment.gta, grouptable.sectionid
from groupTable, students, gtaAssignment, users
where grouptable.groupid = students.groupid AND grouptable.groupid = gtaAssignment.groupid AND gtaAssignment.gta = users.userid;

create view alphabetical as 
SELECT studentid, sectionid, 
   SUBSTRING_INDEX(SUBSTRING_INDEX(name, ' ', 1), ' ', -1) AS first_name,
    TRIM( SUBSTR(name, LOCATE(' ', name)) ) AS last_name, activeStudent
FROM students
WHERE groupid is NULL
Order by last_name;

insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('admin', 'admin', 'admin@wayne.edu', '$2y$10$mYjiy6nqyT4Z/l3GSqC1yep7BcQDyo.0t6F0zket8J6gPO3.XVWfG', 'admin', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Katie', 'Jones', 'professor@wayne.edu', '$2y$10$WeVeb4H1sNlNh9egL4BveO8j8yFhD1VxVZbMx2EffWRsSVx53b1ly', 'professor', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('John', 'Smith', 'js1234@wayne.edu', '$2y$10$9DKsHs/B8imDo6rC1k5/tO4K6611Rt5SQUTjG2xwPXIHaFyFA/FGS', 'GTA', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Behzad', 'Hejrati', 'hm8309@wayne.edu', '$2y$10$9DKsHs/B8imDo6rC1k5/tO4K6611Rt5SQUTjG2xwPXIHaFyFA/FGS', 'GTA', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Adrian', 'Tarnowski', 'gta@wayne.edu', '$2y$10$9DKsHs/B8imDo6rC1k5/tO4K6611Rt5SQUTjG2xwPXIHaFyFA/FGS', 'GTA', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Asif', 'Turzo', 'gx1094wayne.edu', '$2y$10$9DKsHs/B8imDo6rC1k5/tO4K6611Rt5SQUTjG2xwPXIHaFyFA/FGS', 'GTA', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Avery', 'Turnor', 'at0234@wayne.edu', '$2y$10$9DKsHs/B8imDo6rC1k5/tO4K6611Rt5SQUTjG2xwPXIHaFyFA/FGS', 'GTA', 1);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Marco', 'Detel', 'hg9234@wayne.edu', '$2y$10$WeVeb4H1sNlNh9egL4BveO8j8yFhD1VxVZbMx2EffWRsSVx53b1ly', 'professor', 0);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Ryan', 'Adams', 'ra2398@wayne.edu', '$2y$10$WeVeb4H1sNlNh9egL4BveO8j8yFhD1VxVZbMx2EffWRsSVx53b1ly', 'professor', 0);
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Thomas', 'Coco', 'tc8395@wayne.edu', '$2y$10$WeVeb4H1sNlNh9egL4BveO8j8yFhD1VxVZbMx2EffWRsSVx53b1ly', 'professor', 1);

insert into students(studentid, accessid) values (-1, 'zz0000');
insert into semester (semester_name, startDate, endDate) VALUES ('Winter2021', STR_TO_DATE('2021-01-10', '%Y-%m-%d'), STR_TO_DATE('2022-04-23', '%Y-%m-%d')); 
insert into section (section_name, semesterid, professor) VALUES ('Section001', 1, 8);

insert into section (section_name, semesterid, professor) VALUES ('Section002', 1, 2);
insert into semester (semester_name, startDate, endDate) VALUES ('Fall2021', STR_TO_DATE('2021-08-30', '%Y-%m-%d'), STR_TO_DATE('2021-12-02', '%Y-%m-%d')); 
insert into section (section_name, semesterid, professor) VALUES ('Section003', 2, 8);
insert into section (section_name, semesterid, professor) VALUES ('Section004', 2, 8);
insert into semester (semester_name, startDate, endDate) VALUES ('Winter2022', STR_TO_DATE('2022-01-10', '%Y-%m-%d'), STR_TO_DATE('2022-04-23', '%Y-%m-%d')); 
insert into section (section_name, semesterid, professor) VALUES ('Section005', 3, 2);
insert into section (section_name, semesterid, professor) VALUES ('Section006', 3, 2);
insert into semester (semester_name, startDate, endDate) VALUES ('Fall2022', STR_TO_DATE('2022-08-30', '%Y-%m-%d'), STR_TO_DATE('2022-12-02', '%Y-%m-%d')); 
insert into section (section_name, semesterid, professor) VALUES ('Section007', 4, 8);
insert into section (section_name, semesterid, professor) VALUES ('Section008', 4, 8);
insert into semester (semester_name, startDate, endDate) VALUES ('Winter2023', STR_TO_DATE('2023-01-09', '%Y-%m-%d'), STR_TO_DATE('2023-04-22', '%Y-%m-%d')); 
insert into section (section_name, semesterid, professor) VALUES ('Section111', 5, 2);
insert into groupTable (sectionid, groupName) VALUES (9, 'Capstone Course Evaluation System');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gv6830', 1, 9, 1, 'Cristina Powers');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gv6840', 1, 9, 1, 'Abigail Noyes');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gh6840', 1, 9, 1, 'Raad Bhuiyan');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gi6130', 1, 9, 1, 'Bharath Palanisamy');
insert into gtaAssignment(sectionid, gta, groupid) values (9,5,1);
insert into groupTable (sectionid, groupName) VALUES (9, 'Kinder Mind');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gg6530', 1, 9, 2, 'Nahidul Kamran');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gj6120', 1, 9, 2, 'Nusrat Chuwdhury');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gh6f40', 1, 9, 2, 'Sadia Chowdhury');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gi7130', 1, 9, 2, 'Anika Rahman');
insert into gtaAssignment(sectionid, gta, groupid) values (9,4,2);
insert into groupTable (sectionid, groupName) VALUES (9, 'Games for Visually Impaired');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('gp9700', 1, 9, 3, 'Ashvin Adapa');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('lh2340', 1, 9, 3, 'Raja Moussa');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ki9130', 1, 9, 3, 'Farid Baalbaki');
insert into gtaAssignment(sectionid, gta, groupid) values (9,5,3);
insert into groupTable (sectionid, groupName) VALUES (9, 'Wayne Poll');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('by8375', 1, 9, 4, 'John Pagulayan');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('mk8240', 1, 9, 4, 'Donovan Galloway');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ow8591', 1, 9, 4, 'Tanjim Rahman');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('kf9475', 1, 9, 4, 'Richard Breslin');
insert into gtaAssignment(sectionid, gta, groupid) values (9,6,4);
insert into groupTable (sectionid, groupName) VALUES (9, 'Sales/Business Trends');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('jr8596', 1, 9, 5, 'Caitleen Joie Fuertez');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('mv2934', 1, 9, 5, 'Weronika Centa');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('al0274', 1, 9, 5, 'Jim Uc');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('mf8024', 1, 9, 5, 'Parker Mckowen');
insert into gtaAssignment(sectionid, gta, groupid) values (9,5,5);
insert into groupTable (sectionid, groupName) VALUES (9, 'Recipeal');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('lw0385', 1, 9, 6, 'Tyler Groat');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('nf9235', 1, 9, 6, 'Jaideep Chunduri');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('po3245', 1, 9, 6, 'Gavin Fromm');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('bk0284', 1, 9, 6, 'Waheedalam Laskar');
insert into gtaAssignment(sectionid, gta, groupid) values (9,6,6);
insert into groupTable (sectionid, groupName) VALUES (9, 'Mystery Trivia');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ms2094', 1, 9, 7, 'Jason Marrone');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('me9240', 1, 9, 7, 'Mohammed Rubel');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('aj2834', 1, 9, 7, 'Austin Jeffery');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('vc0253', 1, 9, 7, 'Mohammed Chokr');
insert into gtaAssignment(sectionid, gta, groupid) values (9,4,7);
insert into groupTable (sectionid, groupName) VALUES (9, 'VR Training Tool');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('si0184', 1, 9, 8, 'Slav Ivaskiv');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ll0238', 1, 9, 8, 'Luka Cvetko');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('jc9358', 1, 9, 8, 'Jeremy Cavallo');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('rt7391', 1, 9, 8, 'Robert Tedeschi');
insert into gtaAssignment(sectionid, gta, groupid) values (9,6,8);
insert into groupTable (sectionid, groupName) VALUES (9, 'MICA');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('si0184', 1, 9, 9, 'Saif Khan');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ll0238', 1, 9, 9, 'Mohammad Razzaq');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('jc9358', 1, 9, 9, 'Nader Rahman');
insert into gtaAssignment(sectionid, gta, groupid) values (9,6,9);
insert into section (section_name, semesterid, professor) VALUES ('Section010', 5, 2);
insert into groupTable (sectionid, groupName) VALUES (10, 'Mercury');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ow8430', 1, 10, 10, 'Micheal Thomaz');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('vn8244', 1, 10, 10, 'John Willaims');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('mf9237', 1, 10, 10, 'Kylie Dubey');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ks0348', 1, 10, 10, 'Lydia Tan');
insert into gtaAssignment(sectionid, gta, groupid) values (10,7,10);
insert into students (accessID, activeStudent, sectionid,  name) VALUES ('ks9245', 0, 1, 'Taylor Luther');
insert into groupTable (sectionid, groupName) VALUES (10, 'Event Management System');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ks9245', 1, 10, 11, 'Mario Lepeti');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('np0202', 1, 10, 11, 'Timothy Johnson');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('vb7465', 1, 10, 11, 'Fatima Khajaa');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('yw8264', 1, 10, 11, 'Asara Lima');
insert into gtaAssignment(sectionid, gta, groupid) values (10,7,11);
insert into groupTable (sectionid, groupName) VALUES (10, 'Virtual Closet');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ks9245', 1, 10, 12, 'Katherine Peterson');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('np0202', 1, 10, 12, 'Alexander Vu');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('vb7465', 1, 10, 12, 'Kristen Wang');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('yw8264', 1, 10, 12, 'Joshua Ranby');
insert into gtaAssignment(sectionid, gta, groupid) values (10,7,12);

insert into groupTable (sectionid, groupName) VALUES (1, 'Weather Forecasting System');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('po1234', 1, 1, 13, 'Messiah Daidalos');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('po5678', 1, 1, 13, 'Angelina Şebnem');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('po9012', 1, 1, 13, 'Artie Jaska');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('po3456', 1, 1, 13, 'Marion Tanesha');
insert into gtaAssignment(sectionid, gta, groupid) values (1,7,13);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Development Plan', STR_TO_DATE('2021-01-25', '%Y-%m-%d'), 'B-', 'B+', "consistency okay but could still need some work. they seem to know what they are talking about but it also feels like they are making stuff up.", 'A-', 'grammar notes','B', 'topics notes', 'yes', 'The group said the deadlines as the actual deadlines instead of few days before like I said', 8 ,13);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Software Requirement Specification', STR_TO_DATE('2021-02-01', '%Y-%m-%d'), 'A-', 'B-', "consistency okay",'B+', 'grammar notes', 'A', 'topics notes', 'yes', 'The group did a great job getting the requirements done and explaining them.', 8 ,13);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Design Plan', STR_TO_DATE('2021-02-27', '%Y-%m-%d'), 'B+', 'A-',"consistency okay", 'A', 'grammar notes', 'B-', 'topics notes','no', 'The design of the website needs to be more user friendly.', 8 ,13);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (48, 'B+', 'messiah is the team leader', 1);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (49, 'B+', 'angelina is on database side', 1);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (50, 'B-', 'artie is also on database side and QA', 1);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (51, 'B', 'marion is presentation lead', 1);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (48, 'B-', 'worked on functional requirements', 2);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (49, 'A-', 'create dataflow diagrams', 2);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (50, 'A', 'talk about the general knowledge', 2);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (51, 'B+', 'worked on nonfucntional requirements', 2);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (48, 'B-', 'went over use cases', 3);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (49, 'A-', 'went over archietecture', 3);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (50, 'A', 'went over class', 3);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (51, 'B+', 'went over UI of application', 3);
insert into gradegroup(assignment, dateSubmitted, documentGrade, groupNotes, givenByUser, groupid) VALUES ('Midterm', STR_TO_DATE('2021-03-25', '%Y-%m-%d'), 'B+', 'Midterm grade', 7 ,13);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (48, 'B+', 'midterm grade', 4);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (49, 'B', 'midterm grade', 4);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (50, 'A', 'midterm grade', 4);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (51, 'C+', 'midterm grade', 4);


insert into groupTable (sectionid, groupName) VALUES (1, 'Titan');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('oo1234', 1, 1, 14, 'Tòmas Akhmad');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('oo5678', 1, 1, 14, 'Rasmus Nevena');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('oo9012', 1, 1, 14, 'Consuelo Aynur');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('oo3456', 1, 1, 14, 'Elsie Desantis');
insert into gtaAssignment(sectionid, gta, groupid) values (1,7,14);
insert into groupTable (sectionid, groupName) VALUES (1, 'ChatBots');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao1234', 1, 1, 15, 'Jeanie Maryamu');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao5678', 1, 1, 15, 'Nil Greg');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao9012', 1, 1, 15, 'Denis Sveinn');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao3456', 1, 1, 15, 'Raffaella Bruno');
insert into gtaAssignment(sectionid, gta, groupid) values (1,7,15);

insert into groupTable (sectionid, groupName) VALUES (2, 'Under/Over');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('to1234', 1, 2, 16, 'Priscus Debbie');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('to5678', 1, 2, 16, 'Aloisio Laura');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('to9012', 1, 2, 16, 'Rocco Charibert');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('to3456', 1, 2, 16, 'Marion Tanesha');
insert into gtaAssignment(sectionid, gta, groupid) values (2,7,16);
insert into groupTable (sectionid, groupName) VALUES (2, 'Archietect Planning');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('wo1234', 1, 2, 17, 'Morgana Zakiya');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('wo5678', 1, 2, 17, 'Ethniu Rosa');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('wo9012', 1, 2, 17, 'Erwin Mammad');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('wo3456', 1, 2, 17, 'Fe Soma');
insert into gtaAssignment(sectionid, gta, groupid) values (2,7,17);
insert into groupTable (sectionid, groupName) VALUES (2, 'Christmas Charts');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao1234', 1, 2, 18, 'Andrei Ulrich');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao5678', 1, 2, 18, 'Saddam Mary Jo');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao9012', 1, 2, 18, 'Basima Sekhar');
insert into students (accessID, activeStudent, sectionid, groupid, name) VALUES ('ao3456', 1, 2, 18, 'Jan Sekai');
insert into gtaAssignment(sectionid, gta, groupid) values (2,7,18);

insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Development Plan', STR_TO_DATE('2023-01-25', '%Y-%m-%d'), 'B-', 'B+', "consistency okay but could still need some work. they seem to know what they are talking about but it also feels like they are making stuff up.", 'A-','grammar notes','B', 'topics notes', 'yes', 'The group said the deadlines as the actual deadlines instead of few days before like I said', 2 ,1);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Software Requirement Specification', STR_TO_DATE('2023-02-01', '%Y-%m-%d'), 'A-', 'B-', "consistency okay",'B+', 'grammar notes','A', 'topics notes', 'yes', 'The group did a great job getting the requirements done and explaining them.', 2 ,1);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, consistencyNotes, grammar, grammarNotes, topicsCorrectness, topicsNotes, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Design Plan', STR_TO_DATE('2023-02-27', '%Y-%m-%d'), 'B+', 'A-',"consistency okay", 'A','grammar notes','B-','topics notes', 'no', 'The design of the website needs to be more user friendly.', 2 ,1);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (1, 'B+', 'cristina is the team leader', 5);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (2, 'B+', 'abigail is on database side', 5);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (3, 'B-', 'raad is also on database side and QA', 5);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (4, 'B', 'bharath is presentation lead', 5);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (1, 'B-', 'worked on functional requirements', 6);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (2, 'A-', 'create dataflow diagrams', 6);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (3, 'A', 'talk about the general knowledge',6);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (4, 'B+', 'worked on nonfucntional requirements', 6);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (1, 'B-', 'went over use cases', 7);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (2, 'A-', 'went over archietecture', 7);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (3, 'A', 'went over class', 7);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (4, 'B+', 'went over UI of application', 7);

insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, grammar, topicsCorrectness, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Development Plan', STR_TO_DATE('2023-01-25', '%Y-%m-%d'), 'B', 'B-', 'A','B+', 'yes', 'Need to state when and where they are meeting because right now it looks like they are not having any meetings on their own.', 5 ,1);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, grammar, topicsCorrectness, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Software Requirement Specification', STR_TO_DATE('2023-02-01', '%Y-%m-%d'), 'A', 'A-', 'B+','A', 'yes', 'DFD should be labeled with data not words. Assumptions are not correct, need to be things they assume before coding', 5 ,1);
insert into gradegroup(assignment, dateSubmitted, documentGrade, consistency, grammar, topicsCorrectness, resubmitDocument, groupNotes, givenByUser, groupid) VALUES ('Design Plan', STR_TO_DATE('2023-02-27', '%Y-%m-%d'), 'B-', 'A', 'B','B-', 'yes', 'Sequence diagrams need work. Security needs to be about protocals and encryption', 5 ,1);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (1, 'B+', 'cristina is the team leader, Frontend team member, Presentation lead', 8);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (2, 'B+', 'abbey is Backend team member, Frontend QA, Documentation QA', 8);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (3, 'B-', 'raad is Backend team member, Presentation QA, Documentation QA', 8);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (4, 'B', 'bharath is Documentation Lead, Frontend team member, Backend QA ', 8);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (1, 'B-', 'cristina worked on the functional requirements', 9);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (2, 'A-', 'abbey made the DFD', 9);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (3, 'A', 'raad worked on the introduction section', 9);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (4, 'B+', 'bharath worked on the nonfunctional requirements', 9);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (1, 'B-', 'cristina worked on the use cases and sequence diagrams', 10);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (2, 'A-', 'abbey worked on archietecture design.', 10);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (3, 'A', 'raad worked on general constraints', 10);
insert into studentgrade(studentid, presentationGrade, notes, gradeGroupid) VALUES (4, 'B+', 'bharath did UI', 10);

insert into comments(commentText, datesubmitted, status, studentid, givenByUser, givenToUser)VALUES ('This person has been repeatedly behind in everything. They need to be addressed', STR_TO_DATE('2023-03-13', '%Y-%m-%d'),1, 1, 2, 5);
insert into comments(commentText, datesubmitted, status, studentid, givenByUser, givenToUser)VALUES ('This person has been repeatedly behind in everything. They need to be addressed This person has been repeatedly behind in everything. They need to be addressed This person has been repeatedly behind in everything. They need to be addressed This person has been repeatedly behind in everything. They need to be addressed', STR_TO_DATE('2023-03-13', '%Y-%m-%d'),1, 1, 2, 5);
