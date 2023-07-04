Pour setup le projet : 

- Modifier le point env selon votre configuration
- php bin/console doctrine:database:create pour créer la base de donnée
- composer require symfony/webpack-encore-bundle pour installer le webpack
- npm install pour installer les dépendences javascript
- composer install pour installer les dépendences Symfony

- npm run build pour build les fichiers js

- symfony serve ou php bin/console server:start pour lancer l'application

- php bin/console doctrine:migrations:migrate pour executer la migration du dossier migrations

