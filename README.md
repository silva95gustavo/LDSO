# Associação Cuidadores

## Getting started

### Prerequisites

- Apache web server.
- PHP 5.5.9 or higher.
- Minimum 512MB disk space in the web server. Keep in mind you need much more for the database, files uploaded by the users, media, backups and other files.
- MySQL 5.5.3 or higher with PDO and an InnoDB-compatible primary storage engine.
- SSH (command-line) access to the server folders.

### Installation

#### Website

1. Open a command line on folder `/web/scripts/`.
2. Copy the file `/web/sites/default/settings.local.example.php` to `/web/sites/default/settings.local.php` and update it with the configurations of your database, as well as the folder where the temporary files will be stored.
3. Copy the file `/web/comunidade/config.local.example.php` to `/web/comunidade/config.local.php` and update it with your database configurations, as well as the path to the online community page.
4. Open a command line in folder `/web/scripts/`.
5. Run the command `install.bat <dbuser> <dbpass> <dbname>`. If the database has no _password_ write `""` in the `<dbpass>` field.
6. In order for the admin to be automatically notified when a community user becomes an adult, a cronjob must be set up. This means adding the following line to the crontab file: `0 0 * * * php -q /var/www/staging/comunidade/young_adult/notify_admin.php`

#### Mobile app
1. Get the website up and runnning.
2. Install latest Node.js.
3. Run `npm install -g cordova ionic`.

### Running the tests

## Usage

## Built width
- Drupal 8.2.4
- Flarum 0.1.0
- Ionic

## Versioning
We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/gtugablue/LDSO/tags). 

## Credits
André Lago (@andrelago13)
Diogo Carvalho (@DiogoVazC)
Gustavo Silva (@gtugablue)
José Rebelo (@joserebelo)
Pedro Castro (@F0lha)
Ricardo Cerqueira (@ricardocerq)
