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
$GLOBALS['TL_LANG']['tl_page']['canonicalType'] = array('rel="canonical" setzen', 'Für diese Seite im Seitenkopf rel="canonical" setzen.');
$GLOBALS['TL_LANG']['tl_page']['canonicalJumpTo'] = array('Interne Seite', 'Bitte wählen Sie eine Seite aus.');
$GLOBALS['TL_LANG']['tl_page']['canonicalWebsite'] = array('Externe Seite', 'Bitte geben Sie eine Web-Adresse (http://…) ein.');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_page']['rel_canonical_legend'] = 'Tag rel canonical';


/**
 * MISC
 */
$GLOBALS['TL_LANG']['RelCanonical']['donotset'] = 'Nicht setzen';
$GLOBALS['TL_LANG']['RelCanonical']['internal'] = 'Interne Seite';
$GLOBALS['TL_LANG']['RelCanonical']['external'] = 'Externe Seite';

?>
