<?php

/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{oldDatabase_legend},oldDbHost,oldDbUser,oldDbPass,oldDbDatabase,oldDbPort;';

/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['oldDbHost'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['oldDbHost'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['oldDbUser'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['oldDbUser'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'clr w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['oldDbPass'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['oldDbPass'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>false /* could be empty */, 'decodeEntities'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['oldDbDatabase'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['oldDbDatabase'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['oldDbPort'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_settings']['oldDbPort'],
	'inputType'               => 'text',
	'eval'                    => array('mandatory'=>true, 'tl_class'=>'w50')
);

?>