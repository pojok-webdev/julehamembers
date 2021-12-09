select a.id,a.name,a.cp,a.address,a.phone,a.district from locations a 
left outer join (select id from receipts where monthyear="012021") b on b.id=a.id 
where b.id is not null ;


--paid--
select a.id,a.name,a.cp,a.address,a.phone,a.district from locations a 
right outer join (select id from receipts where monthyear="012021") b on b.id=a.id  ;

select a.id,a.name,a.cp,a.address,a.phone,a.district,monthyear from locations a 
right outer join (select id,monthyear from receipts) b on b.id=a.id  ;
