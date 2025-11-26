START TRANSACTION;

-- ============================
-- USUARIS
-- ============================
INSERT INTO usuaris (nomUsuari, contrasenya, nom, cognoms, correu, telefon, rol) VALUES
('jordi123', 'jordi1234', 'Jordi', 'Martínez Soler', 'jordi@example.com', '612345678', 'client'),
('anna_garcia', 'annaPass01', 'Anna', 'Garcia Puig', 'anna@example.com', '698745612', 'client'),
('admin1', 'AdminStrongPass', 'Pau', 'Ribas Torres', 'pau@example.com', '677112233', 'administrador');


-- ============================
-- CATEGORIES
-- ============================
INSERT INTO categoria (nom) VALUES
('Entrants'),
('Pizzes'),
('Begudes'),
('Postres');

-- ============================
-- INGREDIENTS
-- ============================
INSERT INTO ingredients (nom, quantitat) VALUES
('Tomàquet', 100),
('Formatge mozzarella', 80),
('Pernil dolç', 50),
('Farina', 200),
('Olives negres', 60),
('Xocolata', 30),
('Crema de llet', 40),
('Sucre', 70);

-- ============================
-- AL·LÈRGENS
-- ============================
INSERT INTO alergans (nom, descripcio, imatge) VALUES
('Gluten', 'Conté derivats del blat', 'img/gluten.png'),
('Làctics', 'Conté productes lactis', 'img/lactics.png'),
('Fruits secs', 'Risc per a al·lèrgics als fruits secs', 'img/nuts.png');

-- ============================
-- AL·LÈRGENS x INGREDIENTS
-- ============================
INSERT INTO alergans__ingredients (id_ingredient, id_alergan) VALUES
(4, 1),
(2, 2),
(7, 2);

-- ============================
-- PRODUCTES
-- ============================
INSERT INTO productes (nom, descripcio, preu_unitat, temps_coaccio, imatge, en_carta) VALUES
('Pizza Margarita', 'Pizza clàssica amb tomàquet i mozzarella', 9.90, '00:10:00', 'img/margarita.jpg', 1),
('Pizza 4 Formatges', 'Barreja de formatges italians', 12.50, '00:12:00', 'img/4formatges.jpg', 1),
('Coca-cola', 'Refresc de cola', 2.20, '00:00:00', 'img/cocacola.jpg', 1),
('Gelat de xocolata', 'Gelat artesà de xocolata', 3.80, '00:00:00', 'img/gelat.jpg', 1);

-- ============================
-- PRODUCTES x CATEGORIES
-- ============================
INSERT INTO productes__categoria (id_producte, id_categoria) VALUES
(1, 2),
(2, 2),
(3, 3),
(4, 4);

-- ============================
-- PRODUCTES x INGREDIENTS
-- ============================
INSERT INTO productes__ingredients (id_producte, id_ingredient, quantitat, preuIngredeientExtra, preuPerDefecte) VALUES
(1, 1, 1, 0.50, 0.30),
(1, 2, 1, 0.70, 0.50),
(2, 2, 1, 0.70, 0.50),
(2, 7, 1, 0.60, 0.40),
(4, 6, 1, 0.40, 0.20);

-- ============================
-- OFERTES
-- ============================
INSERT INTO ofertes (nom, tipus, datainici, datafi, valordescompte, persentatjedescompte) VALUES
('Promo Pizza', 'percentatge', '2025-01-01 00:00:00', '2025-12-31 23:59:59', NULL, 10),
('Descompte refresc', 'valor', '2025-03-01 00:00:00', '2025-05:31 23:59:59', 0.50, NULL);

-- ============================
-- PRODUCTES x OFERTES
-- ============================
INSERT INTO productes__ofertes (id_producte, id_oferta) VALUES
(1, 1),
(2, 1),
(3, 2);

-- ============================
-- PROVEÏDORS
-- ============================
INSERT INTO proveidor (nom, correu, telefon) VALUES
('Distribucions Catalanes', 'contacte@distcat.com', 934556677),
('La Formatgeria', 'info@formatgeria.com', 932223344);

-- ============================
-- PROVEÏDORS x INGREDIENTS
-- ============================
INSERT INTO proveidor__ingredients (id_ingredient, id_proveidor, preu_unitat, quantitat, diaEntrega, estat) VALUES
(1, 1, 0.50, 100, '2025-02-01 09:00:00', 'entregat'),
(2, 2, 1.20, 80, '2025-02-02 10:00:00', 'pendent'),
(4, 1, 0.30, 200, '2025-02-05 15:00:00', 'entregat');

-- ============================
-- RESERVES
-- ============================
INSERT INTO reserva (data, numpersones, id_usuaris) VALUES
('2025-02-10 20:30:00', 4, 1),
('2025-02-12 21:00:00', 2, 2);

-- ============================
-- COMANDES
-- ============================
INSERT INTO comanda (preu_total, id_usuaris) VALUES
(14.70, 1),
(22.40, 2);

-- ============================
-- LÍNIES DE COMANDA
-- ============================
INSERT INTO linea_comandes (preu_unitat, id_comanda, id_producte) VALUES
(9.90, 1, 1),
(2.20, 1, 3),
(12.50, 2, 2),
(3.80, 2, 4);

-- ============================
-- INGREDIENTS EXTRA A COMANDES
-- ============================
INSERT INTO linea_comandes__ingredients (id_ingredient, id_linea_comanda, preuIngredientExtra, quantitat) VALUES
(5, 1, 0.40, 1),
(2, 3, 0.70, 1);

COMMIT;
