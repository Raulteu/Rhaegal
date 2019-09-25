-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2019 at 07:09 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rhaegal_ddbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
  `id_local` int(10) UNSIGNED NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL,
  `num_reservas` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `horario`
--

INSERT INTO `horario` (`id_local`, `dia`, `hora`, `num_reservas`) VALUES
(2, '2019-03-28', '14:00:00', 3),
(2, '2019-03-29', '12:00:00', 1),
(2, '2019-03-29', '14:00:00', 2),
(2, '2019-03-30', '20:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `local`
--

CREATE TABLE `local` (
  `id` int(10) UNSIGNED NOT NULL,
  `calle` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(3) UNSIGNED NOT NULL,
  `ciudad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `codigoPostal` int(5) UNSIGNED NOT NULL,
  `reservas_maximas` int(4) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `local`
--

INSERT INTO `local` (`id`, `calle`, `numero`, `ciudad`, `codigoPostal`, `reservas_maximas`) VALUES
(2, 'Paseo del Molino', 8, 'Madrid', 28045, 20),
(3, 'Juanillo', 5, 'Santa Cruz de la Zarza', 45370, 2),
(4, 'Calle Madrid', 17, 'Getafe', 28903, 10),
(5, 'Parque Sur', 1, 'Parque Sur', 28916, 30);

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `calle` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `numero` int(3) UNSIGNED NOT NULL,
  `ciudad` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `codigo_postal` int(5) UNSIGNED NOT NULL,
  `hora` time NOT NULL,
  `precio` decimal(10,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`id`, `cliente`, `email`, `calle`, `numero`, `ciudad`, `codigo_postal`, `hora`, `precio`) VALUES
(32, 'Raul', 'velsi13teu@gmail.com', 'Juanillo', 5, 'Santa Cruz', 45370, '12:41:00', '41.50'),
(33, 'Raul', 'velsi13teu@gmail.com', 'Juanillo', 5, 'Santa Cruz', 45370, '15:00:00', '19.00'),
(34, 'Raul', 'velsi13teu@gmail.com', 'Juanillo', 5, 'Santa Cruz', 45370, '15:00:00', '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `plato`
--

CREATE TABLE `plato` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(10,2) UNSIGNED NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plato`
--

INSERT INTO `plato` (`id`, `nombre`, `tipo`, `precio`, `descripcion`, `foto`) VALUES
(1, 'Ensalada de la casa', 'Entrante', '5.00', 'Tomate, lechuga, maíz y manzana combinados para formar el plato perfecto para acompañar cada comida.', 'img/comida/ensalada-casa.jpg'),
(2, 'Croquetas', 'Entrante', '6.50', 'Croquetas de jamón, Mozzarella y pan rallado al estilo japonés. Acompañadas de tomate seco, cebolla crujiente y salsas BBQ Ranch y tomate.', 'img/comida/croquetas.jpg'),
(3, 'Aros de calabacín', 'Entrante', '7.50', 'Discos de calabacín preparados en tempura con parmesano rallado y acompañados de nuestra salsa toscana casera.', 'img/comida/aros-calabacin.JPG'),
(4, 'Patatas con salmón', 'Entrante', '7.50', 'Patata asada con salmón ahumado y acompañadas de nuestra salsa de la casa.', 'img/comida/patatas-salmon.jpg'),
(5, 'Rollitos de berenjenas', 'Entrante', '7.50', 'Finas láminas de berenjena rellenas de queso ricotta y hierbas aromáticas, con salsa de tomate, albahaca y queso grana padano.', 'img/comida/rollitos-de-berenjenas.jpg'),
(6, 'Rollitos de champiñón y bacon', 'Entrante', '7.50', 'Tortas de trigo enrolladas con queso, bacon y champiñón, acompañadas de rúcula y salsa di Roma', 'img/comida/rollitos-champi.jpg'),
(7, 'Aguacate Chicken Burger', 'Principal', '9.50', 'Pechuga de pollo a la plancha en pan de mollete, aguacate, tomate seco, cebolla a la plancha, rodajas de tomate, lechuga y salsa de yogur. Guarnición a elegir.', 'img/comida/aguacate-chicken-buger.jpg'),
(8, 'Sándwich Egeo', 'Principal', '9.50', 'Pan de doce cereales, pavo, rúcula, queso feta, tomate, salsa de yogur y chutney de tomate seco. Guarnición a elegir.', 'img/comida/sandwich-egeo.jpg'),
(9, 'Sándwich California', 'Principal', '9.50', 'Sándwich de pan de doce cereales y semillas con verduras asadas y hortalizas: aguacate, pimientos rojos, calabacín, espinacas, brotes de cebolla, albahaca y cebolla frita, con queso de cabra, vinagreta de hierbas y guarnición de chips de verduras.', 'img/comida/sandwich-california.jpg'),
(10, 'Pallarda de Ternera', 'Principal', '8.90', 'Filete de ternera, judías verdes salteadas y tomate a la plancha.', 'img/comida/Pallarda-de-ternera.jpg'),
(11, 'Suprema de pollo', 'Principal', '8.90', 'Pechuga de pollo a la plancha, ensalada de lechuga, pico de gallo y salsa vinagreta.', 'img/comida/SupremaPollo.jpg'),
(12, 'Pizza vegetables lovers', 'Principal', '9.60', 'Salsa de tomate, mozzarella, calabacín, berenjena y pimiento rojo, tomate semiseco, queso de cabra, albahaca y salsa prezzemolo', 'img/comida/pizza-vegetables-lovers.jpg'),
(13, 'Pizza caprese', 'Principal', '9.60', '\r\nSalsa de tomate, mozzarella de Búfala 100% D.O. Campaña, tomate cherry, pimienta negra molida, albahaca en hojas y aceite virgen.', 'img/comida/pizza-caprese.jpg'),
(14, 'Raviolis rellenos de queso', 'Principal', '9.90', 'Raviolis con harina de espelta integral rellenos de queso ricotta y nueces con salsa de pesto, tomates cherry, queso parmesano y albahaca.', 'img/comida/raviolis-rellenos-queso.jpg'),
(15, 'Mariposas salteadas', 'Principal', '9.90', 'Mariposas de pasta con verduras frescas salteadas: calabacín, zanahoria, puerro, pimiento verde y rojo, espinacas y queso feta.', 'img/comida/farfalle-primavera.jpg'),
(16, 'Macheroni picantes', 'Principal', '9.90', 'Macarrones con salsa de tomate, ajo, guindilla, tomates cherry, pepperoni, perejil y queso parmesano.', 'img/comida/macharoni-picantes.jpg'),
(17, 'Medias lunas con trufas y seta', 'Principal', '9.90', 'Pasta en forma de lunas rellenas de trufa con salsa cremosa de setas.', 'img/comida/medias-lunas.jpg'),
(18, 'Bowl de Yogur y Muesli', 'Postre', '5.90', 'Yogur acompañado de fresas, plátano y piña, con muesli crujiente de avena, frutos secos y miel.', 'img/comida/bowl-de-yogur-y-muesli.jpg'),
(19, 'Nuevo Smoothie Green Vitality', 'Postre', '4.90', 'Zumo recién hecho de pepino, apio, manzana, espinacas y limón.', 'img/comida/green-smoothie.jpg'),
(20, 'Smoothie Yellow Tropic', 'Postre', '4.90', 'Zumo natural de Mango, piña, manzana y maracuyá.', 'img/comida/smoothie-yellow.jpg'),
(21, 'Smoothie Red Love', 'Postre', '4.90', 'Zumo natural de Frutos rojos, manzana, plátano y fresa.', 'img/comida/smoothie-red-love.jpg'),
(22, 'Pancakes con arándanos', 'Postre', '5.90', 'Deliciosos pancakes con miel Maple y salsa de arándanos.', 'img/comida/pancakes.jpg'),
(23, 'Agua', 'Bebida', '1.90', 'Agua fresca.', ''),
(24, 'Refresco', 'Bebida', '2.90', 'Coca-cola, Fanta Naranja/Limón, Aquarius, etc', ''),
(25, 'Mahou 5 estrellas', 'Bebida', '1.90', 'La clásica de Mahou.', ''),
(26, 'Copas', 'Bebida', '6.00', 'Deléitate con una de nuestras copas modernas sin olvidar su esencia.', '');

-- --------------------------------------------------------

--
-- Table structure for table `platospedido`
--

CREATE TABLE `platospedido` (
  `id_pedido` int(10) UNSIGNED NOT NULL,
  `id_plato` int(10) UNSIGNED NOT NULL,
  `cantidad` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `platospedido`
--

INSERT INTO `platospedido` (`id_pedido`, `id_plato`, `cantidad`) VALUES
(32, 1, 1),
(32, 2, 1),
(32, 3, 1),
(32, 4, 1),
(32, 5, 1),
(32, 6, 1),
(33, 1, 1),
(33, 2, 1),
(33, 3, 1),
(34, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reservas`
--

CREATE TABLE `reservas` (
  `id` int(10) UNSIGNED NOT NULL,
  `cliente` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_local` int(10) UNSIGNED NOT NULL,
  `dia` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservas`
--

INSERT INTO `reservas` (`id`, `cliente`, `email`, `id_local`, `dia`, `hora`) VALUES
(22, 'Raul', 'velsi13teu@gmail.com', 2, '2019-03-28', '14:00:00'),
(23, 'Raul', 'velsi13teu@gmail.com', 2, '2019-03-28', '14:00:00'),
(24, 'Raul', 'velsi13teu@gmail.com', 2, '2019-03-28', '14:00:00'),
(25, 'Raul', 'velsi13teu@gmail.com', 2, '2019-03-29', '14:00:00'),
(26, 'Raul', 'velsi13teu@gmail.com', 2, '2019-03-29', '14:00:00'),
(27, 'Raul', 'velsi13teu@gmail.com', 2, '2019-03-29', '12:00:00'),
(29, 'Raul', 'rvindel@ucm.es', 2, '2019-03-30', '20:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_local`,`dia`,`hora`);

--
-- Indexes for table `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plato`
--
ALTER TABLE `plato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platospedido`
--
ALTER TABLE `platospedido`
  ADD PRIMARY KEY (`id_pedido`,`id_plato`),
  ADD KEY `id_plato` (`id_plato`);

--
-- Indexes for table `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_local` (`id_local`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
  MODIFY `id_local` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `local`
--
ALTER TABLE `local`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `plato`
--
ALTER TABLE `plato`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `local` (`id`);

--
-- Constraints for table `platospedido`
--
ALTER TABLE `platospedido`
  ADD CONSTRAINT `platospedido_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `plato` (`id`),
  ADD CONSTRAINT `platospedido_ibfk_3` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id`);

--
-- Constraints for table `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_local`) REFERENCES `local` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
