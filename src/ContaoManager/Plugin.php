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

namespace Rsm\RsmGooglerecaptchaModul\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Rsm\RsmGooglerecaptchaModul\RsmGooglerecaptchaModulBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create(RsmGooglerecaptchaModulBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
