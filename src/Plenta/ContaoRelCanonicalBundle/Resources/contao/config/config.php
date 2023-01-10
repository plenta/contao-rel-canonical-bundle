<?php

declare(strict_types=1);

/**
 * Rel Canonical for Contao Open Source CMS
 *
 * @copyright     Copyright (c) 2023, Plenta.io
 * @author        Plenta.io <https://plenta.io>
 * @link          https://github.com/plenta/
 */

use Contao\System;
use Plenta\ContaoRelCanonicalBundle\Classes\ClassRelCanonical;
use Plenta\ContaoRelCanonicalBundle\Modules\ModuleEventReaderRelCanonical;
use Plenta\ContaoRelCanonicalBundle\Modules\ModuleFaqReaderRelCanonical;
use Plenta\ContaoRelCanonicalBundle\Modules\ModuleNewsReaderRelCanonical;

// Hook
$GLOBALS['TL_HOOKS']['generatePage'][] = [ClassRelCanonical::class, 'createRelCanonical'];

$bundles = array_keys(System::getContainer()->getParameter('kernel.bundles'));

if (in_array('ContaoNewsBundle', $bundles, true)) {
    $GLOBALS['FE_MOD']['news']['newsreader'] = ModuleNewsReaderRelCanonical::class;
}

if (in_array('ContaoFaqBundle', $bundles, true)) {
    $GLOBALS['FE_MOD']['faq']['faqreader'] = ModuleFaqReaderRelCanonical::class;
}

if (in_array('ContaoCalendarBundle', $bundles, true)) {
    $GLOBALS['FE_MOD']['events']['eventreader'] = ModuleEventReaderRelCanonical::class;
}
