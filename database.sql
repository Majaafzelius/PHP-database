CREATE database if not exists webb;
USE webb;

CREATE table if not exists Posts (
Id			int auto_increment primary key,
title		varchar(100) not null,
content		Text not null,
time_date	DateTime,
user_id		int,
user_name 	varchar(100)
);

select * from posts;
DROP TABLE Posts;