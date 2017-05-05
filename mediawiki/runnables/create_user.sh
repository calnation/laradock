#!/usr/bin/env bash
if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

php maintenance/createAndPromote.php \
                                    --bureaucrat \
                                    --sysop \
                                    --custom-groups="editor-in-chief" \
                                    --force \
                                    $MW_ADMIN \
                                    admin
bash $MW_INSTALL_PATH/runnables/update.sh
