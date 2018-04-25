DROP TABLE topics;
DROP TABLE messages;
DROP TABLE users;

CREATE TABLE topics (
  id INTEGER PRIMARY KEY,
  name VARCHAR,
  locked integer
);

CREATE TABLE users (
  username varchar,
  password varchar,
  admin integer
);

CREATE TABLE messages (
  topicid INTEGER,
  position INTEGER,
  message text,
  authorid varchar,
  FOREIGN KEY(topicid) references topics(id),
  FOREIGN KEY(authorid) references users(username),
  primary key(topicid,position)
);