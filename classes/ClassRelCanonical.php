<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2015
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <http://www.christianbarkowsky.de>
 * @license   LGPL
 */


namespace Contao;


class ClassRelCanonical extends \Frontend
{

    /**
     * Create the canonical
     *
     * @param $objPage
     * @param $objLayout
     * @param $objPageRegular
     */
    public static function createRelCanonical($objPage, $objLayout, $objPageRegular)
    {
        if ($objPage->canonicalType == 'internal') {
            ClassRelCanonical::setRelCanonical(ClassRelCanonical::generateLink($objPage), $objPage->outputFormat);
        }

        if ($objPage->canonicalType == 'external') {
            ClassRelCanonical::setRelCanonical($objPage->canonicalWebsite, $objPage->outputFormat);
        }

        if ($objPage->canonicalType == 'self') {
            global $objPage;
            $objPage->canonicalJumpTo = $objPage->id;
            ClassRelCanonical::setRelCanonical(ClassRelCanonical::generateLink($objPage), $objPage->outputFormat);
        }
    }


    /**
     * Generate the canonical link
     *
     * @param $objPage
     * @return string
     */
    private static function generateLink($objPage)
    {
        $strUrl = '';

        $strDomain = \Environment::get('base');

        $objCanonicalPage = \Controller::getPageDetails($objPage->canonicalJumpTo);

        if ($objCanonicalPage !== null) {
            if ($objCanonicalPage->domain != '') {
                $strDomain = (\Environment::get('ssl') ? 'https://' : 'http://') . $objCanonicalPage->domain . TL_PATH . '/';
            }

            $strUrl = $strDomain . \Controller::generateFrontendUrl($objCanonicalPage->row(), null, $objCanonicalPage->language);
        }

        return $strUrl;
    }


    /**
     * Add the canonical to the page header
     *
     * @param $canonicalUrl
     * @param $outputFormat
     */
    protected static function setRelCanonical($canonicalUrl, $outputFormat)
    {
        $xhtmlOutput = '';

        if ($outputFormat == 'xhtml') {
            $xhtmlOutput = ' /';
        }

        $GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="' . $canonicalUrl . '"'.$xhtmlOutput.'>';
    }
}