ALTER TABLE user_profile

	ADD first_name varchar(140),
	ADD last_name varchar(140),
	ADD location varchar(140),
	ADD cover varchar(255);

INSERT migrations (num) VALUES (1);