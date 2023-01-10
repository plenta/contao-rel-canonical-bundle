<?php

declare(strict_types=1);

/**
 * Rel Canonical for Contao Open Source CMS
 *
 * @copyright     Copyright (c) 2023, Plenta.io
 * @author        Plenta.io <https://plenta.io>
 * @link          https://github.com/plenta/
 */

namespace Plenta\ContaoRelCanonicalBundle\Modules;

use Contao\CalendarEventsModel;
use Contao\Input;
use Contao\ModuleEventReader;
use Contao\System;

class ModuleEventReaderRelCanonical extends ModuleEventReader
{
    public function generate()
    {
        return parent::generate();
    }

    protected function compile(): void
    {
        global $objPage;

        $objEvent = CalendarEventsModel::findPublishedByParentAndIdOrAlias(Input::get('events'), $this->cal_calendar);

        if (null === $objEvent) {
            parent::compile();
        }

        $objPage->canonicalType = $objEvent->canonicalType;
        $objPage->canonicalJumpTo = $objEvent->canonicalJumpTo;
        $objPage->canonicalWebsite = $objEvent->canonicalWebsite;

        if ('self' == $objEvent->canonicalType) {
            $objPage->canonicalType = 'rc_external';

            $request = System::getContainer()->get('request_stack')->getCurrentRequest();
            $objPage->canonicalWebsite = $request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo();
        }

        parent::compile();
    }
}
