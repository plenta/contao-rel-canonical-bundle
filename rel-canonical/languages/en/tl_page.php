<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>, Jan Theofel <jan@theofel.de>
* @license   LGPL
*/


/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_page']['canonicalType'] = array('Use rel="canonical"', 'Add rel="canonical" for this page in head section.');
$GLOBALS['TL_LANG']['tl_page']['canonicalJumpTo'] = array('Internal page', 'Choose a page');
$GLOBALS['TL_LANG']['tl_page']['canonicalWebsite'] = array('External page', 'Enter a complete URL (including http://…).');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_page']['rel_canonical_legend'] = 'Tag rel canonical';


/**
 * MISC
 */
$GLOBALS['TL_LANG']['RelCanonical']['donotset'] = 'do not use';
$GLOBALS['TL_LANG']['RelCanonical']['internal'] = 'internal';
$GLOBALS['TL_LANG']['RelCanonical']['external'] = 'external';

?>
