CREATE DATABASE IF NOT EXISTS shop;
USE shop;

DROP TABLE IF EXISTS product;
CREATE TABLE IF NOT EXISTS product (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(200) NOT NULL, 
    price INT NOT NULL
    
ALTER TABLE product ADD COLUMN image VARCHAR(255);
);

DROP TABLE IF EXISTS customer;
CREATE TABLE IF NOT EXISTS customer (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(100) NOT NULL, 
    address VARCHAR(200) NOT NULL, 
    login VARCHAR(100) NOT NULL UNIQUE, 
    password VARCHAR(100) NOT NULL
);

DROP TABLE IF EXISTS admins;
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    adminUsername VARCHAR(100) NOT NULL, 
    login VARCHAR(100) NOT NULL UNIQUE, 
    adminPassword VARCHAR(100) NOT NULL
);

DROP TABLE IF EXISTS purchase;
CREATE TABLE IF NOT EXISTS purchase (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    customer_id INT NOT NULL, 
    FOREIGN KEY (customer_id) REFERENCES customer(id)
);

DROP TABLE IF EXISTS purchase_detail;
CREATE TABLE IF NOT EXISTS purchase_detail (
    purchase_id INT NOT NULL, 
    product_id INT NOT NULL, 
    count INT NOT NULL, 
    PRIMARY KEY (purchase_id, product_id), 
    FOREIGN KEY (purchase_id) REFERENCES purchase(id), 
    FOREIGN KEY (product_id) REFERENCES product(id)
);

DROP TABLE IF EXISTS favorite;
CREATE TABLE IF NOT EXISTS favorite (
    customer_id INT NOT NULL, 
    product_id INT NOT NULL, 
    PRIMARY KEY (customer_id, product_id), 
    FOREIGN KEY (customer_id) REFERENCES customer(id), 
    FOREIGN KEY (product_id) REFERENCES product(id)
);

INSERT INTO product (name, price) VALUES ('牛肉干', 70);
INSERT INTO product (name, price) VALUES ('鲜花饼', 27);
INSERT INTO product (name, price) VALUES ('糖果', 21);
INSERT INTO product (name, price) VALUES ('巧克力', 22);
INSERT INTO product (name, price) VALUES ('山核桃', 25);
INSERT INTO product (name, price) VALUES ('卤味', 18);
INSERT INTO product (name, price) VALUES ('奇异果', 31);
INSERT INTO product (name, price) VALUES ('苹果', 60);
INSERT INTO product (name, price) VALUES ('橙子', 18);
INSERT INTO product (name, price) VALUES ('大米', 15);
INSERT INTO product (name, price) VALUES ('小米', 40);
INSERT INTO product (name, price) VALUES ('黄豆', 12);
INSERT INTO product (name, price) VALUES ('火腿', 26);
INSERT INTO product (name, price) VALUES ('木耳', 45);
INSERT INTO product (name, price) VALUES ('香肠', 23);
INSERT INTO product (name, price) VALUES ('麦片', 12);
INSERT INTO product (name, price) VALUES ('咖啡', 10);

INSERT INTO customer (name, address, login, password) VALUES ('张三', '101室', 'qq', 'qq');
INSERT INTO customer (name, address, login, password) VALUES ('李四', '102室', '11', '11');
INSERT INTO customer (name, address, login, password) VALUES ('王五', '103室', '22', '22');
INSERT INTO customer (name, address, login, password) VALUES ('赵六', '104室', '33', '33');
INSERT INTO customer (name, address, login, password) VALUES ('孙七', '105室', '44', '44');
INSERT INTO customer (name, address, login, password) VALUES ('周八', '106室', '55', '55');
INSERT INTO customer (name, address, login, password) VALUES ('吴九', '107室', '66', '66');
INSERT INTO customer (name, address, login, password) VALUES ('郑十', '108室', '77', '77');
INSERT INTO customer (name, address, login, password) VALUES ('二麻子', '109室', '88', '88');

INSERT INTO admins (adminUsername, login, adminPassword) VALUES ('admin', 'admin', 'admin');
