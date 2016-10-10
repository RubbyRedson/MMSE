INSERT INTO ROLES(title, description, auth) VALUES('Customer service', 'test descr', 1);
INSERT INTO ROLES(title, description, auth) VALUES('Customer service manager', 'test descr', 2);

INSERT INTO USERS(username, password, role) VALUES('Alice', 'test descr', 2);
INSERT INTO USERS(username, password, role) VALUES('Bob', 'test descr', 1);

INSERT INTO CLIENTS(name, phone, discount) VALUES('Pear LLC', '1234554321', 0);
INSERT INTO CLIENTS(name, phone, discount) VALUES('AEKI', '0987654321', 75);

INSERT INTO PROJECTS(name, client, description, cost, start, stop)
VALUES('Birthday Party', 1, 'descr', 500, date '2001-10-05', date '2001-10-27');
INSERT INTO PROJECTS(name, client, description, cost, start, stop)
VALUES('Fika', 2, 'descr', 500, date '2007-11-13', date '2007-12-27');

INSERT INTO SUBTEAMS(name, description, numberofpeople) VALUES('IT', 'Nerds', 5);
INSERT INTO SUBTEAMS(name, description, numberofpeople) VALUES('Music', 'DJs', 7);