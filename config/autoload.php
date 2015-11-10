<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2015
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license   LGPL
 */


\Contao\ClassLoader::addNamespace('RelCanonical');


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Classes
    'Contao\ClassRelCanonical' => 'system/modules/rel-canonical/classes/ClassRelCanonical.php',

    // Modules
    'RelCanonical\ModuleEventReader' => 'system/modules/rel-canonical/modules/ModuleEventReaderRelCannonical.php',
    'RelCanonical\ModuleNewsReader' => 'system/modules/rel-canonical/modules/ModuleNewsReaderRelCannonical.php',
));
