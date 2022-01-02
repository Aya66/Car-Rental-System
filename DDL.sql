Create database CarRentalSystem;

Use CarRentalSystem;

create table car(
    plate_id int not null,
    model varchar(225) not null,
    body varchar(225) not null,
    brand varchar(225) not null,
    color varchar(225) not null,
    year int,
    status varchar(225),
    PRIMARY KEY (plate_id)
);

create table customer(
    customer_id int not null AUTO_INCREMENT,
    first_name varchar(225) not null,
    last_name varchar(225) not null,
    password varchar(225) not null,
    email varchar(225) not null,
    age int,
    birthdate DATE,
    gender varchar(225),
    country varchar(225),
    PRIMARY KEY (customer_id)
);

create table reservation(
    customer_id int not null,
    plate_id int not null,
    reservation_date DATE not null,
    PRIMARY KEY (customer_id, plate_id)
);

ALTER TABLE reservation
ADD FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
ADD FOREIGN KEY (plate_id) REFERENCES car(plate_id);