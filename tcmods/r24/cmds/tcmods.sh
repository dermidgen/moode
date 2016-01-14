#!/bin/bash
#
#	This Program is free software; you can redistribute it and/or modify
#	it under the terms of the GNU General Public License as published by
#	the Free Software Foundation; either version 3, or (at your option)
#	any later version.
#
#	This Program is distributed in the hope that it will be useful,
#	but WITHOUT ANY WARRANTY; without even the implied warranty of
#	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
#	GNU General Public License for more details.
#
#	You should have received a copy of the GNU General Public License
#	along with this software.  If not, see
#	<http://www.gnu.org/licenses/>.
# 
#	TC (Tim Curtis) 2014-08-23
#		- initial version
#	TC (Tim Curtis) 2014-09-17
#		- update release number to r11
#		- added cp lines for new favicons
#		- added cp lines for saved playlist feature
#	TC (Tim Curtis) 2014-09-18
#		- update release number to r12
#	TC (Tim Curtis) 2014-11-30
#		- update release id to r13
#		- add links.js, index-root.php (/index.php), sources.php, net-config2.php to install-base
#		- rename index.php (db/index.php) to index_db.php
#	TC (Tim Curtis) 2014-12-23
#		- add source.html to install-base
#		- add bootstrap-select.min.js to install-base
#	TC (Tim Curtis) 2015-01-01
#		- update release id to r14
#		- add command/index.php to install-base
#	TC (Tim Curtis) 2015-01-27
#		- update release id to r15
#		- arg to copy player.db
#		- add unmute.sh to install-base
#		- add orion_optimize.sh to install-base
#		- add _player_engine.php to install-base
#		- add install-ocfull, install-ocnone
#	TC (Tim Curtis) 2015-02-25
#		- update release id to r16
#		- add minidlna.conf to install-base
#		- update oc and def clock setting installs
#		- add kernel-install
#	TC (Tim Curtis) 2015-03-21
#		- update release id to r17
#		- add images subdir
#		- change v1 to v2 favicons
#		- add usbmount.conf to install-base
#		- use version on default and radio cover jpg's
#	TC (Tim Curtis) 2015-04-29
#		- update release id to r18
#		- add set-timezone <timezone>
#		- add chg-name <nameid> <'old name'> <'new name'>
#		- add bootstrap.min.css to base
#		- add scripts-configuration.js to base
#		- add get/set-pcmvol
#		- add 6 new theme colors
#	TC (Tim Curtis) 2015-05-30
#		- update release id to r19
#		- new theme color code that uses alizarin files + sed 
#	TC (Tim Curtis) 2015-06-26
#		- update release id to r20
#		- add kernel names 3.18.11+, 3.18.14+
# 		- add $2 parm in get/set-pcmvol for mixer name (PCM or Digital) depending on kernel version
# 		- change from sget/sset to get/set in amixer cmds
#		- dropping support for kernels 3.10.36 and 3.12.26, not in use by any users
#		- remove overclock settings support, not really needed since SoX and Pi-2
#		- remove install-db, not used
# 		- add library debug log files to base install
# 	TC (Tim Curtis) 2015-07-31
#		- update release id to r21
#		- add smb.conf to base install
#		- change base install of ini and conf files to /etc from /_OS_SETTINGS/etc
# 	TC (Tim Curtis) 2015-08-30
#		- update release id to r22
#		- remove net-config2.php
#		- change liblog.conf to debug.conf
#		- add coverart.php (Andreas Goetz <cpuidle@gmx.de>)
#		- add apc.ini (Andreas Goetz <cpuidle@gmx.de>)
#		- add nginx.ini (Andreas Goetz <cpuidle@gmx.de>)
#		- add knob.sh
#		- rename tcmods-template.conf -> tcmods-conf.txt, remove from install-base
# 	TC (Tim Curtis) 2015-09-05
#		- update release id to r23
#		- fix bug, change shairport -a to shairport-sync -a
# 	TC (Tim Curtis) 2015-10-30
#		- update release id to r24
#		- add 2X icons which are used on iPad
#		- add alsa-base.conf
#		- in get/set-pcmvol remove -M switch and go with straight % (matches amixer but not alsamixer slider scale)
#
#	tcmods.sh
#	mod maintenance command
#
#	args:	$1 <$2> <$3>
#			install-base	Install base files
#			install-kernel	Install kernel boot, firmware and module files (existing files deleted prior to install)
#			set-timezone 	<timezone>	Set local timezone
#			chg-name 		<nameid> <'old name'> <'new name'> Change host name, browser title, airplay and upnp names
#			get-pcmvol		<mixername> Get alsamixer PCM volume level (%)
#			set-pcmvol		<mixername> <level> Set alsamixer PCM volume level (%)
#     		alizarin		Install theme color
#			amethyst		<hexlight> <hexdark>
#			bluejeans
#			carrot
#			emerald
#			fallenleaf
#			grass
#			herb
#			lavender
#			river
#			rose
#			turquoise
#
TCMODS_RELEASE="r24"

if [ -z "$1" ]; then
	echo "~tcmods: release "$TCMODS_RELEASE
	echo "~tcmods: Valid args are install-base, install-kernel <version>, set-timezone <timezone>, chg-name <nameid> <'old name'> <'new name'>, get-pcmvol, set-pcmvol <level>, alizarin <hexlight> <hexdark>, amethyst, bluejeans, carrot, emerald, fallenleaf, grass, herb, lavender, river, rose or turquoise"
	exit
fi

if [ $1 = "install-base" ]; then
	# html templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/mpd-config.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/net-config.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/settings.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/sources.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/source.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/reboot.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/poweroff.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/base/audioinfo.html /var/www/templates

	# javascript
	cp /var/www/tcmods/$TCMODS_RELEASE/base/jquery.countdown.js /var/www/js
	cp /var/www/tcmods/$TCMODS_RELEASE/base/notify.js /var/www/js
	cp /var/www/tcmods/$TCMODS_RELEASE/base/player_lib.js /var/www/js
	cp /var/www/tcmods/$TCMODS_RELEASE/base/scripts-playback.js /var/www/js
	cp /var/www/tcmods/$TCMODS_RELEASE/base/links.js /var/www/js
	cp /var/www/tcmods/$TCMODS_RELEASE/base/bootstrap-select.min.js /var/www/js
	cp /var/www/tcmods/$TCMODS_RELEASE/base/_messages.en.js /var/www/js/i18n
	cp /var/www/tcmods/$TCMODS_RELEASE/base/scripts-configuration.js /var/www/js

	# images
	cp /var/www/tcmods/$TCMODS_RELEASE/images/default-cover-v2.jpg /var/www/images/default-cover.jpg
	cp /var/www/tcmods/$TCMODS_RELEASE/images/radio-cover-v2.jpg /var/www/images/webradio-cover.jpg
	cp /var/www/tcmods/$TCMODS_RELEASE/images/player-logotype-v2-transparent-wt.png /var/www/images
	
	# favicons
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/manifest.json /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-android-chrome-36x36.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-android-chrome-48x48.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-android-chrome-72x72.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-android-chrome-96x96.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-android-chrome-144x144.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-android-chrome-192x192.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-57x57.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-60x60.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-72x72.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-76x76.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-114x114.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-120x120.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-144x144.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-152x152.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-apple-touch-icon-180x180.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-favicon-16x16.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-favicon-32x32.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-favicon-96x96.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-mstile-144x144.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-mstile-150x150.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-mstile-310x150.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/v2-mstile-310x310.png /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/favicons/browserconfig.xml /var/www
	
	# php code
	cp /var/www/tcmods/$TCMODS_RELEASE/base/_header.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/_footer.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/mpd-config.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/net-config.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/settings.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/index_root.php /var/www/index.php
	cp /var/www/tcmods/$TCMODS_RELEASE/base/sources.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/_player_engine.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/player_wrk.php /var/www/command
	cp /var/www/tcmods/$TCMODS_RELEASE/base/player_lib.php /var/www/inc
	cp /var/www/tcmods/$TCMODS_RELEASE/base/index_db.php /var/www/db/index.php
	cp /var/www/tcmods/$TCMODS_RELEASE/base/index_cmd.php /var/www/command/index.php
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-cs.php /var/www/command
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods.php /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/coverart.php /var/www

	# /etc files
	cp /var/www/tcmods/$TCMODS_RELEASE/base/upmpdcli.conf /etc
	cp /var/www/tcmods/$TCMODS_RELEASE/base/minidlna.conf /etc
	cp /var/www/tcmods/$TCMODS_RELEASE/base/usbmount.conf /etc/usbmount
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-motd-def.txt /etc/motd
	cp /var/www/tcmods/$TCMODS_RELEASE/base/php_cli.ini /etc/php5/cli/php.ini
	cp /var/www/tcmods/$TCMODS_RELEASE/base/php_fpm.ini /etc/php5/fpm/php.ini
	cp /var/www/tcmods/$TCMODS_RELEASE/base/apc.ini /etc/php5/mods-available
	cp /var/www/tcmods/$TCMODS_RELEASE/base/nginx.conf /etc/nginx
	cp /var/www/tcmods/$TCMODS_RELEASE/base/smb.conf /etc/samba
	cp /var/www/tcmods/$TCMODS_RELEASE/base/alsa-base.conf /etc/modprobe.d

	# shell script files
	cp /var/www/tcmods/$TCMODS_RELEASE/base/unmute.sh /var/www/command
	cp /var/www/tcmods/$TCMODS_RELEASE/base/orion_optimize.sh /var/www/command
	cp /var/www/tcmods/$TCMODS_RELEASE/base/knob.sh /var/www

	# css files
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods.css /var/www/css
	cp /var/www/tcmods/$TCMODS_RELEASE/base/bootstrap.min.css /var/www/css

	# library debug log files
	cp /var/www/tcmods/$TCMODS_RELEASE/base/debug.conf /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/liblog.txt /var/www

	# other files
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-relnotes.txt /var/www
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-readme.txt /var/www

	echo "~tcmods: base files installed"
	exit
fi

if [ $1 = "install-kernel" ]; then
	# Check kernel version
	if [ -z "$2" ]; then
		# dropping support for kernels 3.10.36 and 3.12.26, not in use by any users
		echo "~tcmods: Kernel version required: 3.18.5+, 3.18.11+ or 3.18.14+"
		exit
	fi
	if [ $2 != "3.18.5+" -a $2 != "3.18.11+" -a $2 != "3.18.14+" ]; then
		echo "~tcmods: Valid kernel versions are: 3.18.5+, 3.18.11+ and 3.18.14+"
		exit
	fi

	# Install kernel
	echo "~tcmods: installing kernel files"
	cd /
	rm -rf /lib/modules /lib/firmware
	tar xfz /var/www/tcmods/kernels/$2/libmodules.tar.gz
	tar xfz /var/www/tcmods/kernels/$2/libfirmware.tar.gz
	tar xfz /var/www/tcmods/kernels/$2/bootfiles.tar.gz
	
	# Flush cached disk writes
	echo "~tcmods: flushing cached disk writes"
	sync

	echo "~tcmods: kernel version "$2" installed, shutdown initiated"
	halt
	exit
fi

if [ $1 = "set-timezone" ]; then
	ln -sf /usr/share/zoneinfo/$2 /etc/localtime
	echo "~tcmods: Set timezone completed"
	exit
fi

if [ $1 = "chg-name" ]; then
	if [ -z "$2" ]; then
		echo "~tcmods: Name identifier required: host, airplay, browsertitle, upnp or dlna"
		exit
	fi
	if [ $2 != "host" -a $2 != "airplay" -a $2 != "browsertitle" -a $2 != "upnp" -a $2 != "dlna" ]; then
		echo "~tcmods: Valid name identifiers are: host, airplay, browsertitle, upnp or dlna"
		exit
	fi
	if [ -z "$3" ]; then
		echo "~tcmods: Old name and New name are required as the 3rd and 4th argument"
		exit
	fi
	if [ -z "$4" ]; then
		echo "~tcmods: Old name and New name are required as the 3rd and 4th argument"
		exit
	fi
	
	# host name
	if [ $2 = "host" ]; then
		sed -i "s/$3/$4/" /etc/hostname
		sed -i "s/$3/$4/" /etc/hosts
	fi
	# browser title
	if [ $2 = "browsertitle" ]; then
		sed -i "s/<title>$3/<title>$4/" /var/www/_header.php
	fi
	# airplay friendly name
	if [ $2 = "airplay" ]; then
		sed -i "s/shairport-sync -a \"$3/shairport-sync -a \"$4/" /var/www/command/player_wrk.php
	fi
	# upnp friendly name
	if [ $2 = "upnp" ]; then
		sed -i "s/friendlyname = $3/friendlyname = $4/" /etc/upmpdcli.conf
	fi
	# dlna friendly name
	if [ $2 = "dlna" ]; then
		sed -i "s/friendly_name=$3/friendly_name=$4/" /etc/minidlna.conf
	fi

	echo "~tcmods: $3 -> $4 name change completed for name id: $2"
	exit
fi

# get/set PCM (alsamixer) volume
# TC (Tim Curtis) 2015-06-26: add $2 parm for mixer name (PCM or Digital) depending on kernel version
# TC (Tim Curtis) 2015-06-26: change from sget/sset to get/set
# TC (Tim Curtis) 2015-06-26: TESTING -M switch to match ALSA-Direct volume control
# TC (Tim Curtis) 2015-10-30: remove -M switch and go with straight % (matches amixer but not alsamixer slider scale)
if [ $1 = "get-pcmvol" ]; then
	awk -F"[][]" '/%/ {print $2; count++; if (count==1) exit}' <(amixer get $2)
	exit
fi
if [ $1 = "set-pcmvol" ]; then
	amixer set $2 "$3%" >null
	exit
fi

# theme color
if [ $1 = "alizarin" -o $1 = "amethyst" -o $1 = "bluejeans" -o $1 = "carrot" -o $1 = "emerald" -o $1 = "fallenleaf" -o $1 = "grass" -o $1 = "herb" -o $1 = "lavender" -o $1 = "river" -o $1 = "rose" -o $1 = "turquoise" ]; then
	# $1 = new theme color name
	# $2 = hex color value (light)
	# $3 = hex color value (dark)
	
	# copy alizarin files
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/alizarin/bootstrap-select.css /var/www/css
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/alizarin/flat-ui.css /var/www/css
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/alizarin/panels.css /var/www/css
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/alizarin/indextpl.html /var/www/templates
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/alizarin/jquery.knob.js /var/www/js

	# change to new theme color
	if [ $1 != "alizarin" ]; then
		# alizarin light color -> new color
		sed -i "s/e74c3c/$2/g" /var/www/css/bootstrap-select.css
		sed -i "s/e74c3c/$2/g" /var/www/css/flat-ui.css
		# alizarin dark color -> new color
		sed -i "s/c0392b/$3/g" /var/www/css/bootstrap-select.css
		sed -i "s/c0392b/$3/g" /var/www/css/flat-ui.css
		sed -i "s/c0392b/$3/g" /var/www/css/panels.css
		sed -i "s/c0392b/$3/g" /var/www/templates/indextpl.html
		sed -i "s/c0392b/$3/g" /var/www/js/jquery.knob.js
	fi

	# TC (Tim Curtis) 2015-10-30: add 2X icons which are used on iPad
	# copy radio slider control image for the config pages
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/$1-icon-on.png /var/www/images/toggle/icon-on.png
	cp /var/www/tcmods/$TCMODS_RELEASE/themes/$1-icon-on-2x.png /var/www/images/toggle/icon-on-2x.png
	echo "~tcmods: $1 theme installed"
	exit
fi

echo "~tcmods: Valid args are install-base, install-kernel <version>, set-timezone <timezone>, chg-name <nameid> <'old name'> <'new name'>, get-pcmvol, set-pcmvol <level>, alizarin <hexlight> <hexdark>, amethyst, bluejeans, carrot, emerald, fallenleaf, grass, herb, lavender, river, rose or turquoise"
exit
