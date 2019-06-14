<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2019
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <https://brkwsky.de>
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
    'Barkowsky\RelCanonical\ModuleEventReaderRelCannonical' => 'system/modules/rel-canonical/modules/ModuleEventReaderRelCannonical.php',
    'Barkowsky\RelCanonical\ModuleNewsReaderRelCannonical' => 'system/modules/rel-canonical/modules/ModuleNewsReaderRelCannonical.php',
    'Barkowsky\RelCanonical\ModuleFaqReaderRelCannonical' => 'system/modules/rel-canonical/modules/ModuleFaqReaderRelCannonical.php',
));
