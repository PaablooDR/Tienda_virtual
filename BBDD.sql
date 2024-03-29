-- Crear la base de datos PlateArt
-- CREATE DATABASE PlateArt;

-- Conectar a la base de datos PlateArt
\c PlateArt;

-- Crear la tabla Client
CREATE TABLE Client (
    email VARCHAR(255) PRIMARY KEY,
    telephone VARCHAR(15),
    name VARCHAR(50),
    surname VARCHAR(50),
    dni VARCHAR(50),
    password VARCHAR(255),
    address VARCHAR(255)
);

-- Crear la tabla Admin
CREATE TABLE Admin (
    email VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255),
    signature VARCHAR(255)
);

-- Crear la tabla Category
CREATE TABLE Category (
    code SERIAL PRIMARY KEY,
    name VARCHAR(50),
    active BOOLEAN
);

-- Crear la tabla Product
CREATE TABLE Product (
    code VARCHAR(255) PRIMARY KEY,
    name VARCHAR(100),
    description VARCHAR(255),
    category SERIAL REFERENCES Category(code),
    photo VARCHAR(255),
    price DECIMAL(10, 2),
    stock INT,
    active BOOLEAN,
    outstanding BOOLEAN
);

-- Crear la tabla Shopping
CREATE TABLE Shopping (
    id_shopping SERIAL PRIMARY KEY,
    client VARCHAR(255) REFERENCES Client(email),
    shopping_date DATE DEFAULT CURRENT_DATE,
    status VARCHAR(20) CHECK (status IN ('pending', 'sent', 'cart')),
    total_price DECIMAL(10, 2)
);

-- Crear la tabla Shopping_details
CREATE TABLE Shopping_details (
    id SERIAL PRIMARY KEY,
    shopping SERIAL REFERENCES Shopping(id_shopping),
    product VARCHAR(255) REFERENCES Product(code),
    price_per_product DECIMAL(10, 2),
    amount INT,
    total_price DECIMAL(10, 2)
);

-- Crear la tabla Company
CREATE TABLE Company (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50),
    cif VARCHAR(50),
    address VARCHAR (100)
);

-- Crear usuario admin en la tabla Admin
INSERT INTO Admin (email, password, signature) VALUES ('admin', 'admin', NULL);

-- Crear categories
INSERT INTO Category (name, active) VALUES ('Animals', true);

INSERT INTO Category (name, active) VALUES ('Fantasy', true);

INSERT INTO Category (name, active) VALUES ('Gaming', true);

INSERT INTO Category (name, active) VALUES ('Manga&Anime', true);

INSERT INTO Category (name, active) VALUES ('Movies', true);

-- Crear registro de empresa
INSERT INTO Company (name, cif, address) VALUES ('PlateArt Corporations', 'H33243171', 'c/ de la Pineda, num. 33');

-- ESTO NO ESTA AÑADIDO A LA BBDD

-- Crear registro de la tabla Client
INSERT INTO Client (email, telephone, name, surname, dni, password, address) VALUES ('lucas.moreno@gmail.com', '652639261', 'Lucas', 'Moreno', '48224324V', 'lucas', 'Cr/ Alfonso XII, num 8');

-- Crear registro de la tabla Shooping
INSERT INTO Shopping (client, status, total_price) VALUES ('lucas.moreno@gmail.com', 'pending', 50.00);

-- Crear registro de la tabla Shooping_details
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'An001-Ho', 10.00, 20, 20.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'An001-Ho', 10.00, 1, 10.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'An002-Sa', 20.00, 2, 40.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'An003-El', 10.00, 2, 20.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'An004-Ni', 10.00, 4, 40.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'An005-Th', 10.00, 1, 10.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'Fa004-Tr', 10.00, 4, 40.00);
INSERT INTO Shopping_details (shopping, product, price_per_product, amount, total_price) VALUES (1, 'Fa005-Ro', 10.00, 1, 10.00);