-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 09-01-2026 a les 14:57:57
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `epic_eats`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `alergans`
--

CREATE TABLE `alergans` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(100) NOT NULL,
  `imatge` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `alergans`
--

INSERT INTO `alergans` (`id`, `nom`, `descripcio`, `imatge`) VALUES
(1, 'Lactosa', 'Derivats de la llet', 'https://example.com/img/alergans/lactosa.png'),
(2, 'Gluten', 'Cereals amb gluten', 'https://example.com/img/alergans/gluten.png'),
(3, 'Fruits secs', 'Ametlles, nous, etc.', 'https://example.com/img/alergans/fruits_secs.png'),
(4, 'Lactosa', 'Derivats de la llet', 'https://example.com/img/alergans/lactosa.png'),
(5, 'Gluten', 'Cereals amb gluten', 'https://example.com/img/alergans/gluten.png'),
(6, 'Fruits secs', 'Ametlles, nous, etc.', 'https://example.com/img/alergans/fruits_secs.png');

-- --------------------------------------------------------

--
-- Estructura de la taula `alergans_ingredients`
--

CREATE TABLE `alergans_ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `id_alergan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `alergans_ingredients`
--

INSERT INTO `alergans_ingredients` (`id_ingredient`, `id_alergan`) VALUES
(1, 1),
(3, 2),
(2, 3),
(1, 1),
(3, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Estructura de la taula `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `imatge` varchar(255) NOT NULL DEFAULT 'IMG/ImgNotFound.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `categoria`
--

INSERT INTO `categoria` (`id`, `nom`, `imatge`) VALUES
(1, 'Entrants', 'IMG/pintxus.webp'),
(2, 'Plats principals', 'IMG/filet.webp'),
(3, 'Postres', 'IMG/cheescake.webp'),
(5, 'Begudes', 'IMG/aigua.webp'),
(6, 'Amanides', 'IMG/amanida.webp'),
(7, 'Pasta', 'IMG/spageti.webp'),
(8, 'Burgers', 'IMG/amburgesa.webp'),
(9, 'Sushi', 'IMG/sushi.webp'),
(10, 'Vegà', 'IMG/amanida.webp'),
(11, 'Especialitats', 'IMG/trosos-de-carn.webp');

-- --------------------------------------------------------

--
-- Estructura de la taula `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `preu_total` float(20,2) NOT NULL,
  `id_usuaris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `comanda`
--

INSERT INTO `comanda` (`id`, `preu_total`, `id_usuaris`) VALUES
(1, 17.40, 1),
(2, 11.90, 2),
(3, 12.00, 14),
(4, 37.38, 14),
(5, 0.00, 14),
(6, 0.00, 1),
(7, 0.00, 2);

-- --------------------------------------------------------

--
-- Estructura de la taula `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `quantitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `ingredients`
--

INSERT INTO `ingredients` (`id`, `nom`, `quantitat`) VALUES
(1, 'Formatge manxec', 5000),
(2, 'Tomàquet', 12000),
(3, 'Farina', 25000);

-- --------------------------------------------------------

--
-- Estructura de la taula `linea_comandes`
--

CREATE TABLE `linea_comandes` (
  `id` int(11) NOT NULL,
  `preu_unitat` float(20,2) NOT NULL,
  `id_comanda` int(11) NOT NULL,
  `id_producte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `linea_comandes`
--

INSERT INTO `linea_comandes` (`id`, `preu_unitat`, `id_comanda`, `id_producte`) VALUES
(5, 16.99, 4, 6),
(6, 16.99, 4, 6),
(7, 0.00, 5, 1),
(8, 0.00, 5, 4),
(9, 0.00, 5, 4),
(10, 0.00, 5, 4),
(11, 0.00, 5, 5),
(12, 12.50, 6, 22),
(13, 12.50, 6, 22),
(14, 11.90, 6, 5),
(15, 22.90, 7, 27),
(16, 24.90, 7, 14),
(17, 6.50, 7, 28),
(18, 6.50, 7, 28);

-- --------------------------------------------------------

--
-- Estructura de la taula `linea_comandes_ingredients`
--

CREATE TABLE `linea_comandes_ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `id_linea_comanda` int(11) NOT NULL,
  `preuIngredientExtra` float(10,2) NOT NULL,
  `quantitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `ofertes`
--

CREATE TABLE `ofertes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `tipus` varchar(20) NOT NULL,
  `datainici` datetime NOT NULL,
  `datafi` datetime NOT NULL,
  `valordescompte` float(10,2) DEFAULT NULL,
  `persentatjedescompte` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `ofertes`
--

INSERT INTO `ofertes` (`id`, `nom`, `tipus`, `datainici`, `datafi`, `valordescompte`, `persentatjedescompte`) VALUES
(1, 'Happy Hour Entrants', 'percentatge', '2026-01-01 17:00:00', '2026-02-01 20:00:00', NULL, 15),
(2, 'Descompte Pizza', 'valor', '2026-01-05 00:00:00', '2026-01-31 23:59:59', 2.00, NULL),
(3, 'Postres 2x1', 'percentatge', '2026-01-10 00:00:00', '2026-03-10 00:00:00', NULL, 50),
(4, 'Cupó 3 euros', 'valor', '2026-01-01 00:00:00', '2026-01-31 23:59:59', 3.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de la taula `productes`
--

CREATE TABLE `productes` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `descripcio` varchar(200) NOT NULL,
  `preu_unitat` float(20,2) NOT NULL,
  `imatge` varchar(1000) NOT NULL,
  `en_carta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `productes`
--

INSERT INTO `productes` (`id`, `nom`, `descripcio`, `preu_unitat`, `imatge`, `en_carta`) VALUES
(1, 'producte1', 'Descrpcio 1', 20.00, 'IMG/filet.webp', 1),
(4, 'Bruschetta', 'Pa torrat amb tomàquet i alfàbrega', 5.50, 'IMG/pintxus.webp', 1),
(5, 'Pizza Margherita', 'Tomàquet, mozzarella i alfàbrega fresca', 11.90, 'IMG/pitzza.webp', 1),
(6, 'producte2', 'Descrpcio 2', 16.99, 'IMG/trosos-de-carn.webp', 0),
(7, 'Croquetes de pernil', 'Croquetes cremoses de pernil ibèric', 6.90, 'IMG/croquetes.webp', 1),
(8, 'Patates braves', 'Patata cruixent amb salsa brava i allioli', 5.50, 'IMG/croquetes.webp', 1),
(9, 'Hummus amb pita', 'Hummus casolà amb pa de pita', 5.90, 'IMG/pintxus.webp', 1),
(10, 'Nachos amb guacamole', 'Nachos amb guacamole i pico de gallo', 7.20, 'IMG/pintxus.webp', 1),
(11, 'Amanida César', 'Enciam, pollastre, crostons i salsa césar', 10.50, 'IMG/amanida.webp', 1),
(12, 'Amanida mediterrània', 'Tomàquet, olives, feta i orenga', 9.80, 'IMG/amanida.webp', 1),
(13, 'Bowl vegà', 'Quinoa, alvocat, edamame i verdures', 11.90, 'IMG/amanida.webp', 1),
(14, 'Entrecot a la brasa', 'Entrecot amb pebre i sal en escates', 24.90, 'IMG/filetde-carn.webp', 1),
(15, 'Costelles BBQ', 'Costelles amb salsa barbacoa i patates', 19.90, 'IMG/trosos-de-carn.webp', 1),
(16, 'Salmó a la planxa', 'Salmó amb llimona i verdures', 18.40, 'IMG/filet-fet.webp', 1),
(17, 'Pollastre teriyaki', 'Pollastre amb salsa teriyaki i arròs', 14.90, 'IMG/pollastre.webp', 1),
(18, 'Curry vegà', 'Curry de verdures amb arròs basmati', 13.50, 'IMG/filet en paella.webp', 1),
(19, 'Spaghetti carbonara', 'Carbonara cremosa amb bacó', 12.90, 'IMG/spageti.webp', 1),
(20, 'Pasta al pesto', 'Pesto d’alfàbrega i parmesà', 11.90, 'IMG/spageti.webp', 1),
(21, 'Lasanya de carn', 'Lasanya clàssica gratinada', 13.90, 'IMG/lasanya.webp', 1),
(22, 'Burger clàssica', 'Vedella, cheddar, enciam i tomàquet', 12.50, 'IMG/amburgesa.webp', 1),
(23, 'Burger doble', 'Doble vedella, doble cheddar i bacon', 15.90, 'IMG/amburgesa2.webp', 1),
(24, 'Burger vegana', 'Hamburguesa vegetal amb alvocat', 13.90, 'IMG/amburgesa.webp', 1),
(25, 'Nigiri salmó (6u)', 'Nigiri de salmó fresc', 13.50, 'IMG/sushi.webp', 1),
(26, 'Uramaki alvocat (8u)', 'Uramaki d’alvocat i cogombre', 12.80, 'IMG/sushi.webp', 1),
(27, 'Mix sushi (16u)', 'Selecció variada de sushi', 22.90, 'IMG/sushi.webp', 1),
(28, 'Cheesecake', 'Pastís de formatge amb coulis', 6.50, 'IMG/cheescake.webp', 1),
(29, 'Tiramisú', 'Tiramisú clàssic italià', 6.20, 'IMG/postre.webp', 1),
(30, 'Brownie amb gelat', 'Brownie de xocolata amb gelat', 6.90, 'IMG/brownie.webp', 1),
(31, 'Fruita de temporada', 'Assortit de fruita fresca', 4.90, 'IMG/raim.webp', 1),
(32, 'Aigua', 'Aigua mineral 50cl', 1.90, 'IMG/aigua.webp', 1),
(33, 'Refresc cola', 'Refresc 33cl', 2.50, 'IMG/cocacola.webp', 1),
(34, 'Llimonada', 'Llimonada casolana', 3.20, 'IMG/llimonada.webp', 1),
(35, 'Cafè', 'Cafè espresso', 1.80, 'IMG/cafe.webp', 1),
(36, 'Tè verd', 'Infusió de te verd', 2.20, 'IMG/te-verd.webp', 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `productes_categoria`
--

CREATE TABLE `productes_categoria` (
  `id_producte` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `productes_categoria`
--

INSERT INTO `productes_categoria` (`id_producte`, `id_categoria`) VALUES
(4, 1),
(5, 2),
(7, 1),
(8, 1),
(9, 1),
(9, 10),
(10, 1),
(11, 6),
(12, 6),
(13, 6),
(13, 10),
(14, 2),
(14, 11),
(15, 2),
(15, 11),
(16, 2),
(17, 2),
(18, 2),
(18, 10),
(19, 7),
(19, 2),
(20, 7),
(20, 2),
(21, 7),
(21, 2),
(22, 8),
(22, 2),
(23, 8),
(23, 2),
(24, 8),
(24, 10),
(25, 9),
(25, 2),
(26, 9),
(26, 10),
(27, 9),
(27, 2),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(31, 10),
(32, 5),
(33, 5),
(34, 5),
(35, 5),
(36, 5);

-- --------------------------------------------------------

--
-- Estructura de la taula `productes_ingredients`
--

CREATE TABLE `productes_ingredients` (
  `id_producte` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `quantitat` int(11) NOT NULL,
  `preuIngredeientExtra` float(10,2) NOT NULL,
  `preuPerDefecte` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `productes_ingredients`
--

INSERT INTO `productes_ingredients` (`id_producte`, `id_ingredient`, `id`, `quantitat`, `preuIngredeientExtra`, `preuPerDefecte`) VALUES
(1, 2, 1, 1, 0.30, 0.00);

-- --------------------------------------------------------

--
-- Estructura de la taula `productes_ofertes`
--

CREATE TABLE `productes_ofertes` (
  `id_producte` int(11) NOT NULL,
  `id_oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `productes_ofertes`
--

INSERT INTO `productes_ofertes` (`id_producte`, `id_oferta`) VALUES
(1, 2),
(1, 2),
(7, 1),
(8, 1),
(9, 1),
(5, 2),
(28, 3),
(29, 3),
(14, 4);

-- --------------------------------------------------------

--
-- Estructura de la taula `proveidor`
--

CREATE TABLE `proveidor` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `correu` varchar(50) NOT NULL,
  `telefon` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `proveidor`
--

INSERT INTO `proveidor` (`id`, `nom`, `correu`, `telefon`) VALUES
(1, 'Frescos del Maresme', 'contacte@frescosmaresme.cat', 931112233),
(2, 'Làctics Pirineu', 'vendes@lacticspirineu.cat', 972445566),
(3, 'Molins i Farines', 'comandes@molinsfarines.cat', 977889900);

-- --------------------------------------------------------

--
-- Estructura de la taula `proveidor_ingredients`
--

CREATE TABLE `proveidor_ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `id_proveidor` int(11) NOT NULL,
  `preu_unitat` float(10,2) NOT NULL,
  `quantitat` int(11) NOT NULL,
  `diaEntrega` datetime NOT NULL,
  `estat` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `reserva`
--

CREATE TABLE `reserva` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `numpersones` int(9) NOT NULL,
  `id_usuaris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `reserva`
--

INSERT INTO `reserva` (`id`, `data`, `numpersones`, `id_usuaris`) VALUES
(1, '2026-01-09 21:00:00', 2, 1),
(2, '2026-01-10 14:00:00', 4, 2),
(3, '2026-01-11 20:30:00', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuaris`
--

CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL,
  `nomUsuari` varchar(20) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `cognoms` varchar(50) NOT NULL,
  `correu` varchar(50) NOT NULL,
  `telefon` varchar(9) DEFAULT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `usuaris`
--

INSERT INTO `usuaris` (`id`, `nomUsuari`, `contrasenya`, `nom`, `cognoms`, `correu`, `telefon`, `rol`) VALUES
(1, 'anna', '$2y$10$exampleHashAnna', 'Anna', 'Garcia Pons', 'anna@epiceats.cat', '612345678', 'client'),
(2, 'marc', '$2y$10$exampleHashMarc', 'Marc', 'Soler Vidal', 'marc@epiceats.cat', '698765432', 'client'),
(3, 'laia', '$2y$10$exampleHashLaia', 'Laia', 'Roca Serra', 'laia@epiceats.cat', NULL, 'admin'),
(14, '123', '$2y$10$LkUMsRqBTpUPcBBjIsZiOezmIlcMvkbmwuJy.8dpRY1o7QjKlzq9m', '123', '123', '123@gmail.com', '123123123', 'admin');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `alergans`
--
ALTER TABLE `alergans`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `alergans_ingredients`
--
ALTER TABLE `alergans_ingredients`
  ADD KEY `id_alergan` (`id_alergan`),
  ADD KEY `id_ingredient` (`id_ingredient`);

--
-- Índexs per a la taula `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comanda_ibfk_1` (`id_usuaris`);

--
-- Índexs per a la taula `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `linea_comandes`
--
ALTER TABLE `linea_comandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_comanda` (`id_comanda`),
  ADD KEY `id_producte` (`id_producte`);

--
-- Índexs per a la taula `linea_comandes_ingredients`
--
ALTER TABLE `linea_comandes_ingredients`
  ADD KEY `id_ingredient` (`id_ingredient`),
  ADD KEY `id_linea_comanda` (`id_linea_comanda`);

--
-- Índexs per a la taula `ofertes`
--
ALTER TABLE `ofertes`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `productes`
--
ALTER TABLE `productes`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `productes_categoria`
--
ALTER TABLE `productes_categoria`
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_producte` (`id_producte`);

--
-- Índexs per a la taula `productes_ingredients`
--
ALTER TABLE `productes_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ingredient` (`id_ingredient`),
  ADD KEY `id_producte` (`id_producte`);

--
-- Índexs per a la taula `productes_ofertes`
--
ALTER TABLE `productes_ofertes`
  ADD KEY `id_oferta` (`id_oferta`),
  ADD KEY `id_producte` (`id_producte`);

--
-- Índexs per a la taula `proveidor`
--
ALTER TABLE `proveidor`
  ADD PRIMARY KEY (`id`);

--
-- Índexs per a la taula `proveidor_ingredients`
--
ALTER TABLE `proveidor_ingredients`
  ADD KEY `id_ingredient` (`id_ingredient`),
  ADD KEY `id_proveidor` (`id_proveidor`);

--
-- Índexs per a la taula `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserva_ibfk_1` (`id_usuaris`);

--
-- Índexs per a la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NomUsuari` (`nomUsuari`),
  ADD UNIQUE KEY `correu` (`correu`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `alergans`
--
ALTER TABLE `alergans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la taula `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la taula `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la taula `linea_comandes`
--
ALTER TABLE `linea_comandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la taula `ofertes`
--
ALTER TABLE `ofertes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la taula `productes`
--
ALTER TABLE `productes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la taula `productes_ingredients`
--
ALTER TABLE `productes_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `proveidor`
--
ALTER TABLE `proveidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `alergans_ingredients`
--
ALTER TABLE `alergans_ingredients`
  ADD CONSTRAINT `alergans_ingredients_ibfk_1` FOREIGN KEY (`id_alergan`) REFERENCES `alergans` (`id`),
  ADD CONSTRAINT `alergans_ingredients_ibfk_2` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id`);

--
-- Restriccions per a la taula `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`id_usuaris`) REFERENCES `usuaris` (`id`);

--
-- Restriccions per a la taula `linea_comandes`
--
ALTER TABLE `linea_comandes`
  ADD CONSTRAINT `linea_comandes_ibfk_1` FOREIGN KEY (`id_comanda`) REFERENCES `comanda` (`id`),
  ADD CONSTRAINT `linea_comandes_ibfk_2` FOREIGN KEY (`id_producte`) REFERENCES `productes` (`id`);

--
-- Restriccions per a la taula `linea_comandes_ingredients`
--
ALTER TABLE `linea_comandes_ingredients`
  ADD CONSTRAINT `linea_comandes_ingredients_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `linea_comandes_ingredients_ibfk_2` FOREIGN KEY (`id_linea_comanda`) REFERENCES `linea_comandes` (`id`);

--
-- Restriccions per a la taula `productes_categoria`
--
ALTER TABLE `productes_categoria`
  ADD CONSTRAINT `productes_categoria_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `productes_categoria_ibfk_2` FOREIGN KEY (`id_producte`) REFERENCES `productes` (`id`);

--
-- Restriccions per a la taula `productes_ingredients`
--
ALTER TABLE `productes_ingredients`
  ADD CONSTRAINT `productes_ingredients_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `productes_ingredients_ibfk_2` FOREIGN KEY (`id_producte`) REFERENCES `productes` (`id`);

--
-- Restriccions per a la taula `productes_ofertes`
--
ALTER TABLE `productes_ofertes`
  ADD CONSTRAINT `productes_ofertes_ibfk_1` FOREIGN KEY (`id_oferta`) REFERENCES `ofertes` (`id`),
  ADD CONSTRAINT `productes_ofertes_ibfk_2` FOREIGN KEY (`id_producte`) REFERENCES `productes` (`id`);

--
-- Restriccions per a la taula `proveidor_ingredients`
--
ALTER TABLE `proveidor_ingredients`
  ADD CONSTRAINT `proveidor_ingredients_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `proveidor_ingredients_ibfk_2` FOREIGN KEY (`id_proveidor`) REFERENCES `proveidor` (`id`);

--
-- Restriccions per a la taula `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_usuaris`) REFERENCES `usuaris` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
