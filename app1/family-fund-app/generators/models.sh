#!/bin/bash

tables=$(mysql -h 127.0.0.1 -u famfun -p1234 familyfund -N -e "show tables" 2> /dev/null | grep -v "+" | grep -v "failed_jobs\|migrations\|password_resets\|personal_access_tokens")
tables="matching_rules transaction_matchings"

for t in $tables; do
    echo $t
    c=$(echo $t | sed "s/ //g" | sed "s/s$//" | perl -pe 's/\S+/\u$&/g')
    echo $c
#    php artisan infyom:scaffold $c --fromTable --tableName $t --skip dump-autoload
#    php artisan infyom:api $c --fromTable --tableName $t --skip dump-autoload
#    php artisan infyom:scaffold $c --fromTable --tableName $t \
#            --skip=migration,api_controller,api_routes,controller,scaffold_controller,scaffold_requests,routes,scaffold_routes,views,menu,dump-autoload
#
#    sed -i.bkp -e 's/private \($.*Repository;\)/protected \1/' app/Http/Controllers/*Controller.php
done;
