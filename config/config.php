<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2019
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <https://brkwsky.de>
 * @license   LGPL
 */

// Hook
$GLOBALS['TL_HOOKS']['generatePage'][] = ['Barkowsky\RelCanonical\ClassRelCanonical', 'createRelCanonical'];

// Front end modules
$activeModules = \Contao\ModuleLoader::getActive();

if (in_array('news', $activeModules, true)) {
    $GLOBALS['FE_MOD']['news']['newsreader'] = 'Barkowsky\RelCanonical\ModuleNewsReaderRelCannonical';
}

if (in_array('faq', $activeModules, true)) {
    $GLOBALS['FE_MOD']['faq']['faqreader'] = 'Barkowsky\RelCanonical\ModuleFaqReaderRelCannonical';
}

if (in_array('calendar', $activeModules, true)) {
    $GLOBALS['FE_MOD']['events']['eventreader'] = 'Barkowsky\RelCanonical\ModuleEventReaderRelCannonical';
}
