<?php

/**
 * Contao Open Source CMS
 *
 *
 * @package   rsm-googlerecaptcha-modul
 * @author    Waldemar Schern <schern@werbeagentur-rsm.de>
 * @license   MIT
 * @copyright © 2018 Werbeagentur RSM. kommunikations-marketing GmbH | Nürnberg
 */


/**
 * Table tl_page
 */
use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('rsm_google_recaptcha_legend', 'layout_legend', PaletteManipulator::POSITION_BEFORE)
    ->addField('rsm_public_key', 'rsm_google_recaptcha_legend', PaletteManipulator::POSITION_APPEND)
    ->addField('rsm_private_key', 'rsm_google_recaptcha_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('root', 'tl_page')
;

if($GLOBALS['TL_DCA']['tl_page']['palettes']['rootfallback']) {
    PaletteManipulator::create()
        ->addLegend('rsm_google_recaptcha_legend', 'layout_legend', PaletteManipulator::POSITION_BEFORE)
        ->addField('rsm_public_key', 'rsm_google_recaptcha_legend', PaletteManipulator::POSITION_APPEND)
        ->addField('rsm_private_key', 'rsm_google_recaptcha_legend', PaletteManipulator::POSITION_APPEND)
        ->applyToPalette('rootfallback', 'tl_page')
    ;
}

$GLOBALS['TL_DCA']['tl_page']['fields']['rsm_public_key'] = array(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['rsm_public_key'],
    'inputType'     => 'text',
    'sql'           => "varchar(255) NOT NULL default ''",
    'eval'			=> array('tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_page']['fields']['rsm_private_key'] = array(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['rsm_private_key'],
    'inputType'     => 'text',
    'sql'           => "varchar(255) NOT NULL default ''",
    'eval'			=> array('tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_page']['fields']['rsm_google_recaptcha_legend'] = array(
    'label'         => &$GLOBALS['TL_LANG']['tl_page']['rsm_google_recaptcha_legend'],
    'inputType'     => 'label',
);
