Create database CarRentalSystem;

Use CarRentalSystem;

create table car(
    plate_id int not null,
    model varchar(225) not null,
    body varchar(225) not null,
    brand varchar(225) not null,
    color varchar(225) not null,
    year int,
    status varchar(225), /* active or out of service */
    office_id int,
    price_day float,
    PRIMARY KEY (plate_id)
);

create table user(
    user_id int not null AUTO_INCREMENT,
    first_name varchar(225) not null,
    last_name varchar(225) not null,
    password varchar(225) not null,
    email varchar(225) not null,
    birthdate DATE not null,
    gender varchar(225),
    country varchar(225) not null,
    city varchar(225) not null,
    is_admin boolean not null,
    PRIMARY KEY (user_id)
);

create table reservation(
    reservation_id int not null unique AUTO_INCREMENT,
    user_id int not null,
    plate_id int not null,
    office_id int,
    reservation_date DATE not null,
    rental_date DATE,
    return_date DATE,
    paid boolean not null,
    rent_days int,
    PRIMARY KEY (user_id, plate_id, office_id)
);

create table office(
    office_id int not null,
    country varchar(225) not null,
    city varchar(225) not null,
    PRIMARY KEY (office_id)
);

ALTER TABLE car
ADD FOREIGN KEY (office_id) REFERENCES office(office_id);

ALTER TABLE reservation
ADD FOREIGN KEY (user_id) REFERENCES user(user_id),
ADD FOREIGN KEY (plate_id) REFERENCES car(plate_id),
ADD FOREIGN KEY (office_id) REFERENCES office(office_id);