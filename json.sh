 ls -d -1tr /var/www/html/kloudcrm/public/jsonFiles/*.json | tail -n +6 | xargs -d '\n' rm -f