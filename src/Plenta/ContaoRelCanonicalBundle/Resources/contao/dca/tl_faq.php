<?php

declare(strict_types=1);

/**
 * Rel Canonical for Contao Open Source CMS
 *
 * @copyright     Copyright (c) 2023, Plenta.io
 * @author        Plenta.io <https://plenta.io>
 * @link          https://github.com/plenta/
 */

/*
 * Table tl_faq
 */

use Contao\CoreBundle\DataContainer\PaletteManipulator;

$bundles = array_keys(System::getContainer()->getParameter('kernel.bundles'));

if (in_array('ContaoFaqBundle', $bundles, true)) {
    $GLOBALS['TL_DCA']['tl_faq']['palettes']['__selector__'][] = 'canonicalType';
    $GLOBALS['TL_DCA']['tl_faq']['subpalettes']['canonicalType_rc_internal'] = 'canonicalJumpTo';
    $GLOBALS['TL_DCA']['tl_faq']['subpalettes']['canonicalType_rc_external'] = 'canonicalWebsite';

    /*
     * Fields
     */
    $GLOBALS['TL_DCA']['tl_faq']['fields']['canonicalType'] = [
        'label' => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalType'],
        'default' => 'donotset',
        'exclude' => true,
        'inputType' => 'select',
        'options' => ['donotset', 'rc_internal', 'rc_external', 'self'],
        'reference' => &$GLOBALS['TL_LANG']['RelCanonical'],
        'eval' => ['submitOnChange' => true],
        'sql' => "varchar(32) NOT NULL default ''",
    ];

    $GLOBALS['TL_DCA']['tl_faq']['fields']['canonicalJumpTo'] = [
        'label' => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalJumpTo'],
        'exclude' => true,
        'inputType' => 'pageTree',
        'eval' => ['fieldType' => 'radio'],
        'sql' => "int(10) unsigned NOT NULL default '0'",
        'save_callback' => [
            ['tl_faq_canonical', 'checkJumpTo'],
        ],
    ];

    $GLOBALS['TL_DCA']['tl_faq']['fields']['canonicalWebsite'] = [
        'label' => &$GLOBALS['TL_LANG']['RelCanonical']['canonicalWebsite'],
        'exclude' => true,
        'inputType' => 'text',
        'eval' => ['rgxp' => 'url', 'decodeEntities' => true, 'maxlength' => 255, 'tl_class' => 'long'],
        'sql' => "varchar(255) NOT NULL default ''",
    ];

    PaletteManipulator::create()
        ->addLegend('rel_canonical_legend', 'publish_legend', PaletteManipulator::POSITION_BEFORE)
        ->addField('canonicalType', 'rel_canonical_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('default', 'tl_faq');
}

/**
 * Class tl_faq_canonical.
 */
class tl_faq_canonical extends Backend
{
    /**
     * Prevent circular references.
     *
     * @param mixed $varValue
     */
    public function checkJumpTo($varValue, DataContainer $dc)
    {
        if ($varValue == $dc->id) {
            throw new Exception($GLOBALS['TL_LANG']['ERR']['circularReference']);
        }

        return $varValue;
    }
}
