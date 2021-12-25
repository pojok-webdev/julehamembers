 create table receipts(id int primary key auto_increment,location_id int,monthyear varchar(6),paymentdate date,createdate timestamp default current_timestamp);
drop table if exists receipts;
create table receipts (id int,monthyear varchar(6),paymentdate date,createdate timestamp default current_timestamp());

-- yang belum bayar --
 select a.id,a.name,a.cp,a.address,a.cp,a.phone,a.district from locations a 
 left outer join receipts b on b.location_id=a.id 
 where b.id is null;