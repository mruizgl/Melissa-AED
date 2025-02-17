CREATE DATABASE IF NOT EXISTS tresenraya;
USE tresenraya;
CREATE TABLE IF NOT EXISTS users (
                                     id INT AUTO_INCREMENT PRIMARY KEY,
                                     email VARCHAR(255) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
    );
CREATE TABLE games (
                       id BIGINT AUTO_INCREMENT PRIMARY KEY,
                       player1_id BIGINT NOT NULL,
                       player2_id BIGINT DEFAULT NULL,
                       status VARCHAR(20) NOT NULL,
                       board_state TEXT NOT NULL,
                       FOREIGN KEY (player1_id) REFERENCES users(id),
                       FOREIGN KEY (player2_id) REFERENCES users(id)
);
