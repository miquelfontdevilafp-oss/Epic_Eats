-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 06-01-2026 a les 19:10:39
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

-- --------------------------------------------------------

--
-- Estructura de la taula `alergans_ingredients`
--

CREATE TABLE `alergans_ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `id_alergan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `comanda`
--

CREATE TABLE `comanda` (
  `id` int(11) NOT NULL,
  `preu_total` float(20,2) NOT NULL,
  `id_usuaris` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de la taula `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `quantitat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'producte1', 'Descrpcio 1', 20.00, 'imatge.svg/png/webp', 1),
(6, 'producte2', 'Descrpcio 2', 16.99, 'imatge.svg/png/webp', 0);

-- --------------------------------------------------------

--
-- Estructura de la taula `productes_categoria`
--

CREATE TABLE `productes_categoria` (
  `id_producte` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de la taula `productes_ofertes`
--

CREATE TABLE `productes_ofertes` (
  `id_producte` int(11) NOT NULL,
  `id_oferta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la taula `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la taula `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la taula `linea_comandes`
--
ALTER TABLE `linea_comandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la taula `ofertes`
--
ALTER TABLE `ofertes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la taula `productes`
--
ALTER TABLE `productes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la taula `productes_ingredients`
--
ALTER TABLE `productes_ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `proveidor`
--
ALTER TABLE `proveidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la taula `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la taula `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
