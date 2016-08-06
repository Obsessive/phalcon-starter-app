CREATE TABLE venues (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  place_id varchar(32) NOT NULL,
  name varchar(255) NOT NULL,
  address varchar(255) NOT NULL,

  PRIMARY KEY (id)
);

INSERT migrations (num) VALUES (5);