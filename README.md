<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->
**Table of Contents**  *generated with [DocToc](https://github.com/thlorenz/doctoc)*

- [Associação Cuidadores](#associa%C3%A7%C3%A3o-cuidadores)
  - [Getting started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
      - [Website](#website)
      - [Mobile app](#mobile-app)
    - [Running the tests](#running-the-tests)
  - [Usage](#usage)
  - [System architecture](#system-architecture)
    - [Built width](#built-width)
    - [Technological architecture](#technological-architecture)
  - [Versioning](#versioning)
  - [Credits](#credits)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

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

## System architecture

### Built width
- Drupal 8.2.4
- Flarum 0.1.0
- Ionic

### Technological architecture
The project has three main components, each based on a different technological framework. The institutional website is built on Drupal, the forum on Flarum and the mobile app on Ionic.
The choice of Drupal for the website was made due to the requirement that pages should be easily added without the need to alter the source code. Taking into consideration that the Product Owner wanted the final product to be similar to the website [carers.org](http://carers.org), the same content management system (CMS) was chosen.
Flarum was chosen to provide a robust, intuitive and appealing forum to the client, with an interesting interaction, making it enjoyable to communicate with others.
Ionic is used to keep a single codebase to deploy to both Android and iOS platforms so that it is possible to cover as many users as possible.
All frameworks used are open-source, since that property is also a requirement of the project.
The languages used are the following:
- **Server:** PHP;
- **Client:** HTML, CSS, Javascript;
- **Mobile app:** HTML, CSS, AngularJS.


## Versioning
We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/gtugablue/LDSO/tags). 

## Credits
- André Lago ([@andrelago13](https://github.com/andrelago13))
- Diogo Carvalho ([@DiogoVazC](https://github.com/DiogoVazC))
- Gustavo Silva ([@gtugablue](https://github.com/gtugablue))
- José Rebelo ([@joserebelo](https://github.com/joserebelo))
- Pedro Castro ([@F0lha](https://github.com/F0lha))
- Ricardo Cerqueira ([@ricardocerq](https://github.com/ricardocerq))
