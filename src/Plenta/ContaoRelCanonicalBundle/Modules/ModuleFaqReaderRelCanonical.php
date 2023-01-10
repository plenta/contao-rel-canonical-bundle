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

use Contao\FaqModel;
use Contao\Input;
use Contao\System;

class ModuleFaqReaderRelCanonical extends \Contao\ModuleFaqReader
{
    public function generate()
    {
        return parent::generate();
    }

    protected function compile(): void
    {
        global $objPage;

        $objFaqItem = FaqModel::findPublishedByParentAndIdOrAlias(Input::get('items'), $this->faq_categories);

        if (null === $objFaqItem) {
            parent::compile();
        }

        $objPage->canonicalType = $objFaqItem->canonicalType;
        $objPage->canonicalJumpTo = $objFaqItem->canonicalJumpTo;
        $objPage->canonicalWebsite = $objFaqItem->canonicalWebsite;

        if ('self' == $objFaqItem->canonicalType) {
            $objPage->canonicalType = 'rc_external';

            $request = System::getContainer()->get('request_stack')->getCurrentRequest();
            $objPage->canonicalWebsite = $request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo();
        }

        parent::compile();
    }
}
