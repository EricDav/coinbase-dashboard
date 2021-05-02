CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(120) not null,
    email varchar(120) NOT NULL,
    phone_number varchar(129),
    password varchar(120) not null,
    PRIMARY KEY(id)
);