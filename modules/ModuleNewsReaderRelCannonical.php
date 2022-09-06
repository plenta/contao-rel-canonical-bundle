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
use Contao\NewsModel;
use Contao\ModuleNewsReader;

class ModuleNewsReaderRelCannonical extends ModuleNewsReader
{
    public function generate()
    {
        return parent::generate();
    }

    protected function compile()
    {
        global $objPage;

        $objNewsItem = NewsModel::findPublishedByParentAndIdOrAlias(Input::get('items'), $this->news_archives);
        
        if ($objNewsItem === null) {
            parent::compile();
        }

        $objPage->canonicalType = $objNewsItem->canonicalType;
        $objPage->canonicalJumpTo = $objNewsItem->canonicalJumpTo;
        $objPage->canonicalWebsite = $objNewsItem->canonicalWebsite;

        if ($objNewsItem->canonicalType == 'self') {
            $objPage->canonicalType = 'external';

            $request = System::getContainer()->get('request_stack')->getCurrentRequest();
            $objPage->canonicalWebsite = $request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo();
        }

        parent::compile();
    }
}
