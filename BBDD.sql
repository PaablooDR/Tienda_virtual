-- Crear la base de datos PlateArt
CREATE DATABASE PlateArt;

-- Conectar a la base de datos PlateArt
\c PlateArt;

-- Crear la tabla Client
CREATE TABLE Client (
    email VARCHAR(255) PRIMARY KEY,
    telephone VARCHAR(15),
    name VARCHAR(50),
    surname VARCHAR(50),
    password VARCHAR(255),
    address VARCHAR(255)
);

-- Crear la tabla Admin
CREATE TABLE Admin (
    email VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255),
    signature VARCHAR(255)
);

-- Crear la tabla Product
CREATE TABLE Product (
    code SERIAL PRIMARY KEY,
    name VARCHAR(100),
    description VARCHAR(255),
    category VARCHAR(50),
    photo VARCHAR(255),
    price DECIMAL(10, 2),
    stock INT,
    outstanding BOOLEAN
);

-- Crear la tabla Category
CREATE TABLE Category (
    code SERIAL PRIMARY KEY,
    name VARCHAR(50)
);

-- Crear la tabla Shopping
CREATE TABLE Shopping (
    id SERIAL PRIMARY KEY,
    client VARCHAR(255) REFERENCES Client(email),
    shopping_date DATE DEFAULT CURRENT_DATE,
    status VARCHAR(20) CHECK (status IN ('pending', 'sent', 'cart')),
    total_price DECIMAL(10, 2)
);

-- Crear la tabla Shopping_details
CREATE TABLE Shopping_details (
    id SERIAL PRIMARY KEY,
    shopping SERIAL REFERENCES Shopping(id_shopping),
    product SERIAL REFERENCES Product(code),
    amount INT,
    total_price DECIMAL(10, 2)
);