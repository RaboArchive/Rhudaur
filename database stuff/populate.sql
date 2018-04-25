INSERT INTO topics values (1,'test topic 1',0);
INSERT INTO topics values (2,'test topic 2',0);
INSERT INTO topics values (3,'test topic 3',0);
INSERT INTO topics values (4,'test topic 4',0);
INSERT INTO topics values (5,'test topic 6',0);
INSERT INTO topics values (6,'test topic 7',0);

INSERT INTO users values ('admin','plop', 0);
INSERT INTO users values ('user1','plop', 0);
INSERT INTO users values ('user2','plop', 0);
INSERT INTO users values ('user3','plop', 0);

INSERT INTO messages values (1,1,'1er message 1er topic par admin', 'admin');
INSERT INTO messages values (1,2,'2e message 1er topic par admin', 'admin');
INSERT INTO messages values (1,3,'3e message 1er topic par user1', 'user1');
INSERT INTO messages values (1,4,'4e message 1er topic par user2', 'user2');
INSERT INTO messages values (2,1,'1er message 2e topic par user3', 'user3');
INSERT INTO messages values (2,2,'2e message 2e topic par user1', 'user1');
