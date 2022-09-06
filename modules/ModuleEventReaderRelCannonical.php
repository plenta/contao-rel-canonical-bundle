<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2022
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <https://plenta.io>
 * @license   LGPL
 */

namespace Barkowsky\RelCanonical;

use Contao\Input;
use Contao\System;
use Contao\ModuleEventReader;
use Contao\CalendarEventsModel;

class ModuleEventReaderRelCannonical extends ModuleEventReader
{
    public function generate()
    {
        return parent::generate();
    }

    protected function compile()
    {
        global $objPage;

        $objEvent = CalendarEventsModel::findPublishedByParentAndIdOrAlias(Input::get('events'), $this->cal_calendar);

        if ($objEvent === null) {
            parent::compile();
        }

        $objPage->canonicalType = $objEvent->canonicalType;
        $objPage->canonicalJumpTo = $objEvent->canonicalJumpTo;
        $objPage->canonicalWebsite = $objEvent->canonicalWebsite;

        if ($objEvent->canonicalType == 'self') {
            $objPage->canonicalType = 'external';

            $request = System::getContainer()->get('request_stack')->getCurrentRequest();
            $objPage->canonicalWebsite = $request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo();
        }

        parent::compile();
    }
}
