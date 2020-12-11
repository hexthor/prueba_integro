-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2020 at 06:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prueba_integro`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `synopsis` text NOT NULL,
  `year` year(4) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `synopsis`, `year`, `deleted`) VALUES
('2725960e-3a99-11eb-929f-d4bed904708f', 'The Prestige', 'Un encuentro durante una sesión fraudulenta provoca que dos magos del siglo XIX, Alfred Borden y Rupert Angier, se enfrenten en una intensa batalla por la supremacía. Las consecuencias son terribles cuando ambos intentan triunfar no sólo superando a su rival, sino destruyéndolo.', 2006, 0),
('2b8202da-3a98-11eb-929f-d4bed904708f', 'The Dark Knight', 'Batman tiene que mantener el equilibrio entre el heroísmo y el vigilantismo para pelear contra un vil criminal conocido como el Guasón, que pretende sumir Ciudad Gótica en la anarquía.', 2008, 0),
('482767fc-3a98-11eb-929f-d4bed904708f', 'Inception', 'Dom Cobb es un ladrón con una extraña habilidad para entrar a los sueños de la gente y robarles los secretos de sus subconscientes. Su habilidad lo ha vuelto muy popular en el mundo del espionaje corporativo, pero ha tenido un gran costo en la gente que ama. Cobb obtiene la oportunidad de redimirse cuando recibe una tarea imposible: plantar una idea en la mente de una persona. Si tiene éxito, será el crimen perfecto, pero un enemigo se anticipa a sus movimientos.', 2010, 0),
('600e47e1-3a98-11eb-929f-d4bed904708f', 'Interstellar', 'Gracias a un descubrimiento, un grupo de científicos y exploradores, encabezados por Cooper, se embarcan en un viaje espacial para encontrar un lugar con las condiciones necesarias para reemplazar a la Tierra y comenzar una nueva vida allí.', 2014, 0),
('8cd0f199-3a98-11eb-929f-d4bed904708f', 'Dunkerque', 'En mayo de 1940, durante la Segunda Guerra Mundial, Alemania avanza hacia Francia, atrapando a las tropas aliadas en las playas de Dunkerque. Bajo protección aérea y terrestre de las fuerzas británicas y francesas, las tropas son evacuadas lenta y metódicamente de la playa utilizando cualquier embarcación militar o civil disponible. Al final de la heroica misión, 330.000 soldados franceses, británicos, belgas y holandeses son evacuados sanos y salvos.', 2017, 0),
('f41d0b79-3a97-11eb-929f-d4bed904708f', 'TENET', 'Una acción épica que gira en torno al espionaje internacional, los viajes en el tiempo y la evolución, en la que un agente secreto debe prevenir la Tercera Guerra Mundial.', 2020, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `deleted`) VALUES
('bbdec31c-3b57-11eb-929f-d4bed904708f', 'Prueba', 'prueba', 'd2ef49580a8c8a3511b9b4d163a93459', 0),
('c21e78f5-3a7f-11eb-929f-d4bed904708f', 'Hector Moreno', 'hectoralf', '575109a5e35cf2e2789879cc89c65936', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
