set dbuser=%1
set dbpass=%2
set dbname=%3
cd ..
call composer install
call composer update
cd comunidade
call composer install
call composer update
cd ../..
cd sql
IF "%dbpass%"=="" (
	call mysql -u %dbuser% %dbname% < cuidadores.sql
) ELSE (
	call mysql -u %dbuser% -p %dbpass% %dbname% < cuidadores.sql
)
cd ../web/comunidade
call php flarum cache:clear
cd ../scripts
