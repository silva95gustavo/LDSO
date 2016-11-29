# Website

## Installation

1. Open a command line on folder `/web/scripts/`.
2. Run the command `install.bat <dbuser> <dbpass> <dbname>`. If the database has no _password_ write `""` in the `<dbpass>` field.
3. Copy the file `/web/sites/default/settings.local.example.php` to `/web/sites/default/settings.local.php` and update it with the configurations of your database, as well as the folder where the temporary files will be stored.
4. Copy the file `/web/comunidade/config.local.example.php` to `/web/comunidade/config.local.php` and update it with your database configurations, as well as the path to the online community page.
