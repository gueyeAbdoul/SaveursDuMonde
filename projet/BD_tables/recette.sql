-- -- Supprimer la base si elle existe et la recréer
-- DROP DATABASE IF EXISTS bdRecette;
-- CREATE DATABASE bdRecette;
-- \c bdRecette  -- Se connecter à la base (ou utiliser psql -d bdRecette)

-- -- Création de la table Recette
-- CREATE TABLE Recette (
--   id SERIAL PRIMARY KEY,
--   title VARCHAR(255) NOT NULL,
--   description TEXT NOT NULL,
--   photo VARCHAR(255) NOT NULL
-- );

-- -- Création de la table Ingredient
-- CREATE TABLE Ingredient (
--   id SERIAL PRIMARY KEY,
--   title VARCHAR(255) NOT NULL,
--   quantity VARCHAR(255) NOT NULL,
--   image VARCHAR(255) NOT NULL
-- );

-- -- Création de la table Tag
-- CREATE TABLE Tag (
--   id SERIAL PRIMARY KEY,
--   htag VARCHAR(255) NOT NULL
-- );

-- -- Création de la table Ingredient_Recette
-- CREATE TABLE Ingredient_Recette (
--   id SERIAL PRIMARY KEY,
--   ingredient_id INT NOT NULL,
--   recette_id INT NOT NULL
-- );

-- -- Création de la table Tag_Recette
-- CREATE TABLE Tag_Recette (
--   id SERIAL PRIMARY KEY,
--   tag_id INT NOT NULL,
--   recette_id INT NOT NULL
-- );

-- -- Ajout des clés étrangères avec ON DELETE CASCADE
-- ALTER TABLE Ingredient_Recette
--   ADD CONSTRAINT fk_recette_ingredient FOREIGN KEY (recette_id) REFERENCES Recette(id) ON UPDATE CASCADE ON DELETE CASCADE,
--   ADD CONSTRAINT fk_ingredient FOREIGN KEY (ingredient_id) REFERENCES Ingredient(id) ON UPDATE CASCADE ON DELETE CASCADE;

-- ALTER TABLE Tag_Recette
--   ADD CONSTRAINT fk_recette_tag FOREIGN KEY (recette_id) REFERENCES Recette(id) ON UPDATE CASCADE ON DELETE CASCADE,
--   ADD CONSTRAINT fk_tag FOREIGN KEY (tag_id) REFERENCES Tag(id) ON UPDATE CASCADE ON DELETE CASCADE;

-- -- Importation des données depuis des fichiers CSV avec COPY

-- COPY Recette(title, description, photo) FROM 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Recette.csv' DELIMITER ',' CSV HEADER;
-- COPY Ingredient(title, quantity, image) FROM 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Ingredient.csv' DELIMITER ',' CSV HEADER;
-- COPY Tag(htag) FROM 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Tag.csv' DELIMITER ',' CSV HEADER;
-- COPY Ingredient_Recette(ingredient_id, recette_id) FROM 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Ingredient_Recette.csv' DELIMITER ',' CSV HEADER;
-- COPY Tag_Recette(tag_id, recette_id) FROM 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Tag_Recette.csv' DELIMITER ',' CSV HEADER;


-- Supprimer la base si elle existe et la recréer
DROP DATABASE IF EXISTS bdRecette;
CREATE DATABASE bdRecette CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utiliser la base
USE bdRecette;

-- Création de la table Recette
CREATE TABLE Recette (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  photo VARCHAR(255) NOT NULL
);

-- Création de la table Ingredient
CREATE TABLE Ingredient (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  quantity VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL
);

-- Création de la table Tag
CREATE TABLE Tag (
  id INT AUTO_INCREMENT PRIMARY KEY,
  htag VARCHAR(255) NOT NULL
);

-- Création de la table Ingredient_Recette
CREATE TABLE Ingredient_Recette (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ingredient_id INT NOT NULL,
  recette_id INT NOT NULL
);

-- Création de la table Tag_Recette
CREATE TABLE Tag_Recette (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tag_id INT NOT NULL,
  recette_id INT NOT NULL
);

-- Ajout des clés étrangères avec ON DELETE CASCADE
ALTER TABLE Ingredient_Recette
  ADD CONSTRAINT fk_recette_ingredient FOREIGN KEY (recette_id) REFERENCES Recette(id) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT fk_ingredient FOREIGN KEY (ingredient_id) REFERENCES Ingredient(id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Tag_Recette
  ADD CONSTRAINT fk_recette_tag FOREIGN KEY (recette_id) REFERENCES Recette(id) ON UPDATE CASCADE ON DELETE CASCADE,
  ADD CONSTRAINT fk_tag FOREIGN KEY (tag_id) REFERENCES Tag(id) ON UPDATE CASCADE ON DELETE CASCADE;

-- Configuration pour permettre l'import de fichiers
SET GLOBAL local_infile = 1;

-- Importation des données depuis des fichiers CSV
-- Note: Vous devrez peut-être ajuster les chemins et les permissions

LOAD DATA LOCAL INFILE 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Recette.csv'
INTO TABLE Recette
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(title, description, photo);

LOAD DATA LOCAL INFILE 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Ingredient.csv'
INTO TABLE Ingredient
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(title, quantity, image);

LOAD DATA LOCAL INFILE 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Tag.csv'
INTO TABLE Tag
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(htag);

LOAD DATA LOCAL INFILE 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Ingredient_Recette.csv'
INTO TABLE Ingredient_Recette
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(ingredient_id, recette_id);

LOAD DATA LOCAL INFILE 'C:/wamp64/www/SaveursDuMonde/projet/BD_tables/Tag_Recette.csv'
INTO TABLE Tag_Recette
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(tag_id, recette_id);