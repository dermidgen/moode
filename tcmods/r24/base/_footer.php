<!-- 
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
 *	file:					_footer.php
 * 	version:				1.1
 *
 *	TCMODS Edition 
 *
 *	TC (Tim Curtis) 2014-08-23, r1.0
 *	- call tcmods.php instead of settings.php to handle pwroff and reboot actions from the "Turn off" menu pick
 *	- add modal popup for the INFO header btn
 *	- add modal popup for the About menu pick
 *
 *	TC (Tim Curtis) 2014-09-17, r1.1
 *	- add contrib for Anthony Ryan Delorie, author of JSON Sort routine used in js/player_lib.js
 *	- add contrib for jotak, author of the Library Panel
 *	- add contrib for Brad Daily, author of DOM Immediate Update used in js/player_lib.js
 *	- change <a id="tcmods-about-... to <a class="tcmods-about-...
 *	- update release number to 1.1
 *
 *	TC (Tim Curtis) 2014-10-31, r1.2
 *	- update release number to 1.2
 *
 *	TC (Tim Curtis) 2014-12-23, r1.3
 *	- update release number to 1.3
 *	- add modal popup for 2nd volume control
 *	- add modal popup for delete saved playlist action
 *	- add modal popups for Webradio create/edit/delete/import actions
 *	- apply modal-sm class to all modals for automatic resize on small screens
 *  - enable links.js script so config page (external) links stay within homescreen app on IOS
 *	- add, edit radio station
 *	- delete, move playlist items
 *	- move volume popup modal to indextpl.html
 *	- remove data-trigger="change" on input fields, does not appear to be used by anything 
 *
 *	TC (Tim Curtis) 2015-01-01, r1.4
 *	- update release number to 1.4
 *
 *	TC (Tim Curtis) 2015-01-27, r1.5
 *	- update release number to 1.5
 *	- change clock radio max minutes to 59 from 60
 *	- speed btns on move and delete modals to set top and bottom pos
 *	- tcmods config editor modal
 *	- volume limit warning modal
 *	- add contrib from SomaFM
 *	- add control aftertext to certain controls
 *	- Move action buttons to modal footer
 *	- modal-action-btns class for show/hide on small screens
 *	- shovel & broom
 *
 *	TC (Tim Curtis) 2015-02-25, r1.6
 *	- update release number to 1.6
 *	- add warranty statement
 *	- add platform info section to About
 *	- cleanup some text
 *
 *	TC (Tim Curtis) 2015-03-21, r1.7
 *	- update release number to 1.7
 *	- add new player logotype and text
 *	- change TCMODS config to Custom config
 *	- add dropdown select for audio device
 *	- enable volume warning limit setting change directly from popup
 *
 *	TC (Tim Curtis) 2015-04-29, r1.8
 *	- update release number to 1.8
 *	- add dropdown select for theme color
 *	- remove tabindex= from select lists
 *	- update audio device list
 *
 *	TC (Tim Curtis) 2015-05-30, r1.9
 *	- update release number to 1.9
 *	- update contributions section of About
 *	- add playback history feature to Custom config
 *
 *	TC (Tim Curtis) 2015-06-26, r2.0
 *	- update release number to 2.0
 *	- add config settings popup containing Sources, MPD, Network and System config links 
 *	- add contribs for major feature ideas
 *	- add logarithmic volume control feature to Customize popup
 *	- add album art lookup method to Custom config
 *	- add IQaudIO Pi-DigiAMP+, Hifimediy ES9023, Perreaux Audiant 80i to Audio device description list
 *	- add LH Labs Geek Pulse X-Fi and Schiit Modi 2 to Audio device description list
 *	- add first/last page btns to Customization settings popup
 *
 *	TC (Tim Curtis) 2015-07-31, r2.1
 *	- update release number to 2.1
 *	- Add CM6631A USB to S/PDIF Converter to audio device list
 *  - Add Audiophonics I-Sabre DAC ES9023 TCXO to audio device list
 *	- add contrib for script to resize rootfs partition (Mike Ray)
 *	- change tcmods.org to moodeaudio.org
 *
 *	TC (Tim Curtis) 2015-08-30, r2.2
 *	- update release number to 2.2
 *	- remove rel= in <li lines
 *	- remove album art lookup method from Custom config popup
 *	- Add AudioQuest DragonFly, TEAC UD-501 and Cyenne devices to audio device list
 *	- Add contrib for Mike Brady (shairport-sync)
 *  - Add contrib for Gordon Garrity (IQaudIO Rotary Encoder)
 *  - Add contrib for Gordon Henderson (WiringPi GPIO interface)
 *  - Add contrib for Andreas Goetz (Moode 3 project)
 *	- Shovel & broom
 *
 *	TC (Tim Curtis) 2015-09-05, r2.3
 *	- update release number to 2.3
 *
 *	TC (Tim Curtis) 2015-10-30, r2.4
 *	- update release number to 2.4
 *	- change "delete" to "remove" playlist items
 *	- add Audiophonics PCM5122 DAC, Mamboberry HiFi DAC+, Lucid Labs Raspberry Pi DAC and LKS MH-DA003
 *	- add Nuforce HDP DAC, PlainDAC, PlainDAC+, iFi Audio Nano iDsD, and HifiBerry DAC+ Pro
 *	- change PHP v5.4 to just v5
 *	- add Playlist display Yes/No to Customize popup
 *
 */
-->
<!-- ABOUT -->	
<!-- TC (Tim Curtis) 2014-08-23: initial version -->
<div id="about-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="about-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="about-modal-label">About Moode</h3>
	</div>
	<div class="modal-body">
		<p>
			<img src="images/player-logotype-v2-transparent-wt.png" style="height:48px;">
			<p>Moode Audio Player is a derivative of the wonderful WebUI audio player client for MPD originally designed and coded by Andrea Coiutti and Simone De Gregori, and subsequently enhanced by efforts from the RaspyFi/Volumio projects.</p>
			<ul>
				<li>Release: 2.4, 2015-10-30<a class="tcmods-about-link1" href="./tcmods-relnotes.txt" target="_blank"> release notes</a></li>
				<li>Coding:	Tim Curtis, &copy; 2014<a class="tcmods-about-link1" href="./tcmods-readme.txt" target="_blank"> readme: player setup</a></li>
				<li>Download: <a class="tcmods-about-link1" href="http://moodeaudio.org" target="_blank">http://moodeaudio.org</a></li>
				<li>License: GPL <a class="tcmods-about-link1" href="#gpl-license">(see below)</a></li>
				<li>Warranty: NONE <a class="tcmods-about-link1" href="#warranty-info">(see below)</a></li>
			</ul>
		</p>
		<p>
			<h4>Platform Information</h4>
			<ul>
				<li>Linux kernel: <span id="sys-kernel-ver"></span></li>
				<li>Architecture: <span id="sys-processor-arch"></span></li>
				<li>MPD version: <span id="sys-mpd-ver"></span></li>
			</ul>
		</p>
		<p>
			<h4>Contributions and Acknowledgements</h4>
			<p>
				The following is a list of contributors including those whose names appeared in the original code. Note this list may not be all inclusive.
			</p>
			<h6>Feature Ideas</h6>
			<p> 
				Alan Finnie: Logarithmic volume control<br>
				Bob Daggg: Clock radio and Playback history log<br>
				Dr. Panagiotis Karavitis: Playback panel with integrated Playlist<br>
				Ralf Braun: UPnP album art and metadata<br>
			</p>
			<h6>Moode 3 Project</h6>
			<p> 
				Andreas Goetz (cpuidle@gmx.de)<br>
				<a class="tcmods-about-link1" href="https://github.com/moodeaudio" target="_blank">https://github.com/moodeaudio</a><br>
			</p>
			<h6>Components and Code</h6>
			<p>
				Andreas Goetz: Embedded cover art and other improvements<br>
				<a class="tcmods-about-link1" href="https://github.com/moodeaudio" target="_blank">https://github.com/moodeaudio</a><br>
				Gordon Garrity: author of IQ_rot, IQ_ir device drivers<br>
				<a class="tcmods-about-link1" href="https://github.com/iqaudio" target="_blank">https://github.com/iqaudio</a><br>
				Gordon Henderson: author of WiringPi GPIO access library<br>
				<a class="tcmods-about-link1" href="http://wiringpi.com" target="_blank">http://wiringpi.com</a><br>
				Jean-Francois Dockes: author of upexplorer, a UPnP interface utility<br>
				<a class="tcmods-about-link1" href="http://www.lesbonscomptes.com/upmpdcli" target="_blank">http://www.lesbonscomptes.com/upmpdcli</a><br>
				Rusty Hodge: founder of Soma FM and provider of high-res station logo links<br>
				<a class="tcmods-about-link1" href="http://somafm.com" target="_blank">http://somafm.com</a><br>
				Mike Ray: Script to resize rootfs partition<br>
				<a class="tcmods-about-link1" href="https://github.com/lgierth/pimesh/blob/master/files/raspi-expand-rootfs.sh" target="_blank">https://github.com</a><br>
				Anthony Ryan Delorie: JSON Sort Routine<br>
				<a class="tcmods-about-link1" href="http://stackoverflow.com" target="_blank">http://stackoverflow.com</a><br>
				Brad Daily: DOM Immediate Update<br>
				<a class="tcmods-about-link1" href="http://stackoverflow.com" target="_blank">http://stackoverflow.com</a>
			</p>
			<h6>Core Components</h6>
			<p>
				Bootstrap by @mdo and @fat<br>
				<a class="tcmods-about-link2" href="http://twitter.github.io/bootstrap/" target="_blank">http://twitter.github.io/bootstrap</a><br>
				Bootstrap-select by caseyjhol<br>
				<a class="tcmods-about-link2" href="http://silviomoreto.github.io/bootstrap-select/" target="_blank">http://silviomoreto.github.io/bootstrap-select</a><br>
				Debian Linux created by Ian Murdock in 1993<br>
				<a class="tcmods-about-link2" href="http://www.debian.org/" target="_blank">http://www.debian.org</a><br>
				djmount by Rémi Turboult<br>
				<a class="tcmods-about-link2" href="http://djmount.sourceforge.net/" target="_blank">http://djmount.sourceforge.net</a><br>
				Flat UI by Designmodo<br>
				<a class="tcmods-about-link2" href="http://designmodo.github.io/Flat-UI/" target="_blank">http://designmodo.github.io/Flat-UI</a><br>
				Font Awesome by Dave Gandy<br>
				<a class="tcmods-about-link2" href="http://fontawesome.io/" target="_blank">http://fontawesome.io</a><br>
				jQuery Countdown by Keith Wood<br>
				<a class="tcmods-about-link2" href="http://keith-wood.name/countdown.html" target="_blank">http://keith-wood.name/countdown.html</a><br>
				jQuery Knob by Anthony Terrien<br>
				<a class="tcmods-about-link2" href="https://github.com/aterrien/jQuery-Knob" target="_blank">https://github.com/aterrien/jQuery-Knob</a><br>
				jQuery scrollTo by Ariel Flesler<br>
				<a class="tcmods-about-link2" href="http://flesler.blogspot.it/2007/10/jqueryscrollto.html" target="_blank">http://flesler.blogspot.it/2007/10/jqueryscrollto.html</a><br>
				Lato-Fonts by Łukasz Dziedzic<br>
				<a class="tcmods-about-link2" href="http://www.latofonts.com/lato-free-fonts/" target="_blank">http://www.latofonts.com/lato-free-fonts</a><br>
				MiniDLNA by Justin Maggard<br>
				<a class="tcmods-about-link2" href="http://minidlna.sourceforge.net/" target="_blank">http://minidlna.sourceforge.net</a><br>
				MPD by Max Kellermann, Avuton Olrich and Warren Dukes<br>
				<a class="tcmods-about-link2" href="http://www.musicpd.org/" target="_blank">http://www.musicpd.org</a><br>
				PHP v5 by the PHP Team<br>
				<a class="tcmods-about-link2" href="http://php.net" target="_blank">http://php.net</a><br>
				Shairport-sync by Mike Brady<br>
				<a class="tcmods-about-link2" href="https://github.com/mikebrady/shairport-sync" target="_blank">https://github.com/mikebrady/shairport-sync</a><br>
				SQLite v3 by the SQLite Team<br>
				<a class="tcmods-about-link2" href="http://www.sqlite.org" target="_blank">http://www.sqlite.org</a><br>
				upmpdcli by Jean-Francois Dockes<br>
				<a class="tcmods-about-link2" href="http://www.lesbonscomptes.com/upmpdcli/" target="_blank">http://www.lesbonscomptes.com/upmpdcli/</a><br>
			</p>		
			<div id="original-code">
				<h6>Original Code</h6>
				<p> 
					Andrea Coiutti: WebUI design, HTML/CSS/JS coding<br>
					Simone De Gregori: PHP/MPD/JS coding and OS optimizations<br>
					<a class="tcmods-about-link1" href="http://runeaudio.com" target="_blank">http://runeaudio.com</a><br>
					Michelangelo Guarise: RaspyFi/Volumio enhancements, OS image build<br>
					- One and a half year of work more than Raspyfi's WebUI made by ACX and Orion<br>
					- Work has been performed by me, Jotak and other Volumio community members<br>
					<a class="tcmods-about-link1" href="http://volumio.org" target="_blank">http://volumio.org</a><br>
					Joel Takvorian (jotak): Library Loader and Panel v1<br>
					<a class="tcmods-about-link1" href="http://volumio.org/forum/web-enhancements-t1236.html" target="_blank">volumio forum post</a><br>
					Jan Sandred (jansandred): Radio Station PLS Files (original set)<br>
					<a class="tcmods-about-link1" href="http://volumio.org/forum/internet-radio-stations-volumio-t641.html" target="_blank">volumio forum post</a><br>
				</p>
			</div>
		</p>
		<div id="gpl-license">
			<h4>License Information</h4>
			<p>
				This Program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation either version 3, or (at your option) any later version. This Program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. You should have received a copy of the GNU General Public License along with this software; refer to the file named LICENSE. If not, refer to the following online resource for the license: <a class="tcmods-about-link1" href="http://www.gnu.org/licenses/" target="_blank">http://www.gnu.org/licenses</a>
			</p>
		</div>
		<div id="warranty-info">
			<h4>Waranty Information</h4>
			<p>
				This software is provided for free by the copyright holders and contributors and comes with no expressed or implied warranties or any other guarantees.
			</p>
		</div>	
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>

<!-- TURN OFF -->	
<!-- TC (Tim Curtis) 2014-08-23: initial version -->
<form class="form-horizontal" action="tcmods.php" method="post">
	<div id="poweroff-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="poweroff-modal-label" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 id="poweroff-modal-label">Turn off the player</h3>
		</div>
		<div class="modal-body">
			<button id="syscmd-poweroff" name="syscmd" value="poweroff" class="btn btn-primary btn-large btn-block"><i class="icon-power-off sx"></i> Power off</button>
			<button id="syscmd-reboot" name="syscmd" value="reboot" class="btn btn-primary btn-large btn-block"><i class="icon-refresh sx"></i> Reboot</button>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		</div>
	</div>
</form>

<!-- AUDIO INFORMATION -->	
<!-- TC (Tim Curtis) 2014-08-23: initial version -->
<div id="audioinfo-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="audioinfo-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="audioinfo-modal-label">Audio information</h3>
	</div>
	<div class="modal-body">
	</div>
	<!-- There is a custom footer for this modal
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
	-->
</div>

<!-- DELETE CONFIRMATION -->	
<!-- TC (Tim Curtis) 2014-11-30: initial version -->
<div id="deletesavedpl-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="deletesavedpl-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="deletesavedpl-modal-label">Delete saved playlist</h3>
	</div>
	<div class="modal-body">
		<h4 id='savedpl-path'></h4>
	</div>
	<div class="modal-footer">
		<button class="btn btn-del-savedpl btn-primary" data-dismiss="modal">Delete Playlist</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="deletestation-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="deletestation-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="deletestation-modal-label">Delete radio station</h3>
	</div>
	<div class="modal-body">
		<h4 id='station-path'></h4>
	</div>
	<div class="modal-footer">
		<button class="btn btn-del-radiostn btn-primary" data-dismiss="modal">Delete Station</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<!-- RADIO STATION MAINTENANCE -->	
<!-- TC (Tim Curtis) 2014-12-23: initial version -->
<div id="addstation-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="addstation-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="addstation-modal-label">Create radio station</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" data-validate="parsley" action="" method="">
	    	<fieldset>
				<div class="control-group">
	                <label class="control-label" for="add-station-name">Station name</label>
	                <div class="controls">
	                    <input id="add-station-name" class="input-xlarge" type="text" name="add-station_name" size="200" value="">
	                </div>
	                <label class="control-label" for="add-station-url">Station URL</label>
	                <div class="controls">
	                    <input id="add-station-url" class="input-xlarge" type="text" name="add-station_url" size="200" value="">
	                </div>
	            </div>
	    	</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn btn-add-radiostn btn-primary" data-dismiss="modal">Add Station</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="editstation-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="editstation-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="editstation-modal-label">Edit radio station</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" data-validate="parsley" action="" method="">
	    	<fieldset>
				<div class="control-group">
	                <label class="control-label" for="edit-station-name">Station name</label>
	                <div class="controls">
	                    <input id="edit-station-name" class="input-xlarge" type="text" name="edit_station_name" size="200" value="">
	                </div>
	                <label class="control-label" for="edit-station-url">Station URL</label>
	                <div class="controls">
	                    <input id="edit-station-url" class="input-xlarge" type="text" name="edit_station_url" size="200" value="">
	                </div>
	            </div>
	    	</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn btn-update-radiostn btn-primary" data-dismiss="modal">Update Station</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<!-- PLAYLIST MAINTENANCE -->	
<!-- TC (Tim Curtis) 2014-12-23: initial version -->
<!-- TC (Tim Curtis) 2015-01-27: add speed buttons to set top and bottom pos -->
<!-- TC (Tim Curtis) 2015-10-30: change "delete" to "remove" -->
<div id="deleteplitems-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteplitems-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="deleteplitems-modal-label">Remove playlist items</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" data-validate="parsley" action="" method="">
	    	<fieldset>
				<div class="control-group">
	                <label class="control-label" for="delete-plitem-begpos">Beginning item</label>
	                <div class="controls">
	                    <input id="delete-plitem-begpos" class="input-small" style="height: 20px;" type="number" min="1" max="" name="delete_plitem_begpos" value="">
						<button id="btn-delete-setpos-top" class="btn btn-mini btn-default"><i class="icon-double-angle-up"></i></button>
	                </div>
	                <label class="control-label" for="delete-plitem-endpos">Ending item</label>
	                <div class="controls">
	                    <input id="delete-plitem-endpos" class="input-small" style="height: 20px;" type="number"  min="1" max="" name="delete_plitem_endpos" value="">
						<button id="btn-delete-setpos-bot" class="btn btn-mini btn-default"><i class="icon-double-angle-down"></i></button>
	                </div>
	            </div>
	    	</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn btn-delete-plitem btn-primary" data-dismiss="modal">Remove items</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="moveplitems-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="moveplitems-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="moveplitems-modal-label">Move playlist items</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" data-validate="parsley" action="" method="">
	    	<fieldset>
				<div class="control-group">
	                <label class="control-label" for="move-plitem-begpos">Beginning item</label>
	                <div class="controls">
	                    <input id="move-plitem-begpos" class="input-small" style="height: 20px;" type="number"  min="1" max="" name="move_plitem_begpos" value="">
						<button id="btn-move-setpos-top" class="btn btn-mini btn-default"><i class="icon-double-angle-up"></i></button>
	                </div>
	                <label class="control-label" for="move-plitem-endpos">Ending item</label>
	                <div class="controls">
	                    <input id="move-plitem-endpos" class="input-small" style="height: 20px;" type="number"  min="1"  max="" name="move_plitem_endpos" value="">
						<button id="btn-move-setpos-bot" class="btn btn-mini btn-default"><i class="icon-double-angle-down"></i></button>
	                </div>
	                <label class="control-label" for="move-plitem-newpos">New position</label>
	                <div class="controls">
	                    <input id="move-plitem-newpos" class="input-small" style="height: 20px;" type="number"  min="1"  max="" name="move_plitem_newpos" value="">
						<button id="btn-move-setnewpos-top" class="btn btn-mini btn-default"><i class="icon-double-angle-up"></i></button>
						<button id="btn-move-setnewpos-bot" class="btn btn-mini btn-default"><i class="icon-double-angle-down"></i></button>
	                </div>
	            </div>
	    	</fieldset>
		</form>
	</div>
	<div class="modal-footer">
		<button class="btn btn-move-plitem btn-primary" data-dismiss="modal">Move Items</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<!-- CLOCK RADIO -->	
<!-- TC (Tim Curtis) 2014-12-23: initial version -->
<!-- TC (Tim Curtis) 2015-01-27: add class modal-action-btns hide -->
<div id="clockradio-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="clockradio-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="clockradio-modal-label">Clock radio settings</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" data-validate="parsley" action="" method="">
	    	<fieldset>
				<div class="control-group">
	                <label class="control-label" for="clockradio-enabled">Enabled</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="clockradio-enabled" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="clockradio-enabled-yn"><span class="text">Yes</span></a></li>
									<li><a href="#notarget" data-cmd="clockradio-enabled-yn"><span class="text">No</span></a></li>
								</ul>
							</div>
						</div>
	                </div>
	                
	                <label class="control-label" for="clockradio-playname">Play</label>
	                <div class="controls">
	                    <input id="clockradio-playname" class="input-xlarge" type="text" name="clockradio_playname" value="" readonly>
	                </div>
	                
	                <label class="control-label" for="clockradio-starttime-hh">Start time</label>
	                <div class="controls">
	                    <input id="clockradio-starttime-hh" class="input-mini" style="height: 20px;" type="number" maxlength="2" min="1" max="12" name="clockradio_starttime-hh" value="">
	                    <span>:</span>
	                    <input id="clockradio-starttime-mm" class="input-mini" style="height: 20px;" type="number" maxlength="2" min="0" max="59" name="clockradio_starttime-mm" value="">
						
						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="clockradio-starttime-ampm" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="clockradio-starttime-ampm"><span class="text">AM</span></a></li>
									<li><a href="#notarget" data-cmd="clockradio-starttime-ampm"><span class="text">PM</span></a></li>
								</ul>
							</div>
						</div>
	                </div>
	                
	                <label class="control-label" for="clockradio-stoptime-hh">Stop time</label>
	                <div class="controls">
	                    <input id="clockradio-stoptime-hh" class="input-mini" style="height: 20px;" type="number" maxlength="2" min="1" max="12" name="clockradio_stoptime-hh" value="">
	                    <span>:</span>
	                    <input id="clockradio-stoptime-mm" class="input-mini" style="height: 20px;" type="number" maxlength="2" min="0" max="59" name="clockradio_stoptime-mm" value="">
						
						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="clockradio-stoptime-ampm" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="clockradio-stoptime-ampm"><span class="text">AM</span></a></li>
									<li><a href="#notarget" data-cmd="clockradio-stoptime-ampm"><span class="text">PM</span></a></li>
								</ul>
							</div>
						</div>
	                </div>
	                
	                <label class="control-label" for="clockradio-volume">Volume</label>
	                <div class="controls">
	                    <input id="clockradio-volume" class="input-mini" style="height: 20px;" type="number" min="1" max="" name="clockradio_volume" value="">
						<span id="clockradio-volume-aftertext" class="control-aftertext"></span> <!-- text set in player-scripts.js -->
	                </div>
	                
	                <label class="control-label" for="clockradio-shutdown">Shutdown</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="clockradio-shutdown" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="clockradio-shutdown-yn"><span class="text">Yes</span></a></li>
									<li><a href="#notarget" data-cmd="clockradio-shutdown-yn"><span class="text">No</span></a></li>
								</ul>
							</div>
						</div>
						<span class="control-aftertext">after stop</span>
	                </div>
	            </div>
	    	</fieldset>
		</form>
		<div class="modal-action-btns hide">
			<button class="btn btn-clockradio-update btn-primary" data-dismiss="modal">Update Settings</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-clockradio-update btn-primary" data-dismiss="modal">Update Settings</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<!-- TCMODS CONFIG EDITOR (CUSTOM CONFIG) -->	
<!-- TC (Tim Curtis) 2015-01-27: initial version -->
<!-- TC (Tim Curtis) 2015-01-27: add class modal-action-btns hide -->
<!-- TC (Tim Curtis) 2015-03-21: change TCMODS config to Custom config -->
<!-- TC (Tim Curtis) 2015-05-30: add play history feature -->
<!-- TC (Tim Curtis) 2015-06-26: add logarithmic volume control feature -->
<!-- TC (Tim Curtis) 2015-06-26: add id=container-customize to modal-body div for first/last/page scroll -->
<div id="tcmodsconf-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="tcmodsconf-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="tcmodsconf-modal-label">Customization settings</h3>
	</div>
	<div class="modal-body" id="container-customize">
		<form class="form-horizontal" data-validate="parsley" action="" method="">
			<h4>General settings</h4>
	    	<fieldset>
				<div class="control-group">
	                <label class="control-label" for="volume-warning-limit">Volume warning limit</label>
	                <div class="controls">
	                    <input id="volume-warning-limit" class="input-mini" style="height: 20px;" type="number" maxlength="3" min="1" max="100" name="volume_warning_limit" value="">
						<span id="volume-warning-limit-aftertext" class="control-aftertext2"></span> <!-- text set in player-scripts.js -->
						<a class="info-toggle" data-cmd="info-volume-warning-limit" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-volume-warning-limit" class="help-block hide">
	                    	A popup appears when volume exceeds the warning value.<br>
	                    	- The popup provides a button to change the limit.<br>
	                    	- Setting the limit to 100 disables the popup.
	                    </span>
	                </div>
	                
   	                <label class="control-label" for="search-autofocus-enabled">Search auto-focus</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="search-autofocus-enabled" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="search-autofocus-enabled-yn"><span class="text">Yes</span></a></li>
									<li><a href="#notarget" data-cmd="search-autofocus-enabled-yn"><span class="text">No</span></a></li>
								</ul>
							</div>
						</div>
						<a class="info-toggle" data-cmd="info-search-audofocus" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-search-audofocus" class="help-block hide">
	                    	Controls whether search fields automatically receive focus when the toolbar shows.<br>
	                    	- On Smartphone/Tablet, autofocus will cause the popup keyboard to appear.
	                    </span>
	                </div>

   	                <label class="control-label" for="theme-color">Theme color</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select" style="width: 110px;"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="theme-color" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #e74c3c; font-weight: bold;">Alizarin</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #9b59b6; font-weight: bold;">Amethyst</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #335db6; font-weight: bold;">Bluejeans</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #e67e22; font-weight: bold;">Carrot</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #27ae60; font-weight: bold;">Emerald</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #e5a646; font-weight: bold;">Fallenleaf</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #90be5d; font-weight: bold;">Grass</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #48929b; font-weight: bold;">Herb</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #9a83d4; font-weight: bold;">Lavender</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #2980b9; font-weight: bold;">River</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #d479ac; font-weight: bold;">Rose</span></a></li>
									<li><a href="#notarget" data-cmd="theme-color-sel"><span class="text" style="color: #16a085; font-weight: bold;">Turquoise</span></a></li>
								</ul>
							</div>
						</div>
	                </div>
	                
   	                <label class="control-label" for="play-history-enabled">Playback history</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="play-history-enabled" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="play-history-enabled-yn"><span class="text">Yes</span></a></li>
									<li><a href="#notarget" data-cmd="play-history-enabled-yn"><span class="text">No</span></a></li>
								</ul>
							</div>
						</div>
						<a class="info-toggle" data-cmd="info-play-history" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-play-history" class="help-block hide">
	                    	Select Yes to log each song played to the playback history log.<br>
	                    	- Songs in the log can be clicked to launch a Google search.<br>
	                    	- The log can be cleared from the System configuration page.
	                    </span>
	                </div>
					
   	                <label class="control-label" for="playlist-display">Playlist display</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="playlist-display" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="playlist-display-yn"><span class="text">Yes</span></a></li>
									<li><a href="#notarget" data-cmd="playlist-display-yn"><span class="text">No</span></a></li>
								</ul>
							</div>
						</div>
						<a class="info-toggle" data-cmd="info-playlist-display" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-playlist-display" class="help-block hide">
	                    	Select No to turn off display of the Playlist.<br>
	                    	- useful for random play of a large collection<br>
	                    	- menu, refresh after changing this setting
	                    </span>
	                </div>
					
	            </div>
	    	</fieldset>

			<h4>Hardware volume control</h4>
	    	<fieldset>
				<div class="control-group">
   	                <label class="control-label" for="logarithmic-curve-enabled">Logarithmic curve</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select-mini"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="logarithmic-curve-enabled" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="logarithmic-curve-enabled-yn"><span class="text">Yes</span></a></li>
									<li><a href="#notarget" data-cmd="logarithmic-curve-enabled-yn"><span class="text">No</span></a></li>
								</ul>
							</div>
						</div>
						<a class="info-toggle" data-cmd="info-logarithmic-curve" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-logarithmic-curve" class="help-block hide">
	                    	Maps volume knob 0-100 range to the audio device hardware volume range using a logarithmic curve.
	                    </span>
	                </div>
					<!--
	                <label class="control-label" for="volume-curve-factor">Curve slope</label>
	                <div class="controls">
	                    <input id="volume-curve-factor" class="input-mini" style="height: 20px;" type="number" maxlength="2" min="1" max="99" name="volume_curve_factor" value="">
						<a class="info-toggle" data-cmd="info-curve-factor" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-curve-factor" class="help-block hide">
	                    	Adjusts the slope of the volume curve (56 is Standard slope).
	                    </span>
	                </div>
	                -->
	                
	                <label class="control-label" for="volume-curve-factor">Curve slope</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select bootstrap-select" style="width: 110px;"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="volume-curve-factor" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">Standard</span></a></li>
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">Less (-10)</span></a></li>
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">Less (-20)</span></a></li>
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">Less (-30)</span></a></li>
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">More (+06)</span></a></li>
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">More (+12)</span></a></li>
									<li><a href="#notarget" data-cmd="volume-curve-factor"><span class="text">More (+18)</span></a></li>
								</ul>
							</div>
						</div>
						<a class="info-toggle" data-cmd="info-curve-factor" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-curve-factor" class="help-block hide">
	                    	Adjusts the slope of the volume curve.<br>
	                    	- Less slope causes lower volume output in the 0 - 50 range.<br>
	                    	- More slope causes higher volume output in the 0 - 50 range.
	                    </span>
	                </div>

	                <label class="control-label" for="volume-max-percent">Maximum volume (%)</label>
	                <div class="controls">
	                    <input id="volume-max-percent" class="input-mini" style="height: 20px;" type="number" maxlength="3" min="1" max="100" name="volume_max_percent" value="">
						<a class="info-toggle" data-cmd="info-volume-max" href="#notarget"><i class="icon-info-sign"></i></a>
						<span id="info-volume-max" class="help-block hide">
	                    	Sets the maximum volume level output (100% is default).
	                    </span>
	                </div>

	            </div>
	    	</fieldset>
	    	
			<h4>Audio device description</h4>
	    	<fieldset>
		    	<!-- TC (Tim Curtis) 2015-03-21: add dropdown select for audio device -->
				<div class="control-group">
   	                <label class="control-label" for="audio-device-name">Device</label>
	                <div class="controls">
   						<div class="btn-group bootstrap-select" style="width: 265px;"> <!-- handler in player_lib.js -->
							<button type="button" class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">
								<div id="audio-device-name" class="filter-option pull-left">
									<span></span> <!-- selection from dropdown gets placed here -->
								</div>&nbsp;
								<div class="caret"></div>
							</button>
							<div class="dropdown-menu open">
								<ul class="dropdown-menu tcmods-select inner" role="menu">
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Arcam irDAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Audiobyte Black Dragon</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Audiophonics I-Sabre DAC ES9023 TCXO</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Audiophonics PCM5122 DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">AudioQuest DragonFly</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Aune s16</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Behringer UCA222</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Burson Conductor</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Chord 2Qute</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Chord Hugo</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Chord QuteHD</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">CM6631A USB to S/PDIF Converter</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Cyenne Audio CY-3100</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Cyenne Audio CY-3100SE</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Cyenne Audio CY-5100dsd MK-II</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Devialet</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Durio Sound PRO</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Emotiva Stealth DC-1</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">G2 Labs BerryNOS</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">G2 Labs BerryNOS Red</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">HiFiBerry Amp(Amp+)</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">HiFiBerry DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">HiFiBerry DAC+</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">HiFiBerry DAC+ Pro</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">HiFiBerry Digi(Digi+)</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Hifimediy ES9023</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">iFi Audio Micro iDsD</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">iFi Audio Nano iDsD</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">IQaudIO Pi-AMP+</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">IQaudIO Pi-DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">IQaudIO Pi-DAC+</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">IQaudIO Pi-DigiAMP+</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">JDS Labs Objective DAC (ODAC)</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">LH Labs Geek Out</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">LH Labs Geek Pulse X-Fi</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">LKS MH-DA003</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Mamboberry HiFi DAC+</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Lucid Labs Raspberry Pi DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Marantz HD DAC 1</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Matrix Mini-i Pro</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">NAD D 3020</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Nuforce HDP DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Perreaux Audiant 80i</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Pioneer U05</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">PlainDAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">PlainDAC+</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">RaspyPlay4</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">RME Fireface UCX</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Rockna Wavedream DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">RPi-DAC</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Schiit Modi 2</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">Soekris R2R</span></a></li>
									<li><a href="#notarget" data-cmd="audio-device-name-sel"><span class="text">TEAC UD-501</span></a></li>
								</ul>
							</div>
						</div>
	                </div>
					
	                <label class="control-label" for="audio-device-dac">Chip</label>
	                <div class="controls">
	                    <input id="audio-device-dac" class="input-xlarge" type="text" name="audio_device_dac" value="" readonly>
	                </div>
	                <label class="control-label" for="audio-device-arch">Architecture</label>
	                <div class="controls">
	                    <input id="audio-device-arch" class="input-xlarge" type="text" name="audio_device_arch" value="" readonly>
	                </div>
	                <label class="control-label" for="audio-device-iface">Interface</label>
	                <div class="controls">
	                    <input id="audio-device-iface" class="input-xlarge" type="text" name="audio_device_iface" value="" readonly>
	                </div>
	                <label class="control-label" for="audio-device-other">Other</label>
	                <div class="controls">
	                    <input id="audio-device-other" class="input-xlarge" type="text" name="audio_device_other" value="" readonly>
	                </div>
	            </div>
	    	</fieldset>
		</form>
		<!--div class="modal-action-btns hide">
			<button class="btn btn-tcmodsconf-update btn-primary" data-dismiss="modal">Update Settings</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		</div-->
	</div>
	<!-- TC (Tim Curtis) 2015-06-26: add first/last page btns -->
	<div class="modal-footer">
		<button class="btn cs-lastPage" style="float: right;"><i class="icon-double-angle-down"></i></button>
		<button class="btn cs-firstPage" style="float: right;"><i class="icon-double-angle-up"></i></button>

		<button class="btn btn-tcmodsconf-update btn-primary" data-dismiss="modal">Update</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<!-- VIEW PLAY HISTORY -->	
<!-- TC (Tim Curtis) 2015-05-30: initial version -->
<div id="playhistory-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="playhistory-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="playhistory-modal-label">Playback history</h3>
	</div>
	<div class="playhistory-search">
		<form id="ph-search" method="post" onSubmit="return false;">
			<div class="input-append" style="margin-bottom: 0;">
				<input id="ph-filter" type="text" value="" placeholder="search" data-placement="bottom" data-toggle="tooltip">
				<span id="ph-filter-results"></span>
				<button class="btn ph-firstPage"><i class="icon-double-angle-up"></i></button>
				<button class="btn ph-lastPage"><i class="icon-double-angle-down"></i></button>
			</div>
		</form>
	</div>
	<div class="modal-body" id="container-playhistory">
		<div id="playhistory">
			<ol class="playhistory"></ol>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>


<!-- VOLUME WARNING -->	
<!-- TC (Tim Curtis) 2015-01-27: initial version -->
<div id="volumewarning-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="volumewarning-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="volumewarning-modal-label">Volume warning</h3>
	</div>
	<div class="modal-body">
		<h4 id="volume-warning-text"></h4>
		<!-- TC (Tim Curtis) 2015-03-21: enable warning limit to be changed -->
		<div class="context-menu">
			<a href="#notarget" data-cmd="tcmodsconfedit" class="btn btn-primary btn-large btn-block" data-dismiss="modal">Change Warning Limit</a>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>

<!-- CONFIG SETTINGS LIST -->	
<!-- TC (Tim Curtis) 2015-06-26: initial version -->
<div id="configure-modal" class="modal modal-sm hide fade" tabindex="-1" role="dialog" aria-labelledby="configure-modal-label" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="configure-modal-label">Configuration settings</h3>
	</div>
	<div class="modal-body">
		<h4>Select one of the following configuration pages:</h4>
		<div style="margin-top: 20px; margin-left: 20px;">
			<div class="tcmods-config-settings-header"><a class="tcmods-config-settings-link" href="sources.php"><i class="icon-folder-open sx"></i>Sources</a></div>
			<span class="help-block">
				NAS and USB music sources, update MPD database.
            </span>
			<div class="tcmods-config-settings-header"><a class="tcmods-config-settings-link" href="mpd-config.php"><i class="icon-forward sx"></i>&nbsp;MPD</a></div>
			<span class="help-block">
				Volume control, resampling and volume normalization.
            </span>
			<div class="tcmods-config-settings-header"><a class="tcmods-config-settings-link" href="net-config.php"><i class="icon-sitemap sx"></i>Network</a></div>
			<span class="help-block">
				WiFi connection, DHCP and static IP address.
            </span>
			<div class="tcmods-config-settings-header"><a class="tcmods-config-settings-link" href="settings.php"><i class="icon-wrench sx"></i>System</a></div>
			<span class="help-block">
				I2S audio device, player name and timezone.
            </span>
		</div>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
	</div>
</div>

<!-- CONNECTING SCREEN -->
<div id="loader">
	<div id="loaderbg"></div>
	<div id="loadercontent"><i class="icon-refresh icon-spin"></i>connecting...</div>
</div>

<!-- JS SCRIPTS -->
<script src="js/jquery-1.8.2.min.js"></script>
<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/notify.js"></script>
<script src="js/jquery.countdown.js"></script>
<script src="js/jquery.countdown-it.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/player_lib.js"></script>

<!-- TC (Tim Curtis) 2014-11-30: modify config page (external) links so they stay within homescreen app on IOS -->
<script type="text/javascript" src="js/links.js"></script>

<?php if ($sezione == 'index') { ?>
	<script src="js/jquery.knob.js"></script>
	<script src="js/bootstrap-contextmenu.js"></script>
	<script src="js/jquery.pnotify.min.js"></script>
	<script src="js/scripts-playback.js"></script>
<?php } else { ?>
	<script src="js/custom_checkbox_and_radio.js"></script>
	<script src="js/custom_radio.js"></script>
	<script src="js/jquery.tagsinput.js"></script>
	<script src="js/jquery.placeholder.js"></script>
	<script src="js/parsley.min.js"></script>
	<script src="js/i18n/_messages.en.js" type="text/javascript"></script>
	<script src="js/application.js"></script>
	<script src="js/jquery.pnotify.min.js"></script>
	<script src="js/bootstrap-fileupload.js"></script>
	<script src="js/scripts-configuration.js"></script>
<?php } ?>

<!-- Write backend response on UI Notify popup -->
<?php
if (isset($_SESSION['notify']) && $_SESSION['notify'] != '') {
	sleep(1);
	ui_notify($_SESSION['notify']);
	session_start();
	$_SESSION['notify'] = '';
	session_write_close();
}
?>

<!-- Debug footer -->
<div id="debug" <?php if ($_SESSION['hiddendebug'] == 1 OR $_SESSION['debug'] == 0) {echo "class=\"hide\"";} ?>>
	<pre>
		<?php
		debug_footer($db);
		?>
	</pre>
</div>

</body>
</html>
