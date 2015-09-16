<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013-2014
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


namespace Contao;


class ClassRelCanonical extends \Frontend
{

	/**
	 * create the canonical
	 *
	 * @param \PageModel   $objPage
	 * @param \LayoutModel $objLayout
	 * @param \PageModel   $objPageRegular
	 */
	public static function generatePage($objPage, $objLayout, $objPageRegular)
	{
		self::createRelCanonical($objPage);
	}

	/**
	 * add the canonical to the fe_ template
	 *
	 * @param \FrontendTemplate $objTemplate
	 */
	public static function parseTemplate($objTemplate)
	{
		if (strpos("fe_", $objTemplate->getName()) == 0 && $GLOBALS['TL_CONFIG']['addCanonicalToTemplate'] == true)
		{
			global $objPage;

			$objTemplate->canonicalType = $objPage->canonicalType;
			$objTemplate->canonicalUrl = $objPage->canonicalUrl;
		}

	}

	/**
	 * create the canonical
	 *
	 * @param \PageModel $objPage
	 */
	public static function createRelCanonical($objPage)
	{
		if($objPage->canonicalType == 'internal')
		{
			$objPage->canonicalUrl = ClassRelCanonical::generateLink($objPage);
			ClassRelCanonical::setRelCanonical($objPage->canonicalUrl, $objPage->outputFormat);
		}
		
		if($objPage->canonicalType == 'external')
		{
			$objPage->canonicalUrl = $objPage->canonicalWebsite;
			ClassRelCanonical::setRelCanonical($objPage->canonicalWebsite, $objPage->outputFormat);
		}
		
		if($objPage->canonicalType == 'self')
		{
			$objPage->canonicalJumpTo = $objPage->id;
			$objPage->canonicalUrl = ClassRelCanonical::generateLink($objPage);
			ClassRelCanonical::setRelCanonical($objPage->canonicalUrl, $objPage->outputFormat);
		}
	}

	/**
	 * generate the canonical link
	 *
	 * @param \PageModel $objPage
	 *
	 * @return string
	 */
	private static function generateLink($objPage)
	{
		$strUrl = "";

		$strDomain = \Environment::get('base');

		$objCanonicalPage = \Controller::getPageDetails($objPage->canonicalJumpTo);

		if ($objCanonicalPage !== null)
		{
			if ($objCanonicalPage->domain != '')
			{
				$strDomain = (\Environment::get('ssl') ? 'https://' : 'http://') . $objCanonicalPage->domain . TL_PATH . '/';
			}
		
			$strUrl = $strDomain . \Controller::generateFrontendUrl($objCanonicalPage->row(), null, $objCanonicalPage->language);
		}
		
		return $strUrl;
	}

	/**
	 * add the canonical to the page header
	 *
	 * @param string $canonicalUrl
	 * @param string $outputFormat
	 */
	protected static function setRelCanonical($canonicalUrl, $outputFormat)
	{
		// if addCanonicalToTemplate is true, do not add the canonical automatically to the head.
		if ($GLOBALS['TL_CONFIG']['addCanonicalToTemplate'] == true)
		{
			return;
		}
		$xhtmlOutput = '';
		
		if($outputFormat == 'xhtml')
		{
			$xhtmlOutput = ' /';
		}
		
		$GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="' . $canonicalUrl . '"'.$xhtmlOutput.'>';
	}
}
