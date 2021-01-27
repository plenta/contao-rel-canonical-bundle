<?php

/**
 * Rel Canonical
 *
 * @copyright Christian Barkowsky 2013-2019
 * @package   contao-rel-canonical
 * @author    Christian Barkowsky <https://brkwsky.de>
 * @license   LGPL
 */

/**
 * Table tl_news
 */
$GLOBALS['TL_DCA']['tl_news']['config']['onload_callback'][] = array('tl_news_canonical', 'switchPalette');
$GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace(";{publish_legend}", ";{rel_canonical_legend},canonicalType;{publish_legend}", $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_news']['fields']['canonicalType'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalType'],
    'default'                 => 'donotset',
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => array('donotset', 'internal', 'external', 'self'),
    'reference'               => &$GLOBALS['TL_LANG']['RelCanonical'],
    'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "varchar(32) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_news']['fields']['canonicalJumpTo'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalJumpTo'],
    'exclude'                 => true,
    'inputType'               => 'pageTree',
    'eval'                    => array('fieldType'=>'radio'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'",
    'save_callback' => array
    (
        array('tl_news_canonical', 'checkJumpTo')
    )
);

$GLOBALS['TL_DCA']['tl_news']['fields']['canonicalWebsite'] = array
(
    'label'                 => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalWebsite'],
    'exclude'               => true,
    'inputType'             => 'text',
    'eval'                  => array('rgxp'=>'url', 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
    'sql'                   => "varchar(255) NOT NULL default ''"
);


/**
 * Class tl_page_canonical
 */
class tl_news_canonical extends Backend
{
    public function switchPalette(DataContainer $dc = null)
    {
        if ($dc === null || !$dc->id) {
            return;
        }

        $objCanonicalPage = $this->Database->prepare("SELECT canonicalType FROM tl_news WHERE id=?")->limit(1)->execute($dc->id);

        if ($objCanonicalPage->numRows > 0) {
            if ($objCanonicalPage->numRows > 0) {
                switch ($objCanonicalPage->canonicalType) {
                    case 'internal':
                        $GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace("canonicalType;", "canonicalType,canonicalJumpTo;", $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
                        break;

                    case 'external':
                        $GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace("canonicalType;", "canonicalType,canonicalWebsite;", $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
                        break;

                    case 'donotset':
                    default:
                        $GLOBALS['TL_DCA']['tl_news']['palettes']['default'] = str_replace("canonicalType;", "canonicalType;", $GLOBALS['TL_DCA']['tl_news']['palettes']['default']);
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
        if ($varValue == $dc->id) {
            throw new Exception($GLOBALS['TL_LANG']['ERR']['circularReference']);
        }

        return $varValue;
    }
}
