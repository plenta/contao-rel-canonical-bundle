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
use Contao\FaqModel;

class ModuleFaqReaderRelCannonical extends \Contao\ModuleFaqReader
{
    public function generate()
    {
        return parent::generate();
    }

    protected function compile()
    {
        global $objPage;

        $objFaqItem = FaqModel::findPublishedByParentAndIdOrAlias(Input::get('items'), $this->faq_categories);
        
        if ($objFaqItem === null) {
            parent::compile();
        }

        $objPage->canonicalType = $objFaqItem->canonicalType;
        $objPage->canonicalJumpTo = $objFaqItem->canonicalJumpTo;
        $objPage->canonicalWebsite = $objFaqItem->canonicalWebsite;

        if ($objFaqItem->canonicalType == 'self') {
            $objPage->canonicalType = 'external';

            $request = System::getContainer()->get('request_stack')->getCurrentRequest();
            $objPage->canonicalWebsite = $request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo();
        }

        parent::compile();
    }
}
