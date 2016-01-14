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
#		- change webradio update to upd3
#	TC (Tim Curtis) 2014-09-18
#		- update release number to r12
#	TC (Tim Curtis) 2014-09-28
#		- change set-symlink to use a different link
#		- change webradio update to upd4
#		- fix bug in webradio update copy source (use local instead of remote)
#		- params for ipaddr, remotedir, username, password
#	TC (Tim Curtis) 2014-10-31
#		- add logo copy to update-webradio
#	TC (Tim Curtis) 2014-11-30
#		- update release id to r13
#		- sed for /etc/samba/smb.conf 
#		- edit-sambaname
#		- clear-logs
#	TC (Tim Curtis) 2014-12-23
#		- comment out sed for player_lib.js since converting to relative paths for cover and logo dirs
#	TC (Tim Curtis) 2015-01-01
#		- update release id to r14
#		- webradio and logos upd6
#	TC (Tim Curtis) 2015-01-27
#		- update release id to r15
#		- webradio and logos upd7
#		- sed for _header.php browser name chg fr TCMODS to TCMODS Player
#		- add /var/log/samba/log.nmbd, log.smbd to clear-logs
#	TC (Tim Curtis) 2015-02-25
#		- update release id to r16
#		- webradio and logos upd8
#		- add edit-dlnaname
#		- add tcmods -> rp3 name changer
#		- add clear-history
#	TC (Tim Curtis) 2015-03-21
#		- update release id to r17
#		- webradio and logos upd9
#		- change tcmods-rp1 etc to moode-rp1
#	TC (Tim Curtis) 2015-04-29
#		- update release id to r18
#		- webradio and logos upd10
#		- add get/set PCM volume
#	TC (Tim Curtis) 2015-05-30
#		- update release id to r19
#		- update radio to upd11
#		- add clear-playhistory
#		- replace single quotes with double quotes in moode-rp1, rp2, rp3 sed's
# 	TC (Tim Curtis) 2015-06-26
#		- update release id to r20
#		- update radio to upd12
# 	TC (Tim Curtis) 2015-07-31
#		- update release id to r21
#		- update radio to upd13
#		- add moode -> rp4 name change
# 	TC (Tim Curtis) 2015-08-30
#		- update release id to r22
#		- update radio to upd14
# 	TC (Tim Curtis) 2015-09-05
#		- update release id to r23
#		- update radio to upd15
# 	TC (Tim Curtis) 2015-10-30
#		- update release id to r24
#
#	utility.sh
#	dev maintenance command 
#
#	args:	$1 <$2>
#			update-release		Update the current release (includes mount)
#			update-webradio		Update webradio stations from local source (requires update-release first)
#			mount-tcmods		Mount the remote tcmods dev directory
#			umount-tcmods		Unmount 
#			moode-rp1			Change moode to rp1 in certain files
#			moode-rp2			Change moode to rp2 in certain files
#			moode-rp3			Change moode to rp3 in certain files
#			audio-output		Display audio output format
#			wifi-stats			Display wifi statistics for wlan0 interface
#			cpu-clock			Display processor clock rate and temp
#			cpu-util			Display processor utilization
#			edit-hostname 		Nano /etc/hostsname
#			edit-hosts			Nano /etc/hosts
#			edit-motd			Nano /etc/motd
#			edit-airplayname	Nano /var/www/command/player_wrk.php
#			edit-upnpname		Nano /etc/upmpdcli.conf
#			edit-eth0			Nano /etc/network/interfaces
#			edit-tcmodsconf		Nano /var/www/tcmods.conf
#			edit-sambaname		Nano /etc/samba/smb.conf
#			edit-dlnaname		Nano /etc/minidlna.conf
#			set-timezone		Set timezone to Detroit
#			set-symlink			Set coverart symlink
#			remove-symlink 		Remove covers symlink
#			clear-logs			Truncate log files	
#			clear-history		truncate nano and bash history files, clean apt-cache
#			clear-playhistory	truncate playback history file and write timestamp + "Log cleared" line 
#			get-pcmvol			get alsamixer pcm volume
#			set-pcmvol			set alsamixer pcm volume <level (%)>
#
TCMODS_RELEASE="r24"
WEBRADIO_UPDATE="upd16"
WEBRADIO_UPDATE_LOGOS="upd16-logos"
IP_ADDR="192.168.1.21"
REMOTE_DIR="Repository/Software/_BUILDS/RPI/tcmods"
USER_NAME=""
PASS_WORD=''

if [ -z "$1" ]; then
	echo "~utility: tcmods release "$TCMODS_RELEASE
	echo "~utility: webradio "$WEBRADIO_UPDATE
	echo "~utility: Valid args are update-release, update-webradio, mount-tcmods, umount-tcmods, moode-rp1,rp2,rp3,rp4 audio-output, wifi-stats, cpu-clock, cpu-util, edit-hostname, edit-hosts, edit-motd, edit-airplayname, edit-upnpname, edit-eth0, edit-tcmodsconf, edit-sambaname, edit-dlnaname, set-timezone, set-symlink, remove-symlink, clear-logs, clear-history, clear-playhistory, get-pcmvol, set-pcmvol <level (%)>"
	exit
fi

if [ $1 = "update-release" ]; then
	mkdir -p /mnt/NAS/tcmods
	mount -t cifs //$IP_ADDR/$REMOTE_DIR -o username=$USER_NAME,password=$PASS_WORD /mnt/NAS/tcmods
	rm -r /var/www/tcmods/$TCMODS_RELEASE
	cp -r /mnt/NAS/tcmods/$TCMODS_RELEASE /var/www/tcmods/
	echo "~utility: tcmods release "$TCMODS_RELEASE" update completed"
	exit
fi

if [ $1 = "update-webradio" ]; then
	if [ ! -d "/var/www/images/webradio-logos" ]; then
	  mkdir /var/www/images/webradio-logos
	fi
	rm -r /var/lib/mpd/music/WEBRADIO/*
	rm -r /var/www/images/webradio-logos/*
	cp -r /var/www/tcmods/$TCMODS_RELEASE/webradio/$WEBRADIO_UPDATE/* /var/lib/mpd/music/WEBRADIO
	cp -r /var/www/tcmods/$TCMODS_RELEASE/webradio/$WEBRADIO_UPDATE_LOGOS/* /var/www/images/webradio-logos
	echo "~utility: webradio update "$WEBRADIO_UPDATE" completed"
	exit
fi

if [ $1 = "mount-tcmods" ]; then
	mkdir -p /mnt/NAS/tcmods
	mount -t cifs //$IP_ADDR/$REMOTE_DIR -o username=$USER_NAME,password=$PASS_WORD /mnt/NAS/tcmods
	echo "~utility: Mount tcmods completed"
	exit
fi

if [ $1 = "umount-tcmods" ]; then
	umount /mnt/NAS/tcmods
	rmdir /mnt/NAS/tcmods
	echo "~utility: Unmount tcmods completed"
	exit
fi

# change sed to double quotes !

if [ $1 = "moode-rp1" ]; then
	sed -i "s/moode/rp1/" /etc/hostname										# host name
	sed -i "s/moode/rp1/" /etc/hosts										# host name
	sed -i "s/MoOde Player/RP1 Player/" /var/www/_header.php				# browser title
	sed -i "s/Moode/RP1/" /var/www/command/player_wrk.php					# airplay friendly name
	sed -i "s/Moode/RP1/" /etc/upmpdcli.conf								# upnp friendly name
	sed -i "s/Moode/RP1/" /etc/minidlna.conf								# dlna friendly name
	sed -i "s/Moode/RP1/" /etc/samba/smb.conf								# smb server name
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-motd-rp1.txt /etc/motd	# boot/login screen
	echo "~utility: moode -> rp1 name change completed"
	exit
fi

if [ $1 = "moode-rp2" ]; then
	sed -i "s/moode/rp2/" /etc/hostname										# host name
	sed -i "s/moode/rp2/" /etc/hosts										# host name
	sed -i "s/MoOde Player/RP2 Player/" /var/www/_header.php				# browser title
	sed -i "s/Moode/RP2/" /var/www/command/player_wrk.php					# airplay friendly name
	sed -i "s/Moode/RP2/" /etc/upmpdcli.conf								# upnp friendly name
	sed -i "s/Moode/RP2/" /etc/minidlna.conf								# dlna friendly name
	sed -i "s/Moode/RP2/" /etc/samba/smb.conf								# smb server name
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-motd-rp2.txt /etc/motd	# boot/login screen
	echo "~utility: moode -> rp2 name change completed"
	exit
fi

if [ $1 = "moode-rp3" ]; then
	sed -i "s/moode/rp3/" /etc/hostname										# host name
	sed -i "s/moode/rp3/" /etc/hosts										# host name
	sed -i "s/MoOde Player/RP3 Player/" /var/www/_header.php				# browser title
	sed -i "s/Moode/RP3/" /var/www/command/player_wrk.php					# airplay friendly name
	sed -i "s/Moode/RP3/" /etc/upmpdcli.conf								# upnp friendly name
	sed -i "s/Moode/RP3/" /etc/minidlna.conf								# dlna friendly name
	sed -i "s/Moode/RP3/" /etc/samba/smb.conf								# smb server name
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-motd-rp3.txt /etc/motd	# boot/login screen
	echo "~utility: moode -> rp3 name change completed"
	exit
fi

if [ $1 = "moode-rp4" ]; then
	sed -i "s/moode/rp4/" /etc/hostname										# host name
	sed -i "s/moode/rp4/" /etc/hosts										# host name
	sed -i "s/MoOde Player/RP4 Player/" /var/www/_header.php				# browser title
	sed -i "s/Moode/RP4/" /var/www/command/player_wrk.php					# airplay friendly name
	sed -i "s/Moode/RP4/" /etc/upmpdcli.conf								# upnp friendly name
	sed -i "s/Moode/RP4/" /etc/minidlna.conf								# dlna friendly name
	sed -i "s/Moode/RP4/" /etc/samba/smb.conf								# smb server name
	cp /var/www/tcmods/$TCMODS_RELEASE/base/tcmods-motd-rp4.txt /etc/motd	# boot/login screen
	echo "~utility: moode -> rp4 name change completed"
	exit
fi

if [ $1 = "audio-output" ]; then
	cat /proc/asound/card0/pcm0p/sub0/hw_params
	echo "~utility: Display audio output format completed"
	exit
fi

if [ $1 = "wifi-stats" ]; then
	watch -n 1 cat /proc/net/wireless
	echo "~utility: Display wifi statistics completed"
	exit
fi

if [ $1 = "cpu-clock" ]; then
	cat /sys/devices/system/cpu/cpu0/cpufreq/scaling_cur_freq 
	cat /sys/class/thermal/thermal_zone0/temp
	echo "~utility: Display cpu clock rate & temp completed"
	exit
fi

if [ $1 = "cpu-util" ]; then
	top
	echo "~utility: Display cpu utilization completed"
	exit
fi

if [ $1 = "edit-hostname" ]; then
	nano /etc/hostname
	echo "~utility: Edit hostname file completed"
	exit
fi

if [ $1 = "edit-hosts" ]; then
	nano /etc/hosts
	echo "~utility: Edit hosts file completed"
	exit
fi

if [ $1 = "edit-motd" ]; then
	nano /etc/motd
	echo "~utility: Edit motd file completed"
	exit
fi

if [ $1 = "edit-airplayname" ]; then
	nano /var/www/command/player_wrk.php
	echo "~utility: Edit Airplay name completed"
	exit
fi

if [ $1 = "edit-upnpname" ]; then
	nano /etc/upmpdcli.conf
	echo "~utility: Edit UPnP name completed"
	exit
fi

if [ $1 = "edit-eth0" ]; then
	nano /etc/network/interfaces
	echo "~utility: Edit eth0 interface completed"
	exit
fi

if [ $1 = "edit-tcmodsconf" ]; then
	nano /var/www/tcmods.conf
	echo "~utility: Edit tcmods.conf file completed"
	exit
fi

if [ $1 = "edit-sambaname" ]; then
	nano /etc/samba/smb.conf
	echo "~utility: Edit smb.conf file completed"
	exit
fi

if [ $1 = "edit-dlnaname" ]; then
	nano /etc/minidlna.conf
	echo "~utility: Edit DLNA name completed"
	exit
fi

if [ $1 = "set-timezone" ]; then
	ln -sf /usr/share/zoneinfo/America/Detroit /etc/localtime
	echo "~utility: Set timezone Detroit completed"
	exit
fi

if [ $1 = "set-symlink" ]; then
	ln -s /var/lib/mpd/music /var/www/coverroot
	echo "~utility: Set coverart symlink completed"
	exit
fi

if [ $1 = "remove-symlink" ]; then
	rm /var/www/coverroot
	echo "~utility: Remove coverart symlink completed"
	exit
fi

if [ $1 = "clear-logs" ]; then
	> /var/log/apt/history.log
	> /var/log/apt/term.log
	> /var/log/nginx/access.log
	> /var/log/nginx/error.log
	> /var/log/nginx/db.log
	> /var/log/nginx/command.log
	> /var/log/php5-fpm.log
	> /var/log/php_errors.log
	> /var/log/fontconfig.log
	> /var/log/minidlna.log
	> /var/log/mpd/mpd.log
	> /var/log/alternatives.log
	> /var/log/auth.log
	> /var/log/monit.log
	> /var/log/dpkg.log
	> /var/log/wicd/wicd.log
	> /var/log/pycentral.log
	> /var/log/lpr.log
	> /var/log/daemon.log
	> /var/log/user.log
	> /var/log/mail.log
	> /var/log/kern.log
	> /var/log/lastlog
	> /var/log/wtmp
	> /var/log/samba/log.nmbd
	> /var/log/samba/log.smbd
	echo "~utility: Clear logs completed"
	exit
fi

if [ $1 = "clear-history" ]; then
	> ~/.nano_history
	> ~/.bash_history
	apt-get clean
	echo "~utility: Clear history completed"
	exit
fi

if [ $1 = "clear-playhistory" ]; then
	#TIMESTAMP="<li>"$(date +'%Y-%m-%d %H:%M')
	#LOGMSG=" History log initialized</li>"
	TIMESTAMP=$(date +'%Y-%m-%d %H:%M')
	LOGMSG=" History log initialized"
	echo $TIMESTAMP$LOGMSG > /var/www/playhistory.log
	echo "~utility: Clear playback history completed"
	exit
fi

if [ $1 = "get-pcmvol" ]; then
	awk -F"[][]" '/%/ {print $2; count++; if (count==1) exit}' <(amixer sget PCM)
	echo "~utility: Get PCM volume completed"
	exit
fi

if [ $1 = "set-pcmvol" ]; then
	if [ -z "$2" ]; then
		echo "~utility: Volume level between 0 and 100 (%) required"
		exit
	fi
	amixer sset PCM "$2%"
	echo "~utility: Set PCM volume completed"
	exit
fi

echo "~utility: Valid args are update-release, update-webradio, mount-tcmods, umount-tcmods, moode-rp1,rp2,rp3,rp4, audio-output, wifi-stats, cpu-clock, cpu-util, edit-hostname, edit-hosts, edit-motd, edit-airplayname, edit-upnpname, edit-eth0, edit-tcmodsconf, edit-sambaname, edit-dlnaname, set-timezone, set-symlink, remove-symlink, clear-logs, clear-history, clear-playhistory, get-pcmvol, set-pcmvol <level (%)>"
exit
