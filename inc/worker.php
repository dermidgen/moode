<?php
/**
 *  PlayerUI Copyright (C) 2013 Andrea Coiutti & Simone De Gregori
 *  Tsunamp Team
 *  http://www.tsunamp.com
 *
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
 * Rewrite by Tim Curtis and Andreas Goetz
 */

function workerIsFree() {
	return !(isset($_SESSION['w_lock']) && isset($_SESSION['w_queue']))
		|| $_SESSION['w_lock'] !== 1 && $_SESSION['w_queue'] == '';
}

function workerQueueTask($task, $parameters = null) {
	if (!workerIsFree()) {
		return false;
	}

	$_SESSION['w_queue'] = $task;
	$_SESSION['w_active'] = 1;
	$_SESSION['w_queueargs'] = $parameters;

	return true;
}

function uiNotify($title, $msg, $duration = 2) {
	$_SESSION['notify'] = array(
		'title' => $title,
		'msg' => $msg,
		'duration' => $duration
	);
}

function wrk_checkStrSysfile($sysfile,$searchstr) {
	$file = stripcslashes(file_get_contents($sysfile));
	return (strpos($file, $searchstr)) ? true : false;
}

function wrk_mpdconf($outpath, $db, $kernelver, $i2s) {
	// extract mpd.conf from SQLite datastore
	$dbh = cfgdb_connect($db);
	$query_cfg = "SELECT param,value_player FROM cfg_mpd WHERE value_player!=''";
	$mpdcfg = sdbquery($query_cfg,$dbh);
	$dbh = null;

	// set mpd.conf file header
	// TC (Tim Curtis) 2015-04-29: remove tabs, cleanup formatting
	$output =  "#########################################\n";
	$output .= "# This file is automatically generated by\n";
	$output .= "# the Player via MPD Configuration page. \n";
	$output .= "#########################################\n";
	$output .= "\n";
	// parse DB output
	// TC (Tim Curtis) 2015-06-26; store volume mixer type in tcmods.conf
	// TC (Tim Curtis) 2015-06-26; use GetMixerName() instead of alsa_findHwMixerControl()
	foreach ($mpdcfg as $cfg) {
		if ($cfg['param'] == 'audio_output_format' && $cfg['value_player'] == 'disabled'){
			$output .= '';
		}
		else if ($cfg['param'] == 'dsd_usb') {
			$dsd = $cfg['value_player'];
		}
		else if ($cfg['param'] == 'device') {
			$device = $cfg['value_player'];
			var_export($device);
		}
		else if ($cfg['param'] == 'mixer_type') {
			// store volume mixer type in tcmods.conf
			$_tcmods_conf = _parseTcmodsConf(shell_exec('cat /var/www/tcmods.conf')); // read in conf file
			if ($_tcmods_conf['volume_mixer_type'] != $cfg['value_player']) {
				$_tcmods_conf['volume_mixer_type'] = $cfg['value_player'];
				$rtn = _updTcmodsConf($_tcmods_conf); // update conf file
			}

			// get volume mixer control name
			if ($cfg['value_player'] == 'hardware' ) {
				$hwmixer['control'] = getMixerName($kernelver, $i2s);
			}
			else {
				$output .= $cfg['param']." \"".$cfg['value_player']."\"\n";
			}
		}
		else {
			$output .= $cfg['param']." \"".$cfg['value_player']."\"\n";
		}
	}

	// format audio input / output interfaces
	$output .= "max_connections \"20\"\n";
	$output .= "\n";
	$output .= "decoder {\n";
	$output .= "plugin \"ffmpeg\"\n";
	$output .= "enabled \"yes\"\n";
	$output .= "}\n";
	$output .= "\n";
	$output .= "input {\n";
	$output .= "plugin \"curl\"\n";
	$output .= "}\n";
	$output .= "\n";
	$output .= "audio_output {\n";
	$output .= "type \"alsa\"\n";
	$output .= "name \"Output\"\n";
	$output .= "device \"hw:".$device.",0\"\n";
	if (isset($hwmixer)) {
		//$output .= "\t\t mixer_device \t\"".$hwmixer['device']."\"\n";
		$output .= "mixer_control \"".$hwmixer['control']."\"\n";
		$output .= "mixer_device \"hw:".$device."\"\n";
		$output .= "mixer_index \"0\"\n";
		//$output .= "\t\t mixer_index \t\"".$hwmixer['index']."\"\n";
	}
	$output .= "dsd_usb \"".$dsd."\"\n";
	$output .= "}\n";

	// write mpd.conf file
	$fh = fopen($outpath."/mpd.conf", 'w');
	fwrite($fh, $output);
	fclose($fh);
}

function wrk_sourcemount($db,$action,$id = null) {
	$return = null;

	switch ($action) {
		case 'mount':
			$dbh = cfgdb_connect($db);
			$mp = cfgdb_read('cfg_source',$dbh,'',$id);
			sysCmd("mkdir \"/mnt/NAS/".$mp[0]['name']."\"");
			$mountstr = ($mp[0]['type'] == 'cifs')
				// smb/cifs mount
				? "mount -t cifs \"//".$mp[0]['address']."/".$mp[0]['remotedir']."\" -o username=".$mp[0]['username'].",password='".$mp[0]['password']."',rsize=".$mp[0]['rsize'].",wsize=".$mp[0]['wsize'].",iocharset=".$mp[0]['charset'].",".$mp[0]['options']." \"/mnt/NAS/".$mp[0]['name']."\""
				: "mount -t nfs -o ".$mp[0]['options']." \"".$mp[0]['address'].":/".$mp[0]['remotedir']."\" \"/mnt/NAS/".$mp[0]['name']."\"";

			// debug
			error_log(">>>>> mount string >>>>> ".$mountstr,0);
			$sysoutput = sysCmd($mountstr);
			error_log(var_dump($sysoutput),0);
			if (empty($sysoutput)) {
				if (!empty($mp[0]['error'])) {
					$mp[0]['error'] = '';
					cfgdb_update('cfg_source',$dbh,'',$mp[0]);
				}
				$return = 1;
			}
			else {
				sysCmd("rmdir \"/mnt/NAS/".$mp[0]['name']."\"");
				$mp[0]['error'] = implode("\n",$sysoutput);
				cfgdb_update('cfg_source',$dbh,'',$mp[0]);
				$return = 0;
			}
			break;

		case 'mountall':
			$dbh = cfgdb_connect($db);
			$mounts = cfgdb_read('cfg_source',$dbh);
			foreach ($mounts as $mp) {
				if (!wrk_checkStrSysfile('/proc/mounts',$mp['name']) ) {
					$return = wrk_sourcemount($db,'mount',$mp['id']);
				}
			}
			$dbh = null;
			break;
	}
	return $return;
}

function wrk_sourcecfg($db,$queueargs) {
	$action = $queueargs['mount']['action'];
	unset($queueargs['mount']['action']);
	switch ($action) {
		case 'reset':
			$dbh = cfgdb_connect($db);
			$source = cfgdb_read('cfg_source',$dbh);
				foreach ($source as $mp) {
					sysCmd("umount -f \"/mnt/NAS/".$mp['name']."\"");
					sysCmd("rmdir \"/mnt/NAS/".$mp['name']."\"");
				}
			$return = (cfgdb_delete('cfg_source',$dbh)) ? 1 : 0;
			$dbh = null;
			break;

		case 'add':
			$dbh = cfgdb_connect($db);
			print_r($queueargs);
			unset($queueargs['mount']['id']);
			// format values string
			foreach ($queueargs['mount'] as $key => $value) {
				if ($key == 'error') {
					$values .= "'".SQLite3::escapeString($value)."'";
					error_log(">>>>> values on line 1014 >>>>> ".$values, 0);
				}
				else {
					$values .= "'".SQLite3::escapeString($value)."',";
					error_log(">>>>> values on line 1016 >>>>> ".$values, 0);
				}
			}
			error_log(">>>>> values on line 1019 >>>>> ".$values, 0);
			// write new entry
			cfgdb_write('cfg_source',$dbh,$values);
			$newmountID = $dbh->lastInsertId();
			$dbh = null;
			$return = (wrk_sourcemount($db,'mount',$newmountID)) ? 1 : 0;
			break;

		case 'edit':
			$dbh = cfgdb_connect($db);
			$mp = cfgdb_read('cfg_source',$dbh,'',$queueargs['mount']['id']);
			cfgdb_update('cfg_source',$dbh,'',$queueargs['mount']);
			sysCmd("umount -f \"/mnt/NAS/".$mp[0]['name']."\"");
			if ($mp[0]['name'] != $queueargs['mount']['name']) {
				sysCmd("rmdir \"/mnt/NAS/".$mp[0]['name']."\"");
				sysCmd("mkdir \"/mnt/NAS/".$queueargs['mount']['name']."\"");
			}
			$return = (wrk_sourcemount($db,'mount',$queueargs['mount']['id'])) ? 1 : 0;
			error_log(">>>>> wrk_sourcecfg(edit) exit status = >>>>> ".$return, 0);
			$dbh = null;
			break;

		case 'delete':
			$dbh = cfgdb_connect($db);
			$mp = cfgdb_read('cfg_source',$dbh,'',$queueargs['mount']['id']);
			sysCmd("umount -f \"/mnt/NAS/".$mp[0]['name']."\"");
			sysCmd("rmdir \"/mnt/NAS/".$mp[0]['name']."\"");
			$return = (cfgdb_delete('cfg_source',$dbh,$queueargs['mount']['id'])) ? 1 : 0;
			$dbh = null;
			break;
	}

	return $return;
}

function wrk_getHwPlatform() {
	$file = '/proc/cpuinfo';
	$fileData = file($file);
	foreach($fileData as $line) {
		if (substr($line, 0, 8) == 'Hardware') {
			$arch = trim(substr($line, 11, 50));
			switch($arch) {

				// RaspberryPi
				case 'BCM2708':
					$arch = '01';
					break;

				// UDOO
				case 'SECO i.Mx6 UDOO Board':
					$arch = '02';
					break;

				// CuBox
				case 'Marvell Dove (Flattened Device Tree)':
					$arch = '03';
					break;

				// BeagleBone Black
				case 'Generic AM33XX (Flattened Device Tree)':
					$arch = '04';
					break;

				// Compulab Utilite
				case 'Compulab CM-FX6':
					$arch = '05';
					break;

				// Wandboard
				case 'Freescale i.MX6 Quad/DualLite (Device Tree)':
					$arch = '06';
					break;

				default:
					$arch = '--';
					break;
			}
		}
	}
	if (!isset($arch)) {
		$arch = '--';
	}
	return $arch;
}

function wrk_setHwPlatform($db) {
	$arch = wrk_getHwPlatform();
	$playerid = wrk_playerID($arch);
	// register playerID into database
	playerSession('write',$db,'playerid',$playerid);
	// register platform into database
	switch($arch) {
		case '01':
			playerSession('write',$db,'hwplatform','RaspberryPi');
			playerSession('write',$db,'hwplatformid',$arch);
			break;

		case '02':
			playerSession('write',$db,'hwplatform','UDOO');
			playerSession('write',$db,'hwplatformid',$arch);
			break;

		case '03':
			playerSession('write',$db,'hwplatform','CuBox');
			playerSession('write',$db,'hwplatformid',$arch);
			break;

		case '04':
			playerSession('write',$db,'hwplatform','BeagleBone Black');
			playerSession('write',$db,'hwplatformid',$arch);
			break;

		case '05':
			playerSession('write',$db,'hwplatform','Compulab Utilite');
			playerSession('write',$db,'hwplatformid',$arch);
			break;

		case '06':
			playerSession('write',$db,'hwplatform','Wandboard');
			playerSession('write',$db,'hwplatformid',$arch);
			break;

		default:
			playerSession('write',$db,'hwplatform','unknown');
			playerSession('write',$db,'hwplatformid',$arch);
	}
}

function wrk_playerID($arch) {
	$playerid = $arch.md5_file('/sys/class/net/eth0/address');
	return $playerid;
}

function wrk_sysChmod() {
	sysCmd('chmod -R 777 /var/www/db');
	sysCmd('chmod a+x /var/www/command/orion_optimize.sh');
	// TC (Tim Curtis) 2015-01-27
	// - moved from /home/... dir
	sysCmd('chmod a+x /var/www/command/unmute.sh');
	sysCmd('chmod 777 /run');
	sysCmd('chmod 777 /run/sess*');
	sysCmd('chmod a+rw /etc/mpd.conf');
}
