<?php
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
 *	file:					net-config.php
 * 	version:				1.0
 *
 *	TCMODS Edition 
 *
 *  TC (Tim Curtis) 2014-08-23, r1.0
 *  - changed class from "alert alert-info" to "help-block" on a couple of items 
 *
 *  TC (Tim Curtis) 2014-12-23, r1.3
 *  - remove trailing ! in 1st content line causing code to be grayed out in editor 
 *	- shovel & broom
 *
 *  TC (Tim Curtis) 2015-10-30, r2.4
 *  - place holders for allow-hotplug eth0 and wlan0
 *	- add isset test to $_POST['wifisec']['password']
 *	- add $wifisec[0]['password'] to $tpl
 *
 */
 
// common include
include('inc/connection.php');
playerSession('open',$db,'','');
?>

<?php
// open player session
playerSession('open',$db,'','');

// handle POST (reset)
if (isset($_POST['reset']) && $_POST['reset'] == 1) {
	$eth0 = "iface eth0 inet dhcp\n";
	$value = array('ssid' => '', 'encryption' => '', 'password' => '');
	$dbh = cfgdb_connect($db);
	cfgdb_update('cfg_wifisec',$dbh,'',$value);
	$wifisec = cfgdb_read('cfg_wifisec',$dbh);
	$dbh = null;
	$_POST['eth0']['dhcp'] = 'true';
	$_POST['eth0']['ip'] = '';
	$_POST['eth0']['netmask'] = '';
	$_POST['eth0']['gw'] = '';
	$_POST['eth0']['dns1'] = '';
	$_POST['eth0']['dns2'] = '';
}

// handle POST
if (isset($_POST) && !empty($_POST)) {
	$dbh  = cfgdb_connect($db);
    // eth0
    if (isset($_POST['eth0']['dhcp']) && isset($_POST['eth0']['ip'])) {
        if ($_POST['eth0']['dhcp'] == 'true') {
	        $_POST['eth0']['dhcp'] = 'true';
	        $_POST['eth0']['ip'] = '';
	        $_POST['eth0']['netmask'] = '';
	        $_POST['eth0']['gw'] = '';
	        $_POST['eth0']['dns1'] = '';
	        $_POST['eth0']['dns2'] = '';
        } else {
        	$_POST['eth0']['dhcp'] = 'false';
		}
		
		$value = array('name' => 'eth0',
	        'dhcp' => $_POST['eth0']['dhcp'],
	        'ip' => $_POST['eth0']['ip'],
	        'netmask' => $_POST['eth0']['netmask'],
	        'gw' => $_POST['eth0']['gw'],
	        'dns1' => $_POST['eth0']['dns1'],
	        'dns2' => $_POST['eth0']['dns2'] );

	    cfgdb_update('cfg_lan',$dbh,'',$value);
	    $net = cfgdb_read('cfg_lan',$dbh);

        // format new config string for eth0
        if ($_POST['eth0']['dhcp'] == 'true' ) {
	        //$eth0 = "\nallow-hotplug eth0\niface eth0 inet dhcp\n";  // TC (Tim Curtis) 2015-10-30: place holder, allow-hotplug eth0
	        $eth0 = "\nauto eth0\niface eth0 inet dhcp\n";
        } else {
	        //$eth0 = "\nallow-hotplug eth0\niface eth0 inet static\n";  // TC (Tim Curtis) 2015-10-30: place holder, allow-hotplug eth0
	        $eth0 = "\nauto eth0\niface eth0 inet static\n";
	        $eth0 .= "address ".$_POST['eth0']['ip']."\n";
	        $eth0 .= "netmask ".$_POST['eth0']['netmask']."\n";
	        $eth0 .= "gateway ".$_POST['eth0']['gw']."\n";
			if (isset($_POST['eth0']['dns1']) && !empty($_POST['eth0']['dns1'])) {
				$eth0 .= "nameserver ".$_POST['eth0']['dns1']."\n";
			}
			if (isset($_POST['eth0']['dns2']) && !empty($_POST['eth0']['dns2'])) {
				$eth0 .= "nameserver ".$_POST['eth0']['dns2']."\n";
			}
        }
        
        $wlan0 = "\n";
    }

    // wlan0
    // TC (Tim Curtis) 2015-10-30: add isset to $_POST['wifisec']['password']
    if (isset($_POST['wifisec']['ssid']) && !empty($_POST['wifisec']['ssid']) && isset($_POST['wifisec']['password']) && !empty($_POST['wifisec']['password'])) {
	    $value = array('ssid' => $_POST['wifisec']['ssid'], 'encryption' => $_POST['wifisec']['encryption'], 'password' => $_POST['wifisec']['password']);
	    cfgdb_update('cfg_wifisec',$dbh,'',$value);
	    $wifisec = cfgdb_read('cfg_wifisec',$dbh);

        // format new config string for wlan0
        $wlan0 = "\n";
        //$wlan0 .= "allow-hotplug wlan0\n"; // TC (Tim Curtis) 2015-10-30: place holder, allow-hotplug wlan0
        $wlan0 .= "auto wlan0\n";
        $wlan0 .= "iface wlan0 inet dhcp\n";
		$wlan0 .= "wireless-power off\n";
        if ($_POST['wifisec']['encryption'] == 'wpa') {
	        $wlan0 .= "wpa-ssid ".$_POST['wifisec']['ssid']."\n"; // TC (Tim Curtis) 2015-08-30: place holder, add quotes around ssid
	        $wlan0 .= "wpa-psk ".$_POST['wifisec']['password']."\n";
        } else {
	        $wlan0 .= "wireless-essid ".$_POST['wifisec']['ssid']."\n"; // TC (Tim Curtis) 2015-08-30: place holder, add quotes around ssid
            if ($_POST['wifisec']['encryption'] == 'wep') {
    	        $wlan0 .= "wireless-key ".bin2hex($_POST['wifisec']['password'])."\n";
            } else {
        	    $wlan0 .= "wireless-mode managed\n";
            }
        }
       
       //$eth0 = "\nallow-hotplug eth0\niface eth0 inet dhcp\n"; // TC (Tim Curtis) 2015-10-30: place holder, allow-hotplug eth0
       $eth0 = "\nauto eth0\niface eth0 inet dhcp\n";

    } // end wlan0

	// handle manual config
	if(isset($_POST['netconf']) && !empty($_POST['netconf'])) {
		// tell worker to write new MPD config
		if ($_SESSION['w_lock'] != 1 && $_SESSION['w_queue'] == '') {
			session_start();
			$_SESSION['w_queue'] = "netcfgman";
			$_SESSION['w_queueargs'] = $_POST['netconf'];
			$_SESSION['w_active'] = 1;
			// set UI notify
			$_SESSION['notify']['title'] = 'Network config modified';
			$_SESSION['notify']['msg'] = '';
			session_write_close();
		} else {
			session_start();
			$_SESSION['notify']['title'] = 'Job failed';
			$_SESSION['notify']['msg'] = 'Background worker is busy';
			session_write_close();
		}
	}

	// close DB handle
	$dbh = null;

    // create job for background worker
    if ($_SESSION['w_lock'] != 1 && !isset($_POST['netconf'])) {
	    // start / respawn session
	    session_start();
	    $_SESSION['w_queue'] = 'netcfg';
	    $_SESSION['w_queueargs'] = $wlan0.$eth0;
	    $_SESSION['w_active'] = 1;
	    // set ui_notify
	    $_SESSION['notify']['title'] = '';
        if (isset($_GET['reset']) && $_GET['reset'] == 1 ) {
	        $_SESSION['notify']['msg'] = 'Network config reset';
        } else {
    	    $_SESSION['notify']['msg'] = 'Network config modified';
        }
    } else {
	    $_SESSION['notify']['title'] = '';
	    $_SESSION['notify']['msg'] = 'Background worker is busy';
    }
    // unlock session file
    playerSession('unlock');
}

// wait for worker output if $_SESSION['w_active'] = 1
waitWorker(1);
// check integrity of /etc/network/interfaces
if(!hashCFG('check_net',$db)) {
	$_netconf = file_get_contents('/etc/network/interfaces');
	// set manual config template
	$tpl = "net-config-manual.html";
} else {
	$dbh = cfgdb_connect($db);
	$net = cfgdb_read('cfg_lan',$dbh);
	$wifisec = cfgdb_read('cfg_wifisec',$dbh);
	$dbh = null;

    // eth0
    if (isset($_SESSION['netconf']['eth0']) && !empty($_SESSION['netconf']['eth0'])) {
		// TC (Tim Curtis) 2014-08-23
	    // changed class from "alert alert-info" to "help-block", added <br>
	    // TC (Tim Curtis) 2015-04-29: new layout
	    $_eth0 .= $_SESSION['netconf']['eth0']['ip'];
    } else {
	    $_eth0 .= "Not used";
    }
    //$_eth0 .= "<div class=\"help-block\">\n";
    //$_eth0 .= " IP address: ".$_SESSION['netconf']['eth0']['ip']."\n";
    //$_eth0 .= "</div>\n";
    //$_eth0 .= "<br>\n";
    //$_int0name .= $net[0]['name'];
    $_int0dhcp .= "<option value=\"true\" ".((isset($net[0]['dhcp']) && $net[0]['dhcp']=="true") ? "selected" : "")." >enabled (Auto)</option>\n";
    $_int0dhcp .= "<option value=\"false\" ".((isset($net[0]['dhcp']) && $net[0]['dhcp']=="false") ? "selected" : "")." >disabled (Static)</option>\n";
    $_int0 = $net[0];

    // wlan0
    if (isset($_SESSION['netconf']['wlan0']) && !empty($_SESSION['netconf']['wlan0'])) {
		// TC (Tim Curtis) 2014-08-23
	    // changed class from "alert alert-info" to "help-block", added <br>
	    // TC (Tim Curtis) 2015-04-29: new layout
	    $_wlan0 .= $_SESSION['netconf']['wlan0']['ip'];
	} else {
	    $_wlan0 .= "Not used";
	}
    //$_wlan0 .= "<legend>WLAN Interface: ".$net[1]['name']."</legend>\n";
    //$_wlan0 .= "<div class=\"help-block\">\n";
    //$_wlan0 .= $net[1]['name']." IP address: ".$_SESSION['netconf']['wlan0']['ip']."\n";
    //$_wlan0 .= "</div>\n";
    //$_wlan0 .= "<br>\n";
	$_wlan0ssid = $wifisec[0]['ssid'];

	// TC (Tim Curtis) 2015-04-29: reorder so WPA/WPA2 is first
    $_wlan0security .= "<option value=\"wpa\"".(($wifisec[0]['security'] == 'wpa') ? "selected" : "").">WPA/WPA2 Personal</option>\n";
    $_wlan0security .= "<option value=\"wep\"".(($wifisec[0]['security'] == 'wep') ? "selected" : "").">WEP</option>\n";
    $_wlan0security .= "<option value=\"none\"".(($wifisec[0]['security'] == 'none') ? "selected" : "").">No security</option>\n";
    
    
	// TC (Tim Curtis) 2015-10-30: add this
    $_wlan0password = $wifisec[0]['password'];

	$tpl = "net-config.html";
}

// unlock session files
playerSession('unlock',$db,'','');
?>

<?php
$sezione = basename(__FILE__, '.php');
include('_header.php');
?>

<!-- 
TC (Tim Curtis) 2014-11-30
- remove trailing ! in 1st content line causing code to be grayed out in editor 
-->
<!-- content -->
<?php
eval("echoTemplate(\"".getTemplate("templates/$tpl")."\");");
?>
<!-- content -->

<?php
debug($_POST);
?>

<?php include('_footer.php'); ?>
