drop table Persons;

create table Persons
(
  PId int not null auto_increment,
  PName varchar(255) not null unique,
  primary key (PId)
);

insert into Persons (PName) values ('Amy');
insert into Persons (PName) values ('Bob');
insert into Persons (PName) values ('Cun');

