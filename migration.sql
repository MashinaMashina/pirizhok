CREATE TABLE menu
(
    id         INT(11) UNSIGNED AUTO_INCREMENT,
    date       DATE,
    created_at INT(11) UNSIGNED,
    updated_at INT(11) UNSIGNED,
    PRIMARY KEY (id)
);

CREATE TABLE position
(
    id         INT(11) UNSIGNED AUTO_INCREMENT,
    name       VARCHAR(255)     NOT NULL,
    price      INT(11) UNSIGNED NOT NULL,
    weight     VARCHAR(50)      NOT NULL,
    group_name VARCHAR(50)      NOT NULL,
    menu_id    INT(11) UNSIGNED,
    PRIMARY KEY (id)
);
