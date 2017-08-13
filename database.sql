create database journal2;
create user 'journal'@'localhost' IDENTIFIED BY 'journal123';
Grant ALL privileges on  journal2.* TO 'journal'@'localhost';
use journal2;
create table voicemail(
	mailbox varchar(32) NOT NULL,
       	pin  varchar(32) NOT NULL,
	name varchar(32) NOT NULL,
	mail varchar(20) NOT NULL,
	PRIMARY KEY (mailbox)
);
create table numbers(
	numbers varchar(32) NOT NULL, 
	account  varchar(32) NOT NULL,
	password varchar(32) NOT NULL,
	mailbox varchar(20),
	PRIMARY KEY (numbers),
	FOREIGN KEY (mailbox) references voicemail(mailbox)
);
create table phones(
	       mac varchar(32) NOT NULL,
	       numbers  varchar(32) NOT NULL,
	       users varchar(20) NOT NULL,
	       location varchar(20) NOT NULL,
	       status  varchar(20) NOT NULL,
	       PRIMARY KEY (mac),
	       FOREIGN KEY (numbers) references numbers(numbers)
);


