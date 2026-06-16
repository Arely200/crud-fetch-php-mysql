
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `productos` (`id`, `codigo`, `producto`, `precio`, `cantidad`) VALUES
(1, 'PROD-001', 'Laptop HP Pavilion', 750.99, 10),
(2, 'PROD-002', 'Mouse Logitech', 25.50, 50),
(3, 'PROD-003', 'Teclado Mecánico', 89.99, 25),
(4, 'PROD-001', 'Laptop HP Pavilion', 750.99, 10),
(5, 'PROD-002', 'Mouse Logitech', 25.50, 50),
(6, 'PROD-003', 'Teclado Mecánico', 89.99, 25);
COMMIT;

