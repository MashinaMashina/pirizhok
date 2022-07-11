CREATE TABLE IF NOT EXISTS menu
(
    id         INT(11) UNSIGNED AUTO_INCREMENT,
    date       DATE,
    created_at INT(11) UNSIGNED,
    updated_at INT(11) UNSIGNED,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS position
(
    id         INT(11) UNSIGNED AUTO_INCREMENT,
    name       VARCHAR(255)     NOT NULL,
    price      INT(11) UNSIGNED NOT NULL,
    weight     VARCHAR(50)      NOT NULL,
    group_name VARCHAR(50)      NOT NULL,
    menu_id    INT(11) UNSIGNED,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS companies
(
    id   INT(11) UNSIGNED AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS orders
(
    id            INT(11) UNSIGNED AUTO_INCREMENT,
    company_id    INT(11) UNSIGNED,
    user_name     VARCHAR(255),
    positions     TEXT,
    comment       VARCHAR(255),
    admin_comment VARCHAR(255),
    ip            VARCHAR(50) NOT NULL,
    created_at    INT(11) UNSIGNED,
    updated_at    INT(11) UNSIGNED,
    menu_id       INT(11) UNSIGNED,
    PRIMARY KEY (id)
);