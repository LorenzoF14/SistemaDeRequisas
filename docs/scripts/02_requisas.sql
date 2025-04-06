CREATE TABLE requisas(  
    codigo int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    date_requested DATETIME DEFAULT NULL,
    name_requester VARCHAR(128) NOT NULL,
    department VARCHAR(128) NOT NULL,
    quantity INT NOT NULL,
    item VARCHAR(128) NOT NULL,
    unit_cost DECIMAL(13,2) DEFAULT NULL,
    total DECIMAL(13,2) DEFAULT NULL,
    department_approval tinyint(1) DEFAULT NULL,
    director_approval tinyint(1) DEFAULT NULL,
    date_received DATETIME DEFAULT NULL,
    received_by VARCHAR(128) DEFAULT NULL,
    store VARCHAR(128) DEFAULT NULL,
    status CHAR(3) DEFAULT 'ACT'
) COMMENT 'Tabla que registra toda la informacion de las requisas de ResultsCX';