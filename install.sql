CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    transport VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    payment VARCHAR(50) NOT NULL,
    status ENUM('Новая','Идет обучение','Обучение завершено') DEFAULT 'Новая',
    review TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO users (login, password, full_name, birthdate, phone, email)
VALUES ('Admin26', 'Demo20', 'Администратор', '0000-00-00', '80000000000', 'admin@vodit.ru');