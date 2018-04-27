-- DROP TABLE topics;
-- DROP TABLE messages;
-- DROP TABLE users;

CREATE TABLE IF NOT EXISTS topics (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name VARCHAR not null,
  locked integer,
  lastMessageDate datetime not null
);

CREATE TABLE IF NOT EXISTS users (
  username varchar primary key ,
  password varchar not null,
  admin integer
);

CREATE TABLE IF NOT EXISTS messages (
  topicid INTEGER not null,
  position INTEGER not null,
  message text not null,
  authorid varchar not null,
  date datetime not null,
  FOREIGN KEY(topicid) references topics(id),
  FOREIGN KEY(authorid) references users(username),
  primary key(topicid,position)
);