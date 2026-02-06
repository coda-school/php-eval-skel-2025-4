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
- Suggestions de contenudocker
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



# FEEDBACK 


## Feedback général sur le projet

Le projet a été particulièrement complexe : nous avons rencontré de nombreuses difficultés liées aux migrations et à 
la gestion des bases de données. Pour nous aider, nous avons fait appel à l’IA ainsi qu’à AdamGPT, ThomasGPT et DarillGPT. Le 
début a été le plus compliqué, avec le fait que nous n'avions pas eu le temps d'avoir un cours complet sur Symfony - on a appris
en faisant des essais et en regardant des vidéos.
La répartition des tâches s’est faite de manière équitable et la collaboration au sein de l’équipe s’est déroulée parfaitement. Malgré le
retard que nous avions avec les absences pendant ces semaines, nous avons réussi à avancer d'un meilleur rythme vers la fin.


## Usage de l'IA

L'IA a été utilisé par tous pour le CSS. Nous avons également été aidé pour répondre à des questions, nous expliquer des façons de faire, 
faire du débug... 


## Avec le recul

Nous aurions du nous organiser un peu mieux sur les pages, pour avoir un projet plus homogène. Une meilleure gestion du temps aurait également
bien aidé. Une seule personne aurait fait la base de donnée et les migrations pour éviter les conflits, qui nous ont fait perdre beaucoup de temps.
