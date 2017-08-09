create database journal2;
create user 'journal'@'localhost' IDENTIFIED BY 'journal123';
Grant ALL privileges on  journal2.* TO 'journal'@'localhost';
use journal2;
create table blueface(
	       id  varchar(32) NOT NULL,
	       nphone varchar(20) NOT NULL,
	       voicemail  varchar(20) NOT NULL,
	       PRIMARY KEY (id)
);


create table office(
       mac varchar(32) NOT NULL,
       id  varchar(32) NOT NULL,
       password varchar(32) NOT NULL,
       users varchar(20) NOT NULL,
       location varchar(20) NOT NULL,
       status  varchar(20) NOT NULL,
       PRIMARY KEY (mac)
       FOREIGN KEY (id) references blueface(id)
);
