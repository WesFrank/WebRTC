<?php

    namespace MyApp;

    use PDO;

    class DB {

        function connect() {

            $servername = "localhost";
            $username = "admin";
            $password = "admin";
            $dbname = "vchat";

            $db = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);

            return $db;
            
        }

    }

    // CREATE DATABASE vchat;

    // CREATE TABLE Users (
    //     userID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     username varchar(255),
    //     name varchar(255),
    //     email varchar(255),
    //     password varchar(255),
    //     profileImage varchar(255) DEFAULT 'assets/images/defaultImage.png',
    //     sessionID varchar(255),
    //     connectionID int
    // );
    
    // INSERT INTO users (username, name, email, password, sessionID, connectionID) VALUES ('Frank', 'Francois', 'fwessels11@gmail.com', '12113sAs12Ww*#', '0', '0');
    // INSERT INTO users (username, name, email, password, sessionID, connectionID) VALUES ('Dave', 'David', 'david@gmail.com', '1234', '0', '0');
    // INSERT INTO users (username, name, email, password, sessionID, connectionID) VALUES ('Sarah666', 'Sarah', 'Sarah@gmail.com', '666', '0', '0');

?>