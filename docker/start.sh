#!/bin/bash

cd /app && \
#php composer.phar --no-interaction install && \
php -S 0.0.0.0:80 -t . && \
echo "Serving on 0.0.0.0:80"
