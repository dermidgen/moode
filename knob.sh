#!/bin/bash
#
# Update Moode volume knob and ALSA/MPD volume
#
# TC (Tim Curtis) 2015-08-30: initial version
# TC (Tim Curtis) 2015-09-05: add mixer_name
# TC (Tim Curtis) 2015-10-30: rewrite, add mute toggle, up/down by steps, current volume, volume limit check and param validation
#

if [ -z $1 ]; then
	TMP=$(grep "volume_knob_setting" /var/www/tcmods.conf)
	echo ${TMP##*:}
	exit 0
fi

if [ $1 = "-help" ]; then
	echo "knob with no arguments will print the current volume level"
	echo "knob <level between 0-100>, mute (toggle), up <step> or down <step>, -help"
	exit 1
fi

# get config settings
TMP=$(grep "volume_knob_setting" /var/www/tcmods.conf)
KNOB_SETTING=${TMP##*:}

TMP=$(grep "volume_warning_limit" /var/www/tcmods.conf)
VOL_LIMIT=${TMP##*:}

TMP=$(grep "volume_curve_logarithmic" /var/www/tcmods.conf)
LOG_CURVE=${TMP##*:}

TMP=$(grep "volume_mixer_name" /var/www/tcmods.conf)
MIXER_NAME=${TMP##*:}

TMP=$(grep "volume_mixer_type" /var/www/tcmods.conf)
MIXER_TYPE=${TMP##*:}

TMP=$(grep "volume_muted" /var/www/tcmods.conf)
MUTE_STATE=${TMP##*:}

REGEX='^[0-9]+$'

# mute toggle
if [ $1 = "mute" ]; then
	if [ $MUTE_STATE = "1" ]; then
		sed -i '/volume_muted:/c\volume_muted: 0' /var/www/tcmods.conf
		MUTE_STATE=0
		LEVEL=$KNOB_SETTING 
	else
		sed -i '/volume_muted:/c\volume_muted: 1' /var/www/tcmods.conf
		MUTE_STATE=1
	fi
else
	# volume by step or level
	if [ $1 = "up" ]; then
		LEVEL=$(($KNOB_SETTING+$2))
	else
		if [ $1 = "down" ]; then
			LEVEL=$(($KNOB_SETTING-$2))
		else
			LEVEL=$1
		fi
	fi

	# numeric check
	if ! [[ $LEVEL =~ $REGEX ]]; then
		echo "Level must be between 0-100"
		exit 1
	fi
	
	# volume limit check
	if [ $LEVEL -gt $VOL_LIMIT ]; then
		echo "Volume exceeds warning limit$VOL_LIMIT"
		exit 1
	else
		# set knob level
		sed -i '/volume_knob_setting:/c\volume_knob_setting: '$LEVEL /var/www/tcmods.conf
	fi
fi

if [ $MUTE_STATE = "1" ]; then
	mpc volume 0 >/dev/null
	exit 1
fi

# set volume level
if [ $MIXER_TYPE = "hardware" ]; then
	# update ALSA volume --> MPD volume
	if [ $LOG_CURVE = "Yes" ]; then
		amixer set $MIXER_NAME -M $LEVEL% > /dev/null
		#echo $MIXER_NAME" logarithmic"
	else
		amixer set $MIXER_NAME $LEVEL% > /dev/null
		#echo $MIXER_NAME" linear"
	fi
else
	# update MPD volume
	mpc volume $LEVEL >/dev/null
fi
