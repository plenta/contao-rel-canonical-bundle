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
	public static function createRelCanonical($objPage, $objLayout, $objPageRegular)
	{
		if($objPage->canonicalType == 'internal')
		{
			ClassRelCanonical::setRelCanonical(ClassRelCanonical::generateLink($objPage), $objPage->outputFormat);
		}
		
		if($objPage->canonicalType == 'external')
		{
			ClassRelCanonical::setRelCanonical(ClassRelCanonical::canonicalWebsite, $objPage->outputFormat);
		}
		
		if($objPage->canonicalType == 'self')
		{
			global $objPage;
			$objPage->canonicalJumpTo = $objPage->id;
			ClassRelCanonical::setRelCanonical(ClassRelCanonical::generateLink($objPage), $objPage->outputFormat);
		}
	}
	
	
	public static function createRelCanonicalFromModule($objPage)
	{
		if($objPage->canonicalType == 'self')
		{
			ClassRelCanonical::setRelCanonical($objPage->canonicalWebsite, $objPage->outputFormat);
		}
		else
		{
			ClassRelCanonical::createRelCanonical($objPage, null, null);
		}
	}
	
	
	private static function generateLink($objPage)
	{
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

	
	protected static function setRelCanonical($canonicalUrl, $outputFormat)
	{
		$xhtmlOutput = '';
		
		if($outputFormat == 'xhtml')
		{
			$xhtmlOutput = ' /';
		}
		
		$GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="' . $canonicalUrl . '"'.$xhtmlOutput.'>';
	}
}
