CREATE TABLE rehersals (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  page_id int(10) unsigned NOT NULL,
  location varchar(255) NOT NULL,
  scheduled_at timestamp,
  note text,

  PRIMARY KEY (id),
  FOREIGN KEY (page_id) REFERENCES pages(id)
);

INSERT migrations (num) VALUES (3);