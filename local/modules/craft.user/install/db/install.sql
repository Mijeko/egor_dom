CREATE TABLE `user_social_identities`
(
    `ID`          int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `USER_ID`     int          NOT NULL,
    `IDENTITY_ID` varchar(128) NOT NULL,
    `SOCIAL`      varchar(64)  NOT NULL,
    `CREATED_AT`  datetime     NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE='InnoDB';