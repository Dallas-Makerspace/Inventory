FROM hhvm/hhvm-proxygen:latest

ARG VERSION="1.0.0"
ARG VCS_URL="https://github.com/Dallas-Makerspace/Inventory.git"
ARG VCS_REF="git ref-parse --short HEAD"
ARG BUILD_DATE="2018-11-26T13:22:50Z"

ENV DEBIAN_FRONTEND noninteractive

EXPOSE 80

LABEL org.label-schema.docker.maintainer="infrastructure@dallasmakerspace.org" \
      org.label-schema.vendor="Dallas Makerspace" \
      org.label-schema.url="https://github.com/Dallas-Makerspace/Inventory" \
      org.label-schema.name="DMS Inventory" \
      org.label-schema.description="Inventory management system designed for the dallas makerspace" \
      org.label-schema.version="${VERSION}" \
      org.label-schema.vcs-url="${VCS_URL}" \
      org.label-schema.vcs-ref="${VCS_REF}" \
      org.label-schema.build-date="${BUILD_DATE}" \
      org.label-schema.docker.schema-version="1.0" \
      traefik.port=80 \
      traefik.enable=true

HEALTHCHECK --interval=5s CMD 'curl -sSlk http://localhost/'

RUN apt-get update && apt-get install -y --force-yes curl language-pack-en git npm nodejs-legacy nginx mysql-client && \
    mkdir /opt/composer && \
    curl -sS https://getcomposer.org/installer | hhvm --php -- --install-dir=/opt/composer

COPY build.xml build.properties composer.json LICENSE /var/www/
COPY src /var/www/public/

WORKDIR /var/www
RUN  /opt/composer/composer.phar install
