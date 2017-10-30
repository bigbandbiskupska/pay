FROM php:7-cli
MAINTAINER Kryštof Tulinger <k.tulinger@gmail.com>

ENV WWW_ROOT /app

RUN apt-get -y update && \
  apt-get -y install git zip nano && \
  apt-get -y clean

WORKDIR /usr/bin

RUN curl -sS https://getcomposer.org/installer | php

WORKDIR $WWW_ROOT

EXPOSE 80

ADD . /docker
RUN chmod -R +x /docker
CMD ["/docker/start.sh"]