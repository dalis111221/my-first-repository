<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cpt_department');

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
if (!$conn) die("Connection failed: " . mysqli_connect_error());

// បង្កើត Database
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
mysqli_select_db($conn, DB_NAME);

// ── Tables ────────────────────────────────────────────
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS courses (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    description TEXT,
    image       VARCHAR(255) DEFAULT 'default.jpg',
    icon        VARCHAR(10)  DEFAULT '💻',
    duration    VARCHAR(50)  DEFAULT '1 ឆ្នាំ',
    level       ENUM('beginner','intermediate','advanced') DEFAULT 'beginner',
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS teachers (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    position   VARCHAR(100),
    subject    VARCHAR(255),
    email      VARCHAR(100),
    phone      VARCHAR(20),
    photo      VARCHAR(255) DEFAULT 'default.jpg',
    bio        TEXT,
    is_head    TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS students (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100),
    phone      VARCHAR(20),
    course_id  INT,
    status     ENUM('pending','active','completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE SET NULL
) ENGINE=InnoDB");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(100),
    subject    VARCHAR(255),
    message    TEXT NOT NULL,
    is_read    TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS news (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(255) NOT NULL,
    content    TEXT,
    image      VARCHAR(255) DEFAULT 'default.jpg',
    is_active  TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS admins (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50) UNIQUE NOT NULL,
    password   VARCHAR(255) NOT NULL,
    name       VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

// ── Default Admin (admin / admin123) ──────────────────
$check = mysqli_query($conn, "SELECT id FROM admins LIMIT 1");
if (mysqli_num_rows($check) === 0) {
    $hash = password_hash('admin123', PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO admins (username,password,name) VALUES ('admin','$hash','Administrator')");
}

// ── Sample Courses ────────────────────────────────────
$check2 = mysqli_query($conn, "SELECT id FROM courses LIMIT 1");
if (mysqli_num_rows($check2) === 0) {
    mysqli_query($conn, "INSERT INTO courses (course_name,description,icon,duration,level) VALUES
        ('ការអភិវឌ្ឍវេបសាយ','រៀន HTML, CSS, JavaScript, PHP ពីមូលដ្ឋានដល់កម្រិតខ្ពស់','🌐','2 ឆ្នាំ','beginner'),
        ('គ្រប់គ្រងទិន្នន័យ','MySQL, Database Design, PHP Backend development','📊','1 ឆ្នាំ','intermediate'),
        ('រចនាក្រាហ្វិក','Photoshop, Illustrator, Canva, UI/UX Design','🎨','1 ឆ្នាំ','beginner'),
        ('កាត់តវិដេអូ','Premiere Pro, After Effects, Camtasia','🎬','1 ឆ្នាំ','beginner'),
        ('ជួសជុលកុំព្យូទ័រ','Hardware, Networking, Cisco, Computer Repair','🛡️','1 ឆ្នាំ','beginner'),
        ('IoT & Robotics','Arduino, Raspberry Pi, Sensors, Programming','🤖','1 ឆ្នាំ','advanced')
    ");
}

// ── Sample Teachers ───────────────────────────────────
$check3 = mysqli_query($conn, "SELECT id FROM teachers LIMIT 1");
if (mysqli_num_rows($check3) === 0) {
    mysqli_query($conn, "INSERT INTO teachers (name,position,subject,is_head) VALUES
        ('លោកស្រី ភន ញឹប','ប្រធានដេប៉ាតឺម៉ង់','Department Head',1),
        ('លោកគ្រូ ង៉ែត ស៊ីវុធី','គ្រូបង្រៀន','កាត់តវិដេអូ, រចនាក្រាហ្វិក',0),
        ('លោកគ្រូ ម៉ម ឡាវី','គ្រូបង្រៀន','ជួសជុលកុំព្យូទ័រ, Animation',0),
        ('អ្នកគ្រូ ឡាង រតនា','គ្រូបង្រៀន','IoT, Research Project',0),
        ('អ្នកគ្រូ តុង សុដាវី','គ្រូបង្រៀន','Web Development, UI Design',0)
    ");
}
?>
