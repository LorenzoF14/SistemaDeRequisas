CREATE TABLE requisas(  
    codigo int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    date_requested DATETIME,
    name_requester VARCHAR(128),
    department VARCHAR(128),
    quantity INT,
    item VARCHAR(128),
    unit_cost DECIMAL(13,2),
    total DECIMAL(13,2),
    department_approval BOOLEAN,
    director_approval BOOLEAN,
    date_received DATETIME,
    received_by VARCHAR(128),
    status CHAR(3)
) COMMENT 'Tabla que registra toda la informacion de las requisas de ResultsCX';