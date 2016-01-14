#!/bin/sh
#
# Taken from http://www.raspberryvi.org/wiki/doku.php/raspi-expand-rootfs
#
# Resize the root filesystem of a newly flashed Raspbian image.
# Directly equivalent to the expand_rootfs section of raspi-config.
# No claims of originality are made.
# Mike Ray.  Feb 2013.  No warranty is implied.  Use at your own risk.
#
# Run as root.  Expands the root file system.  After running this,
# reboot and give the resizefs-once script a few minutes to finish expanding the file system.
# Check the file system with 'df -h' once it has run and you should see a size
# close to the known size of your card.
#
# TC (Tim Curtis) 2015-07-31
#	- change to using partition 3 (mmcblk0p3)
#	- add arg for starting the script and to preven accidential execution
#	- add reboot after init.d resize script has been written
#

if [ -z "$1" ]; then
	echo "~resize: missing arg <start>"
	exit
fi

if [ $1 != "start" ]; then
	echo "~resize: valid arg is <start>"
	exit
fi

# Get the starting offset of the root partition
PART_START=$(parted /dev/mmcblk0 -ms unit s p | grep "^3" | cut -f 2 -d:)
[ "$PART_START" ] || return 1
# Return value will likely be error for fdisk as it fails to reload the
# partition table because the root fs is mounted
fdisk /dev/mmcblk0 <<EOF
p
d
3
n
p
3
$PART_START

p
w
EOF

# now set up an init.d script
cat <<\EOF > /etc/init.d/resize2fs_once &&
#!/bin/sh
### BEGIN INIT INFO
# Provides:          resize2fs_once
# Required-Start:
# Required-Stop:
# Default-Start: 2 3 4 5 S
# Default-Stop:
# Short-Description: Resize the root filesystem to fill partition
# Description:
### END INIT INFO

. /lib/lsb/init-functions

case "$1" in
  start)
    log_daemon_msg "Starting resize2fs_once" &&
    resize2fs /dev/mmcblk0p3 &&
    rm /etc/init.d/resize2fs_once &&
    update-rc.d resize2fs_once remove &&
    log_end_msg $?
    ;;
  *)
    echo "Usage: $0 start" >&2
    exit 3
    ;;
esac
EOF
chmod +x /etc/init.d/resize2fs_once &&
update-rc.d resize2fs_once defaults &&
echo "Root partition has been resized. The filesystem will be enlarged at the next reboot"

echo "Reboot initiated"
reboot
