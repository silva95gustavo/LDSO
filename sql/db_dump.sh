#!/bin/bash

if [ "$#" == "0" ]; then
    echo "Usage: $0 database"
fi

mysqldump --no-data --add-drop-table $1 > cuidadores.sql
mysqldump --no-create-info --skip-triggers --ignore-table=$1.cache_bootstrap --ignore-table=$1.cache_config --ignore-table=$1.cache_container --ignore-table=$1.cache_data --ignore-table=$1.cache_default --ignore-table=$1.cache_discovery --ignore-table=$1.cache_dynamic_page_cache --ignore-table=$1.cache_entity --ignore-table=$1.cache_menu --ignore-table=$1.cache_render --ignore-table=$1.cache_toolbar --ignore-table=$1.session --ignore-table=$1.watchdog --ignore-table=$1.cuidadores_users $1 >> cuidadores.sql