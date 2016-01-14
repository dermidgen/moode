=================================================================
PLAYER SETUP

Moode Audio Player, (C) 2014 Tim Curtis
http://moodeaudio.org

Updated: 2015-10-30
=================================================================

NOTE: Use http://moode -or- http://moode.local

 1. INITIAL SETUP
    a) insert sd card
    b) connect ethernet cable
    c) connect USB storage device (if any)

 2. POWERING UP
    - IF USB AUDIO DEVICE
    a) power on Raspberry Pi without USB audio device connected
    b) http://moode
    c) plug audio device device into USB port
    d) reboot
    - IF I2S AUDIO DEVICE
    a) power on the Raspberry Pi with I2S audio device connected
    b) http://moode
    c) Menu, Configure, System
    d) select i2s audio device
    e) reboot
	- VERIFY/SET ALSA VOLUME
    a) http://moode
    b) Menu, Configure, System
	c) Press SET after entering appropriate value (no need to reboot)
    - VERIFY AUDIO PLAYBACK
    a) http://moode
    b) Click a radio station from the Playlist

 3. TIME ZONE AND AUDIO DEVICE DESCRIPTION 
    a) http:/moode
    b) Menu/System, Timezone
    c) Menu, Customize, Audio device description, Device

 4. ADD SOURCE CONTAINING MUSIC FILES
    - USB AND SDCARD STORAGE DEVICE
    a) http:/moode
    b) Menu, Configure, Sources
    c) press UPDATE MPD DATABASE button
    d) WAIT for completion (no spinner on the Browse tab)
    e) click Browse tab then Menu, Refresh
    - NAS DEVICE
    a) http://moode
    b) Menu, Configure, Sources
    c) click NEW button to configure a music source (MPD DB update initiates automatically after SAVE)
    d) WAIT for completion (no spinner on the Browse tab)
    e) click Browse tab then Menu, Refresh

 At this point a FULLY OPERATIONAL PLAYER exists.
 
=================================================================
CUSTOM CONFIGS

Customize the player by using any of the following procedures.
=================================================================

 1. CHANGE PLAYER HOST AND NETWORK SERVICE NAMES
    a) http:/moode
    b) Menu, Configure, System
	c) Press SET after entering appropriate value in each name field
	d) reboot

 2. CHANGE PASSWORD FOR USER ROOT
    a) ssh root@moode (pwd moode)
    b) passwd root (prompts will follow)
    c) reboot
 	
 3. CONFIGURE FOR WIFI CONNECTION
    a) power off (from Menu/Turn off)
    b) insert wifi dongle
    c) power up (leave eth cable connected!)
    d) http://moode
    e) Menu, Configure, Network
    f) configure a wifi connection
       - can take ~ 60 seconds to complete
       - ip address will not appear until after step (g)
    g) power off, unplug eth cable, power up

 4. DISABLE ETH0 INTERFACE FOR FASTER BOOT
    - WARNING: this is for an already operational WIFI setup!
    a) ssh root@moode (pwd = moode)
    b) nano /etc/network/interfaces
    c) # out the eth0 lines 
    d) Ctrl-x y <return> to save the file    
    e) reboot

=================================================================
END README
=================================================================
