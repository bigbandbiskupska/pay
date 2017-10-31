#!/bin/bash

cd /app && \
php /usr/bin/composer.phar --no-interaction install && \
php -S 0.0.0.0:80 -t www && \
echo "Serving on 0.0.0.0:80"
