<?php 
if (!defined ('TYPO3_MODE')) die ('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qbus.' . $_EXTKEY,
	'mailformwrapper',
	array("Mailform" => 'show')
);

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['Tx_Dce_Controller_DceController'] = array(
    'className' => 'Qbus\\Qbtools\\Xclass\\DceController',
);