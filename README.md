# Vie d’ECE

> Projet de Programmation Web Dynamique – Année universitaire 2024–2025  
> Inspiré du site [VieDeMerde.fr](https://www.viedemerde.fr)

## 🎯 Objectif du projet

Développer une application web permettant aux étudiants de l’ECE de partager des anecdotes humoristiques de la vie étudiante, appelées VdECE. Ce projet est réalisé sans framework PHP, uniquement avec les outils vus en cours.

## 🚀 Fonctionnalités

- Page d'accueil listant les VdECE les plus récentes
- Formulaire d'ajout d'une VdECE
- Page dédiée à chaque VdECE avec ses commentaires
- Ajout de commentaires (avec gestion AJAX)
- Système de session pour retenir les pseudos
- Mise en page via Bootstrap
- Pagination sur la page d'accueil

## 🧱 Structure du projet

- `index.php` : Page d’accueil avec la liste des VdECE
- `add_vdece.php` : Ajout d’une VdECE
- `show_vdece.php` : Affichage d’une VdECE et ses commentaires
- `add_comment.php` : Traitement de l’ajout d’un commentaire
- `config.php` : Fichier de configuration de la base de données
- `code.sql` : Structure de la base de données (exportée depuis phpMyAdmin)

## 🗃️ Base de données

Le projet utilise une base de données MySQL avec les entités suivantes :

- vdece : id, pseudo, contenu, date
- commentaire: id, id_vdece (clé étrangère), pseudo, contenu, date

Voir le fichier `code.sql` pour le schéma complet.

## 🛠️ Technologies utilisées

- PHP
- MySQL
- HTML / CSS
- Bootstrap (framework CSS)
- JavaScript (AJAX)

## ✅ Tâches réalisées

- [x] Création de la base de données avec contraintes
- [x] Formulaire d’ajout d’une VdECE
- [x] Affichage des commentaires avec AJAX
- [x] Session pour pseudo
- [x] Pagination
- [x] Design avec Bootstrap

## 📸 Aperçu

Des captures d’écran sont disponibles dans le document complémentaire (`document.pdf`) accompagnant ce dépôt.

## Auteurs

Anaïs Renonciat, 
Bartolomeo de Felice, 
Lilou de Heaulme de Bouscocq,
Clément Tirilly
