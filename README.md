# Procédure d'installation du projet

## Pré-requis

-   PHP version 8.x
-   Composer
-   Node
-   Npm
-   MySQL

## 1.Installation

Pour récupérer le projet, exécutez la commande :

```git
git clone https://github.com/rkaawkaa/Blog.git
```

Puis naviguez vers le dossier du projet :

```git
cd blog
```

Puis effectuez les commandes :

```
composer install
npm install
cp .env.example .env
```

## 2.Configuration de la base de données

Après avoir lancé vos serveurs MySQL et Apache en local (avec XAMPP par exemple), aller sur le fichier .env du projet et paramétrez la connexion avec la base de données en modifiant ces champs :

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogdb
DB_USERNAME=root
DB_PASSWORD=
```

Normalement, uniquement le nom de la database est à modifier. Vous pouvez soit créer en amont une base de données via phpmyadmin en renseignant le même nom dans le fichier .env, ou bien on vous proposera au moment de la migration de créer la base de données.

## 3.Création de la clé et migrations

Toujours dans le dossier du projet, exécutez ces commandes :

```
php artisan key:generate
php artisan migrate
```

Puis, faites la commande :

```
npm run dev
```

## 4. Lancement du serveur de développement artisan

Dans le dossier du projet, ouvrez un nouveau terminal et exécutez la commande :

```
php artisan serve
```

Puis naviguez vers l'adresse du serveur de développement:<br>
![image](https://github.com/rkaawkaa/Blog/assets/88223901/8b4754a3-dc21-459f-802a-4d0abcb6f323)




## 5. Ensemencement de la base de données

Pour générer des données, effectuez la commande (dans un nouveau terminal et sans arrêter le serveur de développement):

```
php artisan db:seed
```

Puis rafraichissez votre navigateur pour voir les nouvelles données sur l'application web.
<br><br>
![image](https://github.com/rkaawkaa/Blog/assets/88223901/68389b0d-cb76-4d92-9032-d8a5675fe7c7)

**Développé par KAWKA Robin**
