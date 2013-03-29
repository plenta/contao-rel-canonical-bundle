<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


class ClassRelCanonical extends Frontend
{
	public function createRelCanonical(Database_Result $objPage, Database_Result $objLayout, PageRegular $objPageRegular)
	{
		if($objPage->addCanonical)
		{
			if($objPage->canonicalType == 'internal')
			{
				$canonicalUrl = $this->generateLink($objPage);
			}
			else
			{
				$canonicalUrl = $objPage->canonicalWebsite;
			}
			
			$xhtmlOutput = '';
			
			if($objPage->outputFormat == 'xhtml')
			{
				$xhtmlOutput = ' /';
			}
			
			$GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="' . $canonicalUrl . '"'.$xhtmlOutput.'>';
		}
	}
	
	
	private function generateLink($objPage)
	{
		$strDomain = $this->Environment->base;

		if ($objPage->domain != '')
		{
			$strDomain = ($this->Environment->ssl ? 'https://' : 'http://') . $objPage->domain . TL_PATH . '/';
		}
		
		$strUrl = $strDomain . $this->generateFrontendUrl($objPage->row(), null, $objPage->language);
		
		return $strUrl;
	}
}

?>