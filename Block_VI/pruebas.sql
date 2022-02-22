INSERT INTO users(idusers, first_name, second_name, email, password, location, dept, is_admin, register_date)
values (6, 'Fefi', 'Blanco', 'federica@lightit.io',7488, 'mvd', 'development', 1, now()),
(2, 'Martin','Gulla','martin@lightit.io', 2000, 'mvd', 'development',0,now()),
(3, 'Denise', 'Appel', 'denise@lightit.io', 2000, 'mvd', 'development',1,now()),
(4, 'Paula', 'Secondo', 'paula@christian.com', 2001, 'mvd', 'HR',0, now()),
(5, 'Paz', 'Ferreira', 'pfsmc@christian.com', 2001, 'mvd', 'IT', 1, now());

SELECT first_name, second_name FROM users;

SELECT * FROM users WHERE dept='development';

DELETE FROM users WHERE idusers=6;

UPDATE users SET email='paz@lightit.io' WHERE idusers=5;

ALTER TABLE users ADD age VARCHAR(3);

ALTER TABLE users MODIFY COLUMN age INT(3);

SELECT * FROM users ORDER BY second_name DESC;

SELECT CONCAT(first_name, ' ' , second_name) AS name, age FROM users;

SELECT DISTINCT age FROM users;

SELECT * FROM users WHERE age BETWEEN 21 AND 25;

SELECT * FROM users WHERE dept LIKE 'd%';

SELECT * FROM users WHERE dept LIKE '%t';

SELECT * FROM users WHERE dept LIKE '%m%';

SELECT first_name FROM users WHERE dept IN('IT', 'HR');

CREATE INDEX DIndex on users(dept);

DROP INDEX DIndex on users;

CREATE TABLE posts(
	id INT auto_increment,
    user_id INT,
    title VARCHAR(100),
    body TEXT,
    published_date datetime default CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(idusers)
);

INSERT INTO posts(user_id,title, body)
values (1, 'post 1', 'this is post 1'),
(2,'post 2', 'this is post 2'),
(3,'post 3', 'this is post 3'),
(4, 'post 4', 'this is post 4'),
(5, 'post 5', 'this is post 5');

SELECT * FROM posts;

SELECT users.first_name, users.second_name, posts.title, posts.published_date
FROM users
INNER JOIN posts
ON users.idusers= posts.user_id
ORDER BY posts.title;

CREATE TABLE comments(
	id INT auto_increment,
    user_id INT,
    post_id INT,
    body TEXT,
    published_date datetime default CURRENT_TIMESTAMP,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(idusers),
    FOREIGN KEY(post_id) REFERENCES posts(id)
);

INSERT INTO comments(user_id,post_id, body)
values (1,1, 'this is comment 1'),
(2,2,'this is comment 2'),
(3,3,'this is comment 3'),
(4,4,  'this is comment 4'),
(5,5, 'this is comment 5');

SELECT comments.body, posts.title
FROM comments
LEFT JOIN posts
ON posts.id= comments.post_id
ORDER BY posts.title;

SELECT comments.body, posts.title, users.first_name, users.second_name
FROM comments
INNER JOIN posts
ON posts.id= comments.post_id
INNER JOIN users
ON users.idusers= comments.user_id
ORDER BY posts.title;

SELECT COUNT(idusers) FROM users;

SELECT MAX(age) FROM users;
SELECT MIN(age) FROM users;
SELECT SUM(age) FROM users;

SELECT UCASE(first_name), LCASE(second_name) FROM users;

SELECT dept, COUNT(dept)
FROM users
GROUP BY dept;



