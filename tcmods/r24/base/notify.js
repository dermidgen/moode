/*
 *  This Program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3, or (at your option)
 *  any later version.
 *
 *  This Program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with TsunAMP; see the file COPYING.  If not, see
 *  <http://www.gnu.org/licenses/>.
 *
 *	PlayerUI Copyright (C) 2013 Andrea Coiutti & Simone De Gregori
 *	Tsunamp Team
 *	http://www.tsunamp.com
 *
 *	UI-design/JS code by: 	Andrea Coiutti (aka ACX)
 *	PHP/JS code by:			Simone De Gregori (aka Orion)
 * 
 *	file:					notify.js
 * 	version:				1.0
 *
 *	TCMODS Edition 
 *
 *	TC (Tim Curtis) 2014-08-23, r1.0
 * 	- added delay = 1000 (1 sec) to override default of 8 secs
 *
 *	TC (Tim Curtis) 2014-09-17, r1.1
 *	- delete saved playlist (Browse panel)
 *	- play all songs in list (Library panel)
 *	- add all songs in list (Library panel)
 *	- clear playlist, add all songs in list (Library panel)
 *
 *	TC (Tim Curtis) 2014-12-23, r1.3
 *	- notify delete radio station (Browse panel)
 *	- add and edit radio station (Browse panel)
 *	- increase timeout from 1000 to 2000 ms
 *	- case for delete, move playlist items
 *	- case for update clock radio
 *	- clean up titles
 *	- replace icon-remove w icon-ok
 *
 *	TC (Tim Curtis) 2015-01-27, r1.5
 *	- case for update tcmods config
 *
 *	TC (Tim Curtis) 2015-03-21, r1.7
 *	- add history:false to prevent history tab from appearing when on Config pages
 *	- Change "TCMODS config updated" to "Custom config updated"
 *
 *	TC (Tim Curtis) 2015-04-29, r1.8
 *	- add theme change notification, moved from settings.php
 *
 *	TC (Tim Curtis) 2015-05-30, r1.9
 *	- change text in 'themechange' to reflect new option for refreshing web page
 *
 *	TC (Tim Curtis) 2015-08-30, r2.2
 *	- replace original function with new version from Andreas Goetz <cpuidle@gmx.de> 
 *
 */
// AG (Andreas Goetz) 2015-08-30: new version
function notify(cmd, msg) {
    msg = msg || ''; // msg optional

    var map = {
        add: 'Added to playlist',
        addreplaceplay: 'Added, Playlist replaced',
        addall: 'Added to playlist',
        addallreplaceplay: 'Added, Playlist replaced',
        update: 'Update path: ',
        remove: 'Removed from playlist',
        move: 'Playlist items moved',
        savepl: 'Playlist saved',
        needplname: 'Enter a name',
        deletesavedpl: 'Playlist deleted',
        deleteradiostn: 'Radio station deleted',
        addradiostn: 'Radio station added',
        updateradiostn: 'Radio station updated',
        updateclockradio: 'Clock radio updated',
        updatetcmodsconf: 'Custom config updated',
        themechange: 'Theme color changed, select Menu/Refresh to activate'
    };

    if (typeof map[cmd] === undefined) {
        console.error('[notify] Unknown cmd ' + cmd);
    }

    var icon = (cmd == 'needplname') ? 'icon-info-sign' : 'icon-ok';
    $.pnotify({
        title: map[cmd],
        text: msg,
        icon: icon,
        delay: 2000,
        opacity: 0.9,
        history: false
    });
}
