set dbuser=%1
set dbpass=%2
set dbname=%3
cd ..
call composer install
REM call composer update
cd comunidade
call composer install
REM call composer update
cd ../..
cd sql
REM IF "%dbpass%"=="" (
  call mysql -u %dbuser% %dbname% < cuidadores.sql
  call mysql -u %dbuser% %dbname% < cuidadores2.sql
REM ) ELSE (
REM 	call mysql -u %dbuser% -p %dbpass% %dbname% < cuidadores.sql
REM )
cd ../web/comunidade
call php flarum cache:clear
cd ../scripts
