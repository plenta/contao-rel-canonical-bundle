<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://www.christianbarkowsky.de>
* @license   LGPL
*/


namespace Contao;


class ClassCanonical extends \Frontend
{
	public function createCanonical(Database_Result $objPage, Database_Result $objLayout, PageRegular $objPageRegular)
	{
		$GLOBALS['TL_HEAD'][] = '<link rel="canonical" href="http://www.example.com"/>';
	}
}
