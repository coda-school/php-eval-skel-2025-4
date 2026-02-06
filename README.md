# Projet KWIKKER — Mini réseau social façon Twitter

Kwikker est une application web développée avec Symfony permettant de publier des messages courts, suivre d’autres utilisateurs et consulter un fil d’actualité ou un fil des tendances.


## Fonctionnalités principales

### Gestion des utilisateurs
- Inscription et connexion (sans validation email)
- Profil utilisateur : pseudo, bio, informations de base
- Modification du profil

### Publication de tweets
- Création de messages (280 caractères maximum)
- Modification et suppression par l’auteur

### Système de suivi
- Suivre et ne plus suivre un utilisateur
- Page profil avec liste des tweets, followers et following

### Fil d’actualité
- Affichage des tweets des utilisateurs suivis
- Tri du plus récent au plus ancien
- Suggestions de contenu
- Pagination


## Fonctionnalités bonus

- Système de likes
- Recherche de tweets
- Tweets populaires
- Système de commentaires
- Affichage de la date relative
- Partage de posts
- Ajout d’images aux tweets (fonctionnalité désactivée suite à un problème de migration)


## Technologies utilisées

- Symfony 6
- Twig
- Doctrine ORM
- MySQL / MariaDB
- PHP 8.2+


## Installation

bash ```
git clone https://xxx.git/
cd kwikker
composer install ``` 

## Commandes utilisées

bash ```
sudo -u postgres psql -d app
php bin/console doctrine:migrations:migrate
php bin/console make:migration
docker compose exec php sh
git remote set-url origin https://xxx.git/ ```
