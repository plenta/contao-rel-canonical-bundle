<?php

declare(strict_types=1);

/**
 * Rel Canonical for Contao Open Source CMS
 *
 * @copyright     Copyright (c) 2023, Plenta.io
 * @author        Plenta.io <https://plenta.io>
 * @link          https://github.com/plenta/
 */

namespace Plenta\ContaoRelCanonicalBundle\Classes;

use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
use Contao\Frontend;
use Contao\PageModel;
use Contao\System;

/**
 * Class ClassRelCanonical.
 */
class ClassRelCanonical extends Frontend
{
    /**
     * Create the canonical.
     *
     * @param $objPage
     * @param $objLayout
     * @param $objPageRegular
     */
    public static function createRelCanonical($objPage, $objLayout, $objPageRegular): void
    {
        global $objPage;
        $objPage->enableCanonical = 1;

        if ('self' == $objPage->canonicalType) {
            $objPage->canonicalJumpTo = $objPage->id;
        } elseif ('donotset' === $objPage->canonicalType || !$objPage->canonicalType) {
            $objPage->enableCanonical = 0;
        }

        $canonicalUrl = match ($objPage->canonicalType) {
            'rc_internal', 'self' => self::generateLink($objPage),
            'rc_external' => $objPage->canonicalWebsite,
            default => ''
        };

        $responseContext = System::getContainer()->get('contao.routing.response_context_accessor')->getResponseContext();

        if ($responseContext && $responseContext->has(HtmlHeadBag::class))
        {
            /** @var HtmlHeadBag $htmlHeadBag */
            $htmlHeadBag = $responseContext->get(HtmlHeadBag::class);
            $htmlHeadBag->setCanonicalUri($canonicalUrl);
        }
    }

    /**
     * Generate the canonical link.
     *
     * @param $objPage
     *
     * @return string
     */
    private static function generateLink($objPage)
    {
        $strUrl = '';

        $objCanonicalPage = PageModel::findWithDetails($objPage->canonicalJumpTo);

        if (null !== $objCanonicalPage) {
            $strUrl = $objCanonicalPage->getAbsoluteUrl();
        }

        return $strUrl;
    }
}
