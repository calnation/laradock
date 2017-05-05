FROM jorge07/alpine-php:7-dev

ENV DIR=/app

ARG MW_VERSION=REL1_28
ENV MW_VERSION ${MW_VERSION}

RUN sed -i -e 's/v3\../edge/g' /etc/apk/repositories
RUN apk add --update \
 && apk add --no-cache --virtual bash && rm -rf /var/cache/apk/*

RUN addgroup -g 1000 www-data && \
    adduser -u 1000 -G www-data -h $DIR -D www-data

RUN mkdir -p $DIR/mediawiki/extensions \
      && mkdir -p $DIR/mediawiki/skins

RUN find $DIR -type d -exec chmod 755 {} + \
 && chown -R www-data:www-data $DIR

# ==  Extensions & skins scripts
# ------------------------------------------------------
USER www-data:www-data
WORKDIR $DIR
COPY lists $DIR/
COPY runnables $DIR/

# only run if lists files exist
RUN if [ -f skins.list ]; then \
    sh clone_for_mw.sh skins.list && rm skins.list \
;fi
RUN if [ -f extensions.list ]; then \
    sh clone_for_mw.sh extensions.list && rm extensions.list \
;fi
RUN if [ -f github_extensions.list ]; then \
    sh clone_for_mw.sh github_extensions.list && rm github_extensions.list \
;fi


# == Scripts cleanup
# ------------------------------------------------------
RUN rm clone_for_mw.sh

# == Ensure directories ownership
# ------------------------------------------------------
RUN find $DIR/mediawiki -type d -exec chmod 755 {} + \
 && find $DIR/mediawiki -type f -exec chmod 644 {} + \
 && chown -R www-data:www-data $DIR/mediawiki

# == Git modules initialization
# ------------------------------------------------------
WORKDIR mediawiki
RUN for i in `find $DIR/mediawiki/extensions/ -maxdepth 1 -type d`;do cd "$i"; git submodule update --init ;done


# == Update composer deps
# ------------------------------------------------------
RUN for i in `find $DIR/mediawiki/extensions/ -maxdepth 1 -type d`;do cd "$i"; composer install --no-dev | echo $? ;done
RUN for i in `find $DIR/mediawiki/skins/ -maxdepth 1 -type d`;do cd "$i"; composer install --no-dev | echo $?;done


# ==  Add Settings
# ------------------------------------------------------
#COPY mw-config $DIR/mediawiki/mw-config/
#RUN chown -R www-data:www-data $DIR/mediawiki/mw-config

RUN rm -rf $DIR/mediawiki/extensions/AbuseFilter
RUN rm -rf $DIR/mediawiki/extensions/ConfirmAccount
RUN rm -rf $DIR/mediawiki/extensions/DidYouKnow
RUN rm -rf $DIR/mediawiki/extensions/Echo
RUN rm -rf $DIR/mediawiki/extensions/Flow
RUN rm -rf $DIR/mediawiki/extensions/HideEmptySections
RUN rm -rf $DIR/mediawiki/extensions/Numbertext
RUN rm -rf $DIR/mediawiki/extensions/SocialProfile
RUN rm -rf $DIR/mediawiki/extensions/VisualEditor
RUN rm -rf $DIR/mediawiki/extensions/Moderation

CMD [""]
ENTRYPOINT [""]
