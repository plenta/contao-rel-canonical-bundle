<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013-2014
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


$GLOBALS['TL_HOOKS']['generatePage'][] = array('ClassRelCanonical', 'generatePage');
$GLOBALS['TL_HOOKS']['parseTemplate'][] = array('ClassRelCanonical', 'parseTemplate');
