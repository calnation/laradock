#!/usr/bin/env bash


FILENAME=$1;
if [ "$FILENAME" = "extensions.list" ]; then
DIRECTORY=$DIR/mediawiki/extensions
BRANCH=$MW_VERSION
REPO=https://gerrit.wikimedia.org/r/p/mediawiki/extensions
elif [ "$FILENAME" = "skins.list" ]; then
DIRECTORY=$DIR/mediawiki/skins
BRANCH=$MW_VERSION
REPO=https://gerrit.wikimedia.org/r/p/mediawiki/skins
elif [ "$FILENAME" = "github_extensions.list" ]; then
DIRECTORY=$DIR/mediawiki/extensions
BRANCH=master
REPO=https://github.com
fi

# Note: we can also use mw github mirror:
#    REPO=https://github.com/wikimedia/mediawiki-extensions-${PROJECT}
# But then we must clean the name of the destination dir
#
while IFS='\n' read -r PROJECT || [[ -n "$PROJECT" ]]; do
mkdir -p ${DIRECTORY}
cd ${DIRECTORY} && git clone --depth 1 -b ${BRANCH} --single-branch "${REPO}/${PROJECT}.git" || {
    status=$?
    cd ${DIRECTORY} && git clone --depth 1 -b master --single-branch "${REPO}/${PROJECT}.git"
}
done < ${FILENAME}
