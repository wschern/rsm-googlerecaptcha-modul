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
// $GLOBALS['TL_DCA']['tl_page']['palettes']['root'] = str_replace(';{layout_legend', ';{rsm_google_recaptcha_legend:hide},rsm_public_key,rsm_private_key;{layout_legend', $GLOBALS['TL_DCA']['tl_page']['palettes']['root']);

use Contao\CoreBundle\DataContainer\PaletteManipulator;

PaletteManipulator::create()
    ->addLegend('rsm_google_recaptcha_legend', '')
    ->addField('rsm_public_key', 'rsm_google_recaptcha_legend')
    ->addField('rsm_private_key', 'rsm_google_recaptcha_legend')
    ->applyToPalette('rootfallback', 'tl_page')
;

PaletteManipulator::create()
    ->addLegend('rsm_google_recaptcha_legend', '')
    ->addField('rsm_public_key', 'rsm_google_recaptcha_legend')
    ->addField('rsm_private_key', 'rsm_google_recaptcha_legend')
    ->applyToPalette('root', 'tl_page')
;

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
