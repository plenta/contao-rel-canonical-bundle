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

use Contao\Input;
use Contao\ModuleNewsReader;
use Contao\NewsModel;
use Contao\System;

class ModuleNewsReaderRelCanonical extends ModuleNewsReader
{
    public function generate()
    {
        return parent::generate();
    }

    protected function compile(): void
    {
        global $objPage;

        $objNewsItem = NewsModel::findPublishedByParentAndIdOrAlias(Input::get('items'), $this->news_archives);

        if (null === $objNewsItem) {
            parent::compile();
        }

        $objPage->canonicalType = $objNewsItem->canonicalType;
        $objPage->canonicalJumpTo = $objNewsItem->canonicalJumpTo;
        $objPage->canonicalWebsite = $objNewsItem->canonicalWebsite;

        if ('self' == $objNewsItem->canonicalType) {
            $objPage->canonicalType = 'rc_external';

            $request = System::getContainer()->get('request_stack')->getCurrentRequest();
            $objPage->canonicalWebsite = $request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo();
        }

        parent::compile();
    }
}
