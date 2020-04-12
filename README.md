# [@SardocheBot](https://twitter.com/SardocheBot)

Un bot Twitter pour troll sardoche.

## Installation

Pour installer un BotSardoche, il vous faut :
* Une base de données MySQL/MariaDB
* Un serveur PHP
* Un accès développeur à l'API de Twitter

Suivez ces étapes :

### La base de données
 - Créer un base de données sur votre serveur `SQL`
```mysql
CREATE DATABASE urbot;
``` 
#### Les Tables
- Importez le fichier lexique.sql dans votre système de base de données 
```bash
mysql -u root -p urbot < lexique.sql
```

### Librarie externe
- Récupérez les librairies [TwitterAPIExchange.php](https://github.com/J7mbo/twitter-api-php) et [SafeTweet.php](https://github.com/WhiteFangs/SafeTweet) et mettez les dans le dossier parent du fichier `BotSardoche.php`

### Twitter

### Configuration
#### DB
1. Créez est un fichier dbinfo.php à la racine de votre projet 
2. Inseré ce code exemple modifer en fonction de vos données

```php
<?php
$dbconfig = array(
    "dbhost"     => "urhost", //genralement localhost
    "dbName"     => "botsardoche", //nom de votre base de données
    "dbUserName" => "botsardoche", //nom de l'utilisateur qui peut acceder a votre bose de données (eviter root)
    "dbPasswd"   => "To9hmffxR77BLQL6" //mots de passe de votre utilisateur (ne meter pas pwd) 
);
```

#### Twitter API
1. Créez une application Twitter avec le compte du bot
2. Créez un fichier `twitterCredentials.php` à la racine de votre projet
3. Inseré ce code exemple modifer en fonction des clés d'autehntification de l'[API Twitter](https://developer.twitter.com/en/docs/basics/getting-started) 
```php
<?php
$oauthToken = "---";
$oauthTokenSecret = "---";
$APIkey = "---";
$APIkeySecret = "---";
```

### Finalisation/excution
5. Lancez le fichier BotSardoche.php depuis votre serveur PHP et observer votre BOT
6. Afin d'automatiser votre bot vous pouver utiliser [cron-job.org](https://cron-job.org)


#