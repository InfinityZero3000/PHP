CREATE DATABASE IF NOT EXISTS labdb
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE labdb;

CREATE TABLE IF NOT EXISTS students (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    birthday DATE NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO students (name, email, phone, birthday) VALUES
('Nguyen Van A', 'a@example.com', '0123456789', '2003-01-15'),
('Tran Thi B', 'b@example.com', '0987654321', '2003-06-20'),
('Le Minh Chau', 'chau@example.com', '0901234567', '2002-12-03'),
('Pham Hoang Dung', 'dung@example.com', '0912345678', '2004-03-11'),
('Vo Thanh Ha', 'ha@example.com', '0934567890', '2003-09-27'),
('Bui Gia Huy', 'huy@example.com', '0976543210', '2002-08-08'),
('Do Ngoc Lan', 'lan@example.com', '0967890123', '2004-05-14');
