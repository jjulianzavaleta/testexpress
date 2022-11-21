<?php

namespace WCWeightVendor\WPDesk\Composer\Codeception;

use WCWeightVendor\WPDesk\Composer\Codeception\Commands\CreateCodeceptionTests;
use WCWeightVendor\WPDesk\Composer\Codeception\Commands\RunCodeceptionTests;
use WCWeightVendor\WPDesk\Composer\Codeception\Commands\RunLocalCodeceptionTests;
/**
 * Links plugin commands handlers to composer.
 */
class CommandProvider implements \WCWeightVendor\Composer\Plugin\Capability\CommandProvider
{
    public function getCommands()
    {
        return [new \WCWeightVendor\WPDesk\Composer\Codeception\Commands\CreateCodeceptionTests(), new \WCWeightVendor\WPDesk\Composer\Codeception\Commands\RunCodeceptionTests(), new \WCWeightVendor\WPDesk\Composer\Codeception\Commands\RunLocalCodeceptionTests()];
    }
}
