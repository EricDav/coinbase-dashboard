CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(120) not null,
    email varchar(120) NOT NULL,
    phone_number varchar(129),
    password varchar(120) not null,
    PRIMARY KEY(id)
);

CREATE TABLE plans (
    name varchar(120),
    percent int not null,
    price_rang varchar(120),
    time_frame varchar(120)
);

drop table plans;
CREATE TABLE plans (
    name varchar(120),
    percent int not null,
    price_rang varchar(120),
    time_frame varchar(120)
);
INSERT INTO plans (name, percent, price_rang, time_frame) VALUES('ARMATURE PLAN', 15, '100 - 1,000', 4);
INSERT INTO plans (name, percent, price_rang, time_frame) VALUES('STANDARD PLAN', 20, '1,000 - 10,000', 4);

INSERT INTO plans (name, percent, price_rang, time_frame) VALUES('PROFESSIONAL PLAN', 30, '10000 - 20000', 4);

INSERT INTO plans (name, percent, price_rang, time_frame) VALUES('ALTRA PLAN', 45, '20,000 - 50,000', 4);

INSERT INTO plans (name, percent, price_rang, time_frame) VALUES('MULTI PLAN', 55, '50,000 - 100,000', 4);

INSERT INTO plans (name, percent, price_rang, time_frame) VALUES('PROFESSIONAL PLAN', 65, '100,000 and above', 4);


CREATE TABLE referrals (
    user_id int not null,
    referral_code varchar(12),
);
