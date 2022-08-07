create database parking;

use parking;

create table parked(
    id int primary key auto_increment,
    client varchar(255),
    modelCar varchar(100),
    licensePlate varchar (20),
    timeStart  datetime,
    timeEnd datetime,
    price decimal(10,2)
);

DROP TABLE  parked;

insert into parked values
    (NULL, 'Joel Irineu', 'Fiat Uno', 'ABC-1234', '2022-08-07 17:30:22', '2022-08-07 20:32:41', 0.00),
    (NULL, 'João Gabriel', 'Pallio', 'CBA-4321', '2022-08-07 14:20:12', '2022-08-07 17:35:20', 0.00);

select * from parked;