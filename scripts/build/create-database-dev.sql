CREATE DATABASE IF NOT EXISTS `student_live` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
CREATE DATABASE IF NOT EXISTS `student_dev` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
CREATE DATABASE IF NOT EXISTS `student_testing` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

CREATE USER 'student_live'@'localhost' IDENTIFIED BY 'student_live';
CREATE USER 'student_dev'@'localhost' IDENTIFIED BY 'student_dev';
CREATE USER 'student_testing'@'localhost' IDENTIFIED BY 'student_testing';

GRANT ALL PRIVILEGES ON student_live.* TO 'student_live'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON student_dev.* TO 'student_dev'@'%' WITH GRANT OPTION;
GRANT ALL PRIVILEGES ON student_testing.* TO 'student_testing'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;

