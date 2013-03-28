<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


/**
 * Table tl_page
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'addCanonical';
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace("{protected_legend:hide},", "{rel_canonical_legend},addCanonical;{protected_legend:hide},", $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['addCanonical'] = 'canonicalType,canonicalJumpTo,canonicalWebsite';


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['addCanonical'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['addCanonical'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'eval'                    => array('submitOnChange'=>true, 'tl_class'=>'w50 m12')
);

$GLOBALS['TL_DCA']['tl_page']['fields']['canonicalType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['canonicalType'],
	'default'                 => 'internal',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'       		 => array('internal', 'external'),
	'reference'               => &$GLOBALS['TL_LANG']['PTY'],
	'eval'                    => array('tl_class'=>'w50')
);

$GLOBALS['TL_DCA']['tl_page']['fields']['canonicalJumpTo'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_page']['canonicalJumpTo'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array('fieldType'=>'radio'),
	'save_callback' => array
	(
		array('tl_page', 'checkJumpTo')
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['canonicalWebsite'] = array
(
	'label' => &$GLOBALS['TL_LANG']['tl_page']['canonicalWebsite'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => array('rgxp'=>'url', 'maxlength'=>255, 'tl_class'=>'long')
);

?>