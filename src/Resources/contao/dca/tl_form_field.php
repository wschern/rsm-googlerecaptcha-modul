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
 * Table tl_form_field
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['rsm_googlerecaptcha_modul'] = '{type_legend},type,label;{expert_legend:hide},class,tabindex,rsm_type,rsm_size,rsm_theme;';

$GLOBALS['TL_DCA']['tl_form_field']['fields']['rsm_type'] = array(
    'label'         => &$GLOBALS['TL_LANG']['tl_form_field']['rsm_type'],
    'inputType'     => 'select',
    'options' 		=> array('image'=>&$GLOBALS['TL_LANG']['tl_form_field']['rsm_type']['image'], 'audio'=>&$GLOBALS['TL_LANG']['tl_form_field']['rsm_type']['audio']),
    'sql'           => "varchar(10) NOT NULL default 'image'",
    'eval'          => array('tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['rsm_size'] = array(
    'label'         => &$GLOBALS['TL_LANG']['tl_form_field']['rsm_size'],
    'inputType'     => 'select',
    'options' 		=> array('normal'=>&$GLOBALS['TL_LANG']['tl_form_field']['rsm_size']['normal'], 'compact'=>&$GLOBALS['TL_LANG']['tl_form_field']['rsm_size']['compact']),
    'sql'           => "varchar(10) NOT NULL default 'normal'",
    'eval'          => array('tl_class'=>'w50'),
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['rsm_theme'] = array(
    'label'         => &$GLOBALS['TL_LANG']['tl_form_field']['rsm_theme'],
    'inputType'     => 'select',
    'options' 		=> array('light'=>&$GLOBALS['TL_LANG']['tl_form_field']['rsm_theme']['light'], 'dark'=>&$GLOBALS['TL_LANG']['tl_form_field']['rsm_theme']['dark']),
    'sql'           => "varchar(10) NOT NULL default 'light'",
    'eval'          => array('tl_class'=>'w50'),
);