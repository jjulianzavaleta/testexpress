<?php

namespace WCWeightVendor\WPDesk\Composer\Codeception;

use WCWeightVendor\Composer\Composer;
use WCWeightVendor\Composer\IO\IOInterface;
use WCWeightVendor\Composer\Plugin\Capable;
use WCWeightVendor\Composer\Plugin\PluginInterface;
/**
 * Composer plugin.
 *
 * @package WPDesk\Composer\Codeception
 */
class Plugin implements \WCWeightVendor\Composer\Plugin\PluginInterface, \WCWeightVendor\Composer\Plugin\Capable
{
    /**
     * @var Composer
     */
    private $composer;
    /**
     * @var IOInterface
     */
    private $io;
    public function activate(\WCWeightVendor\Composer\Composer $composer, \WCWeightVendor\Composer\IO\IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }
    /**
     * @inheritDoc
     */
    public function deactivate(\WCWeightVendor\Composer\Composer $composer, \WCWeightVendor\Composer\IO\IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }
    /**
     * @inheritDoc
     */
    public function uninstall(\WCWeightVendor\Composer\Composer $composer, \WCWeightVendor\Composer\IO\IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }
    public function getCapabilities()
    {
        return [\WCWeightVendor\Composer\Plugin\Capability\CommandProvider::class => \WCWeightVendor\WPDesk\Composer\Codeception\CommandProvider::class];
    }
}
