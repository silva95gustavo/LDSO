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
REM IF "%dbpass%"=="" (
	call mysql -u %dbuser% %dbname% < cuidadores.sql
REM ) ELSE (
REM 	call mysql -u %dbuser% -p %dbpass% %dbname% < cuidadores.sql
REM )
cd ../web/scripts