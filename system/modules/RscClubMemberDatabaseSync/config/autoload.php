<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @package RscClubMemberDatabaseSync
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'RSC',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'RSC\RscClubMemberDatabaseSyncronizer' => 'system/modules/RscClubMemberDatabaseSync/classes/RscClubMemberDatabaseSyncronizer.php',
));
