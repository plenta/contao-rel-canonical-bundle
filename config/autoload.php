<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2016
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license   LGPL
 */


\Contao\ClassLoader::addNamespace('Barkowsky\RelCanonical');


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Classes
    'Barkowsky\RelCanonical\ClassRelCanonical' => 'system/modules/rel-canonical/classes/ClassRelCanonical.php',

    // Modules
    'Barkowsky\RelCanonical\ModuleEventReader' => 'system/modules/rel-canonical/modules/ModuleEventReaderRelCannonical.php',
    'Barkowsky\RelCanonical\ModuleNewsReader' => 'system/modules/rel-canonical/modules/ModuleNewsReaderRelCannonical.php',
));
