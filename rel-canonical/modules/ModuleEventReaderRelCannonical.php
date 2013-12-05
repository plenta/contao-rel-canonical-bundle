<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013-2014
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace RelCanonical;


class ModuleEventReader extends \Contao\ModuleEventReader
{

	public function generate()
	{
		return parent::generate();
	}
	
	
	protected function compile()
	{
		global $objPage;
	
		// Get the current event
		$objEvent = \CalendarEventsModel::findPublishedByParentAndIdOrAlias(\Input::get('events'), $this->cal_calendar);

		if ($objEvent === null)
		{
			// Do not index or cache the page
			$objPage->noSearch = 1;
			$objPage->cache = 0;

			// Send a 404 header
			header('HTTP/1.1 404 Not Found');
			$this->Template->event = '<p class="error">' . sprintf($GLOBALS['TL_LANG']['MSC']['invalidPage'], \Input::get('events')) . '</p>';
			return;
		}
		
		$objPage->canonicalType = $objEvent->canonicalType;
		$objPage->canonicalJumpTo = $objEvent->canonicalJumpTo;
		$objPage->canonicalWebsite = $objEvent->canonicalWebsite;
		
		if($objEvent->canonicalType == 'self')
		{
			$objPage->canonicalWebsite = \Environment::get('request');
		}
		
		print \Environment::get('path');
		
		\ClassRelCanonical::createRelCanonicalFromModule($objPage, null, null);
	
		parent::compile();	
	}
}
