create database parking;

use parking;

create table parked(
    id int primary key,
    client varchar(255),
    modelCar varchar(100),
    licensePlate vachar (20),
    timeStart  timestamp default current_timestamp,
    timeEnd timestamp default current_timestamp,
    price float
);