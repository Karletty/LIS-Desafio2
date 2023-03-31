CREATE DATABASE textil_export;
USE textil_export;

CREATE TABLE `categories`(
	`id_category` varchar(6) NOT NULL,
    `category_name` varchar(50) NOT NULL,
    PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `products` (
	`id_product` varchar(9) NOT NULL,
    `product_name` varchar(50) NOT NULL,
    `product_description` longtext NOT NULL,
    `img` varchar(50) NOT NULL,
    `id_category` varchar(6) NOT NULL,
    `price` decimal(10,2) NOT NULL,
    `stock` int NOT NULL,
    PRIMARY KEY (`id_product`),
    FOREIGN KEY (`id_category`) REFERENCES `categories`(`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `clients`(
	`client_email` varchar(50) NOT NULL,
	`is_active` boolean NOT NULL,
	`pass` varchar(64) NOT NULL,
	PRIMARY KEY (`client_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `sales`(
	`id_sale` int NOT NULL AUTO_INCREMENT,
    `id_client` varchar(50) NOT NULL,
    PRIMARY KEY (`id_sale`),
    FOREIGN KEY (`id_client`) REFERENCES `clients`(`client_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `sales_details`(
	`id_sales_detail` int NOT NULL AUTO_INCREMENT,
    `id_sale` int NOT NULL,
    `quantity` int NOT NULL,
    `id_product` varchar(9) NOT NULL,
    PRIMARY KEY (`id_sales_detail`),
    FOREIGN KEY (`id_sale`) REFERENCES `sales`(`id_sale`),
    FOREIGN KEY (`id_product`) REFERENCES `products`(`id_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_types`(
	`id_user_type` int NOT NULL,
	`user_type` varchar(30) NOT NULL,
	PRIMARY KEY (`id_user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (
	`user_name` varchar(20) NOT NULL,
	`pass` varchar(64) NOT NULL,
	`id_user_type` int NOT NULL,
	PRIMARY KEY (`user_name`),
    FOREIGN KEY (`id_user_type`) REFERENCES `user_types`(`id_user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `user_types` (`id_user_type`, `user_type`) VALUES
(1, 'admin'),
(2, 'employee');

INSERT INTO `clients` (`client_email`, `is_active`, `pass`) VALUES
('karletty.carolina@gmail.com', true, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92'),
('eliasperez2810@gmail.com', false, '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

INSERT INTO `users` (`user_name`, `pass`, `id_user_type`) VALUES
('Karle', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1),
('Isabel','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2);

INSERT INTO `categories` (`id_category`, `category_name`) VALUES
('CAT001', 'Textil'),
('CAT002', 'Promocional');

INSERT INTO `products` (`id_product`, `product_name`, `product_description`, `img`, `id_category`, `price`, `stock`) VALUES
('PROD00001', 'Camiseta de algodón cuello redondo', 'Camiseta Mod. 1, elaborada en algodón de 200 grs. cuello redondo decorado, manga corta, costuras en cierres laterales.', 'PROD00001.jpg', 'CAT001', 2.50, 500),
('PROD00002', 'Camiseta de algodón cuello V', 'Camiseta Mod. 2, elaborada en algodón de 200 grs. cuello en V decorado, manga corta, costuras en cierres laterales.', 'PROD00002.jpg', 'CAT001', 2.90, 462),
('PROD00003', 'Sudadera algodón', 'Sudadera para adulto en combinación de materiales algodón y poliéster de 280g/m2, cuello redondo, sin gorro.', 'PROD00003.jpg', 'CAT001', 10.0, 4),
('PROD00004', 'Sudadera con zipper', 'Sudadera para adulto con capucha y cierre de central de zipper. En combinación de materiales algodón y poliéster de 280g/m2. Con cordones a juego y 2 bolsas frontales. Material: 50% Algodón, 50% Poliéster', 'PROD00004.jpg', 'CAT001', 13.0, 196),
('PROD00005', 'Blusa Tipo Polo', 'Blusa Tipo Polo en Liquidación, diversa gama de colores con cuello y puño en contraste. ', 'PROD00005.png', 'CAT001', 5.0, 500),
('PROD00006', 'Camisa Tipo Polo', 'Camisa Tipo Polo en Liquidación, diversa gama de colores con cuello y puño en contraste.', 'PROD00006.jpg', 'CAT001', 5.0, 28),
('PROD00007', 'Chaleco', 'Chaleco en resistente combinación de materiales algodón y poliéster de vivos colores. Cierre de zipper principal, multitud de bolsillos frontales y laterales de gran capacidad con cierre de velcro y anilla metálica en el pecho.', 'PROD00007.jpg', 'CAT001', 20.0, 15),
('PROD00008', 'Mandil', 'Mandil pro de alta calidad en resistente material 100% algodón canvas de 340g/m2. De corte por debajo de la rodilla, con cintas de cuello y cintura en resistente polipiel con ajuste mediante hebilla y reforzado con remaches metálicos. Incluye multitud de bolsillos para los distintos utensilios, con las costuras reforzadas.', 'PROD00008.jpg', 'CAT001', 12.0, 25),
('PROD00009', 'Squeeze', 'Squeeze con cuerpo de acabado en aluminio en vivos y variados colores. Con tapón de rosca, dosificados de seguridad y tapón de cierre. Presentado en caja individual.', 'PROD00009.jpg', 'CAT002', 3.50, 210),
('PROD00010', 'Squeeze de sublimación', 'Squeeze con cuerpo de acabado en suave y brillante color blanco, especialmente diseñado para marcaje en sublimación. Con tapón de seguridad a rosca y mosquetón metálico de transporte. Presentado en caja individual.', 'PROD00010.jpg', 'CAT002', 3.35, 0),
('PROD00011', 'Taza', 'Taza de Línea Ecológica color Natural.', 'PROD00011.jpg', 'CAT002', 1.30, 500),
('PROD00012', 'Termo de sublimación', 'Termo de 500ml de capacidad en resistente acero inoxidable. Superficie exterior especialmente diseñada para sublimación. Con tapón de seguridad y presentado en atractiva caja individual de diseño.', 'PROD00012.jpg', 'CAT002', 9.0, 0),
('PROD00013', 'Gorra de algodón', 'Gorra sin impresión, importada, 100% algodón, 6 paneles con ojetes, cierre de hebilla, viñeta interior genérica bordada. Talla única de adulto.', 'PROD00013.png', 'CAT002', 2.50, 500),
('PROD00014', 'Gorra de poliester', 'Gorra de 5 paneles con visera plana acolchada y parte trasera en redecilla a juego. Material 100% poliéster de suave acabado, con cierre ajustable de botones y en variada gama de vivos colores.', 'PROD00014.jpg', 'CAT002', 2.75, 500),
('PROD00015', 'Mochila', 'Mochila en acabado denim 600D, de diseño urbano, con acolchado total en todo el cuerpo y cintas de hombros. Bolsa exterior con cierre de zipper, asas de transporte y cintas de hombros reforzadas a juego y compartimento interior acolchado para portátil de hasta 15 pulgadas.', 'PROD00015.jpg', 'CAT002', 12.0, 500),
('PROD00016', 'Power Bank', 'Batería auxiliar externa de aluminio en llamativos colores de 2.200 mAh de capacidad de carga, con botón y ledes indicadores de carga. Cable micro USB incluido y amplia superficie de marcaje, Presentada en atractiva caja de diseño. Las capacidades mostradas en todas nuestras baterías auxiliares externas son reales, incorporando todas ellas baterías de grado A y no recicladas, con una vida útil de al menos 500 ciclos de carga y según normativa CE. Además, están fabricadas conforme a los estándares RoHS y en cumplimiento con los siguientes requisitos de seguridad: Sistema de protección contra sobrecarga del power bank. Sistema de protección contra descarga completa que proporciona una mayor durabilidad del power bank. Sistema de bloqueo para evitar cortocircuitos. Sistema de transferencia de carga constante, acorde con la capacidad del dispositivo de destino.', 'PROD00016.jpg', 'CAT002', 5.50, 500);
