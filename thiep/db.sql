-- Database: thiepmoi_db
CREATE DATABASE IF NOT EXISTS `thiepmoi_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `thiepmoi_db`;

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `full_name` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Reviews table
CREATE TABLE IF NOT EXISTS `reviews` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(100) NOT NULL,
    `wedding_info` VARCHAR(150) NOT NULL,
    `rating` INT NOT NULL DEFAULT 5,
    `comment` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Invitations table
CREATE TABLE IF NOT EXISTS `invitations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT NULL,
    `style` VARCHAR(50) NOT NULL DEFAULT 'royal',
    `title` VARCHAR(150) NOT NULL,
    `groom_name` VARCHAR(100) NOT NULL,
    `bride_name` VARCHAR(100) NOT NULL,
    `groom_parents` VARCHAR(150) NULL,
    `bride_parents` VARCHAR(150) NULL,
    `wedding_date` DATE NOT NULL,
    `wedding_time` TIME NOT NULL,
    `lunar_date` VARCHAR(100) NULL,
    `venue_name` VARCHAR(150) NOT NULL,
    `venue_address` TEXT NOT NULL,
    `map_link` VARCHAR(255) NULL,
    `quote` TEXT NULL,
    `photo_url` VARCHAR(255) NULL,
    `bank_name` VARCHAR(100) NULL,
    `bank_acc` VARCHAR(50) NULL,
    `bank_owner` VARCHAR(100) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- RSVPs table
CREATE TABLE IF NOT EXISTS `rsvps` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `invitation_id` INT NOT NULL DEFAULT 1,
    `guest_name` VARCHAR(100) NOT NULL,
    `guest_count` INT NOT NULL DEFAULT 1,
    `message` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Seed Data
INSERT INTO `users` (`username`, `email`, `password`, `full_name`) VALUES
('admin', 'admin@tinhkhoi.vn', '$2y$10$e8K.I4I1B1aYf9Kx.O2e.uCjJ4Y6R4Kx.O2e.uCjJ4Y6R4Kx.O2e', 'Quản Trị Viên')
ON DUPLICATE KEY UPDATE `id`=`id`;

INSERT INTO `reviews` (`user_name`, `wedding_info`, `rating`, `comment`) VALUES
('Thanh Tùng & Bảo Ngọc', 'Tiệc cưới tại Park Hyatt Saigon', 5, 'Mẫu thiệp Cổ Điển Hoàng Gia thực sự nâng tầm tiệc cưới của chúng tôi. Bạn bè nhận link thiệp ai cũng trầm trò khen ngợi!'),
('Đức Minh & Khánh Linh', 'Tiệc cưới tại JW Marriott Hanoi', 5, 'Hệ thống RSVP thông minh giúp vợ chồng mình kiểm soát chính xác lượng khách tham dự, xuất file PDF in cũng rất sắc nét.'),
('Văn Hậu & Thùy Dương', 'Tiệc ngoài trời tại Đà Lạt', 5, 'Mẫu Vườn Địa Đàng với dải lụa xanh xô thơm tuyệt đẹp, giao diện tùy biến mượt mà vô cùng!')
ON DUPLICATE KEY UPDATE `id`=`id`;

INSERT INTO `invitations` (`id`, `style`, `title`, `groom_name`, `bride_name`, `groom_parents`, `bride_parents`, `wedding_date`, `wedding_time`, `lunar_date`, `venue_name`, `venue_address`, `map_link`, `quote`) VALUES
(1, 'royal', 'Thiệp Mời Hôn Lễ Hoàng Nam & Mai Linh', 'Vũ Hoàng Nam', 'Trần Mai Linh', 'Trưởng nam của ông Vũ Đăng Khoa & bà Lê Thị Mai', 'Ái nữ của ông Trần Quang Hùng & bà Nguyễn Kim Oanh', '2025-11-28', '17:30:00', 'Nhằm Ngày 09 Tháng 10 Năm Ất Tỵ', 'Le Grand Ballroom - Park Hyatt Saigon', 'Số 2 Công Trường Lam Sơn, Bến Nghé, Quận 1, TP. Hồ Chí Minh', 'https://maps.google.com/?q=Park+Hyatt+Saigon', 'Sự hiện diện của Quý vị là niềm vinh hạnh to lớn cho gia đình chúng tôi.')
ON DUPLICATE KEY UPDATE `id`=`id`;
