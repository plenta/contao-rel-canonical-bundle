<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2019
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <https://brkwsky.de>
 * @license   LGPL
 */

namespace Barkowsky\RelCanonical;

use Contao\Environment;
use Contao\Input;
use Contao\ModuleEventReader;
use Contao\CalendarEventsModel;

/**
 * Class ModuleEventReader
 * @package Barkowsky\RelCanonical
 */
class ModuleEventReaderRelCannonical extends ModuleEventReader
{

    public function generate()
    {
        return parent::generate();
    }


    protected function compile()
    {
        global $objPage;

        // Get the current event
        $objEvent = CalendarEventsModel::findPublishedByParentAndIdOrAlias(Input::get('events'), $this->cal_calendar);

        if ($objEvent === null) {
            parent::compile();
        }

        $objPage->canonicalType = $objEvent->canonicalType;
        $objPage->canonicalJumpTo = $objEvent->canonicalJumpTo;
        $objPage->canonicalWebsite = $objEvent->canonicalWebsite;

        if ($objEvent->canonicalType == 'self') {
            $objPage->canonicalType = 'external';
            $objPage->canonicalWebsite = Environment::get('url') . TL_PATH . '/' . Environment::get('request');
        }

        parent::compile();
    }
}
