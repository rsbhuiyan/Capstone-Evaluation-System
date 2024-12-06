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

insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('admin', 'admin', 'admin@wayne.edu', '$2y$10$mYjiy6nqyT4Z/l3GSqC1yep7BcQDyo.0t6F0zket8J6gPO3.XVWfG', 'admin', 1); -- password = pass 
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Katie', 'Jones', 'professor@wayne.edu', '$2y$10$WeVeb4H1sNlNh9egL4BveO8j8yFhD1VxVZbMx2EffWRsSVx53b1ly', 'professor', 1); -- password = pass123 
insert into users ( firstname, lastname, email, pass, roleofuser, activeUser) values ('Adam', 'Ryans', 'gta@wayne.edu', '$2y$10$9DKsHs/B8imDo6rC1k5/tO4K6611Rt5SQUTjG2xwPXIHaFyFA/FGS', 'GTA', 1); -- password = test12 
