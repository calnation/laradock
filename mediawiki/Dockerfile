FROM jorge07/alpine-php:7-dev

ENV DIR=/app

ARG MW_VERSION=REL1_28
ENV MW_VERSION ${MW_VERSION}

WORKDIR $DIR

RUN addgroup -g 1000 www-data && \
    adduser -u 1000 -G www-data -h $DIR -D www-data

RUN mkdir -p $DIR/mediawiki
#RUN mkdir -p $DIR/mediawiki

RUN find $DIR -type d -exec chmod 755 {} + \
 && chown -R www-data:www-data $DIR

USER www-data:www-data

# ==  Clone MediaWiki core
# ------------------------------------------------------
RUN git clone \
        --depth 1 \
        -b $MW_VERSION \
        --single-branch \
        https://github.com/wikimedia/mediawiki.git

# ==  Logo, favicon..
# ------------------------------------------------------
COPY assets $DIR/mediawiki/resources/assets/

# == Git modules initialization
# ------------------------------------------------------
WORKDIR mediawiki
RUN cd skins && git submodule update --init
RUN cd extensions && git submodule update --init

# == Update composer deps
# ------------------------------------------------------
RUN composer install --no-dev

# == Ensure directories ownership
# ------------------------------------------------------
USER root
RUN find $DIR/mediawiki -type d -exec chmod 755 {} + \
 && find $DIR/mediawiki -type f -exec chmod 644 {} + \
 && chown -R www-data:www-data $DIR/mediawiki

# ==  Add Settings & init script
# ------------------------------------------------------
RUN sed -i "s#wgDBserver.*localhost#wgDBserver \= \'mysql#g" $DIR/mediawiki/includes/DefaultSettings.php
COPY LocalSettings.php $DIR/mediawiki/LocalSettings.php.shadow
#COPY init.sh $DIR/mediawiki/init.sh

RUN chown www-data:www-data $DIR/mediawiki/LocalSettings.php.shadow
# && chown www-data:www-data $DIR/mediawiki/init.sh

CMD [""]
ENTRYPOINT [""]
