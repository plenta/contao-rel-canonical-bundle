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
use Contao\FaqModel;


/**
 * Class ModuleFaqReader
 * @package Barkowsky\RelCanonical
 */
class ModuleFaqReaderRelCannonical extends \Contao\ModuleFaqReader
{

    public function generate()
    {
        return parent::generate();
    }


    protected function compile()
    {
        global $objPage;

        // Get the current faq item
        $objFaqItem = FaqModel::findPublishedByParentAndIdOrAlias(Input::get('items'), $this->faq_categories);
        
        if ($objFaqItem === null) {
            parent::compile();
        }

        $objPage->canonicalType = $objFaqItem->canonicalType;
        $objPage->canonicalJumpTo = $objFaqItem->canonicalJumpTo;
        $objPage->canonicalWebsite = $objFaqItem->canonicalWebsite;

        if ($objFaqItem->canonicalType == 'self') {
            $objPage->canonicalType = 'external';
            $objPage->canonicalWebsite = Environment::get('url') . TL_PATH . '/' . Environment::get('request');
        }

        parent::compile();
    }
}
