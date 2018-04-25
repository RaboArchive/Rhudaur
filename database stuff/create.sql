DROP TABLE topics;
DROP TABLE messages;
DROP TABLE users;

CREATE TABLE topics (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR not null,
  locked integer
);

CREATE TABLE users (
  username varchar primary key ,
  password varchar not null,
  admin integer
);

CREATE TABLE messages (
  topicid INTEGER,
  position INTEGER,
  message text not null,
  authorid varchar,
  FOREIGN KEY(topicid) references topics(id),
  FOREIGN KEY(authorid) references users(username),
  primary key(topicid,position)
);