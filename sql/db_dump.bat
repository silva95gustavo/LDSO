set dbname=%1
call mysqldump --no-data --add-drop-table %dbname% > cuidadores.sql
call mysqldump --no-create-info --skip-triggers --ignore-table=%dbname%.cache_bootstrap --ignore-table=%dbname%.cache_config --ignore-table=%dbname%.cache_container --ignore-table=%dbname%.cache_data --ignore-table=%dbname%.cache_default --ignore-table=%dbname%.cache_discovery --ignore-table=%dbname%.cache_dynamic_page_cache --ignore-table=%dbname%.cache_entity --ignore-table=%dbname%.cache_menu --ignore-table=%dbname%.cache_render --ignore-table=%dbname%.cache_toolbar --ignore-table=%dbname%.session --ignore-table=%dbname%.watchdog --ignore-table=$1.cuidadores_users %dbname% >> cuidadores.sql
pause
