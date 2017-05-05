#!/usr/bin/env bash
if [ "x$BASH_SOURCE" == "x" ]; then echo '$BASH_SOURCE not set'; exit 1; fi

WWW_USER="www-data"
WWW_GROUP="www-data"

# == chmod
# ====================================================

chmod 733 -R /var/lib/php
/usr/bin/find $MW_INSTALL_PATH -type d -exec /bin/chmod 755 {} \;
/usr/bin/find $MW_INSTALL_PATH -type f -exec /bin/chmod 644 {} \;

# any *.sh
find ./ -name "*.sh" -exec chmod +x {} \;

chmod 755 -R $MW_INSTALL_PATH/extensions/Scribunto/engines/LuaStandalone/binaries/


# == chown
# ====================================================

/bin/chown -R root:root $MW_INSTALL_PATH

pathes=(
	"$MW_INSTALL_PATH/_sf_instances" \
	"$MW_INSTALL_PATH/cache" \
	"$MW_INSTALL_PATH/images" \
	"$MW_INSTALL_PATH/settings.d" \
	"$MW_INSTALL_PATH/ext_settings.d" \
#	"$MW_INSTALL_PATH/extensions/BlueSpiceFoundation/data" \
#	"$MW_INSTALL_PATH/extensions/BlueSpiceFoundation/config" \
	"$MW_INSTALL_PATH/extensions/Widgets/compiled_templates" \
)

for i in "${pathes[@]}"; do
	if [ -d $i ]; then
		/bin/chown -R $WWW_USER:$WWW_GROUP $i
	fi
done
