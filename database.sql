create database journal2;
create user 'journal'@'localhost' IDENTIFIED BY 'journal123';
Grant ALL privileges on  journal2.* TO 'journal'@'localhost';
use journal2;
create table admins(
	name varchar(32) NOT NULL,
        password varchar(32) NOT NULL,
        PRIMARY KEY (name) 
);
create table blueface_data(
	pnumber varchar(32) NOT NULL, 
	account  varchar(32) NOT NULL,
	password varchar(32) NOT NULL,
	mailbox varchar(20),
	pin  varchar(32),
        name varchar(32),
        mail varchar(20),
	PRIMARY KEY (pnumber)
);
create table office_phones(
	       mac varchar(32) NOT NULL,
	       pnumber  varchar(32) NOT NULL,
	       users varchar(20) NOT NULL,
	       location varchar(20) NOT NULL,
	       status  varchar(20) NOT NULL,
	       PRIMARY KEY (mac),
	       FOREIGN KEY (pnumber) references blueface_data (pnumber)
);


