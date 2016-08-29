<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013-2016
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


$GLOBALS['TL_HOOKS']['generatePage'][] = array('Barkowsky\RelCanonical\ClassRelCanonical', 'createRelCanonical');
