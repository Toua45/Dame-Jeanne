# Dame-Jeanne
Réalisation et conception du site Internet Dame-Jeanne.

Projet client

 - Les technologies utilisées sont : PHP 7.2 / Symfony 4.4.3 / Doctrine 2 / Twig / HTML 5 / CSS-SCSS / Bootstrap 4 / Uikit / Javascript / MySQL
 - Développement de fonctionnalités : identification, téléchargement de fichier format pdf, carte interactive, etc.
 - Méthode Scrum / Agile



# Installer le projet Dame-Jeanne

-  Cloner le repository Dame-Jeanne (https://github.com/Toua45/Dame-Jeanne)

-  Créer un fichier .env.local à partir du fichier .env et renseigner vos données sur cette ligne :
```sh
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```
*db_user*:  votre nom d’utilisateur
*db_password*: votre mot de passe
*db_name*: le nom de la base de données

-  Installer Composer, avec la commande :
```sh
$ composer install
```

-  [Initialiser et installer yarn](https://classic.yarnpkg.com/fr/docs/install/#debian-stable) 

-  Créer une base de données, avec la commande :
```sh
$ php bin/console doctrine:database:create
```
-  Mettre à jour la base de données, avec la commande :
```sh
$ php bin/console make:migration
$ php bin/console doctrine:schema:update --force
```
-  Charger les fixtures : 
```sh
$ php bin/console doctrine:fixture:load --append
```

-  Exécuter Webpack, avec la commande :
```sh
$ yarn encore dev –watch (pour un environnement de développement)
$ yarn encore production (pour un environnement de production)
```
- Lancer le serveur, avec la commande :
```sh
$ symfony server:start
```



# Contributeurs
-  Va Toua [Toua45](https://github.com/Toua45)
-  Maurin Lilian [limoliphi](https://github.com/limoliphi)
-  Delamare Lionel [Lionel21](https://github.com/Lionel21)
