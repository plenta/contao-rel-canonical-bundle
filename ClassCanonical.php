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
			print 'dfsfsdf';
		}
	
		
	
		$GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="http://www.example.com"/>';
	}
}
