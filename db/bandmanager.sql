
CREATE TABLE users (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  facebook_id varchar(255) UNIQUE NOT NULL,
  name varchar(140) NOT NULL,
  created_at timestamp NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE user_profile (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(10) unsigned NOT NULL,
  picture varchar(255),
  email varchar(140) UNIQUE,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE pages (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  facebook_page_id varchar(255) NOT NULL,
  name varchar(140) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE user_pages (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(10) unsigned NOT NULL,
  page_id int(10) unsigned NOT NULL,
  page_access_token varchar(255) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (page_id) REFERENCES pages(id)
);

CREATE TABLE migrations (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  num int(10) unsigned NOT NULL,
  PRIMARY KEY (id)
);