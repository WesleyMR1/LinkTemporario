drop database if exists link;
create database if not exists link;

use link

create table  contas(
    email varchar(150) not null unique,
    senha varchar(16) not null
);

create table codigoLink(
    id int not null primary key auto_increment,
    codigo varchar(250),
    data datetime,
    emailCriptografado varchar(250)
);

insert into contas values ('wes@wes', '123');