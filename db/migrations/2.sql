CREATE TABLE page_profile (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  page_id int(10) unsigned NOT NULL,
  picture varchar(255),
  cover varchar(255),
  genre varchar(140),

  PRIMARY KEY (id),
  FOREIGN KEY (page_id) REFERENCES pages(id)
);

INSERT migrations (num) VALUES (2);