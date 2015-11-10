<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2015
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license   LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace RelCanonical;


class ModuleNewsReader extends \Contao\ModuleNewsReader
{

    public function generate()
    {
        return parent::generate();
    }


    protected function compile()
    {
        global $objPage;

        // Get the current news item
        $objNewsItem = \NewsModel::findPublishedByParentAndIdOrAlias(\Input::get('items'), $this->news_archives);
        
        if ($objNewsItem === null) {
            parent::compile();
        }

        $objPage->canonicalType = $objNewsItem->canonicalType;
        $objPage->canonicalJumpTo = $objNewsItem->canonicalJumpTo;
        $objPage->canonicalWebsite = $objNewsItem->canonicalWebsite;

        if ($objNewsItem->canonicalType == 'self') {
            $objPage->canonicalType = 'external';
            $objPage->canonicalWebsite = \Environment::get('url') . TL_PATH . '/' . \Environment::get('request');
        }

        parent::compile();
    }
}
