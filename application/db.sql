drop table if exists members;
create table members (id int primary key auto_increment,gender varchar(1) default '1',memberlevel varchar(1) default '2' comment '0 superadmin,1 admin,2 ordinary',nickname varchar(50),firstname varchar(20),middlename varchar(20),lastname varchar(50),region varchar(4),address varchar(200),birthdate date,birthcity varchar(50),nik varchar(20),juleha_id varchar(20),position varchar(200),password varchar(50),mstatus varchar(1) default '1',createdate timestamp default current_timestamp());

create  table certificates (id int primary key auto_increment,member_id int,subject varchar(50),certificatedate date,createdate timestamp default current_timestamp);

create table contacts(id int primary key auto_increment,member_id int, phone varchar(20),status varchar(1),createdate timestamp default current_timestamp);

create table notes (id int primary key auto_increment, description text,createdate timestamp default current_timestamp);

create table portofolio (id int primary key auto_increment,member_id int,eventdate date,subject text,createdate timestamp default current_timestamp);
create table insurances (id int primary key auto_increment,member_id int,name varchar(50),grade varchar(20),createdate timestamp default current_timestamp);
create table trainings (id int primary key auto_increment,member_id int,eventdate date,subject text,createdate timestamp default current_timestamp);
