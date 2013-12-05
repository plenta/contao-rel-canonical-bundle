<?php

/**
* Rel Canonical
*
* @copyright Christian Barkowsky 2013-2014
* @package   contao-rel-canonical
* @author    Christian Barkowsky <http://christianbarkowsky.de>
* @license   LGPL
*/


/**
 * Table tl_calendar_events
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['config']['onload_callback'][] = array('tl_calendar_events_canonical', 'switchPalette');
$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace(";{publish_legend}", ";{rel_canonical_legend},canonicalType;{publish_legend}", $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['canonicalType'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalType'],
	'default'                 => 'donotset',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'       		 => array('donotset', 'internal', 'external', 'self'),
	'reference'               => &$GLOBALS['TL_LANG']['RelCanonical'],
	'eval'                    => array('submitOnChange'=>true),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['canonicalJumpTo'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalJumpTo'],
	'exclude'                 => true,
	'inputType'               => 'pageTree',
	'eval'                    => array('fieldType'=>'radio'),
	'sql'                     => "int(10) unsigned NOT NULL default '0'",
	'save_callback' => array
	(
		array('tl_calendar_events_canonical', 'checkJumpTo')
	)
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['canonicalWebsite'] = array
(
	'label' => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalWebsite'],
	'exclude' => true,
	'inputType' => 'text',
	'eval' => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
	'sql' => "varchar(255) NOT NULL default ''"
);


/**
 * Class tl_page_canonical
 */
class tl_calendar_events_canonical extends Backend
{
	public function switchPalette(DataContainer $dc)
	{
		if (!$dc->id)
        {
            return;
        }
	
		$objCanonicalPage = $this->Database->prepare("SELECT canonicalType FROM tl_calendar_events WHERE id=?")->limit(1)->execute($dc->id);
		
		if($objCanonicalPage->numRows > 0)
		{
			if($objCanonicalPage->numRows > 0)
			{
				switch($objCanonicalPage->canonicalType)
				{
					case 'internal':
						$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace("canonicalType;", "canonicalType,canonicalJumpTo;", $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']);
						break;
			
					case 'external':
						$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace("canonicalType;", "canonicalType,canonicalWebsite;", $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']);
						break;
			
					case 'donotset':
					default:
						$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = str_replace("canonicalType;", "canonicalType;", $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']);
						break;
				}
			}
		}
	}
	
	
	/**
	 * Prevent circular references
	 */
	public function checkJumpTo($varValue, DataContainer $dc)
	{
		if ($varValue == $dc->id)
		{
			throw new Exception($GLOBALS['TL_LANG']['ERR']['circularReference']);
		}

		return $varValue;
	}
}
