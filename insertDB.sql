INSERT INTO users VALUES(NULL, 'admin', 'Bryan', 'Ortega', 'bortg', 'bortega@correo.com', 'Bort', NULL, NULL, CURTIME(), CURTIME(), CURTIME());
INSERT INTO users VALUES(NULL, 'user', 'Raquel', 'Saenz', 'rsae', 'rsaenz@correo.com', 'RSan', NULL, NULL, CURTIME(), CURTIME(), CURTIME());
INSERT INTO users VALUES(NULL, 'user', 'Manuel', 'Garcia', 'mgar', 'mgarcia@correo.com', 'Mgar', NULL, NULL, CURTIME(), CURTIME(), CURTIME());

INSERT INTO images VALUES(NULL, 1, 'test.jpeg', 'Tempora exercitationem distinctio, minus minima ea vitae quam ut porro velit', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 2, 'test2.jpeg', 'natus dolorum excepturi, rerum saepe magnam temporibus molestias quasi repudiandae asperiores?', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 2, 'test3.jpeg', 'Tempora exercitationem distinctio, minus minima ea vitae quam ut porro velit', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 3, 'test4.jpeg', 'sit amet consectetur adipisicing elit. Tempora exercitationem distinctio, minus minima', CURTIME(), CURTIME());

INSERT INTO comments VALUES(NULL, 2,1,'amet consectetur adipisicing', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3,1,'quasi repudiandae asperiores?', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 1,2,'natus dolorum excepturig', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2,2,'minus minima ea vitae quam', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3,2,'amet consectetur adipisicing', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 1,3,'Tempora exercitationem', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2,3,'amet consectetur adipisicing', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 2,4,'exercitationem distinctio, minus', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3,4,'sit amet consectetur', CURTIME(), CURTIME());

INSERT INTO likes VALUES(NULL, 1, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 1, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 1, 3, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 2, 3, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 4, CURTIME(), CURTIME());
