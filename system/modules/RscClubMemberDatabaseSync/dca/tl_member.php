<?php

$GLOBALS['TL_DCA']['tl_member']['list']['global_operations']['sync_database'] = array(
	'label'				=> array("DB sync", "Datenbank synchronisieren"),
	'href'				=> 'key=sync_database',
	'class'				=> 'sync_database header_sync_all',
	'attributes'		=> 'onclick="Backend.getScrollOffset();"',
);
?>