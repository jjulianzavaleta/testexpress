<?php

namespace WCWeightVendor\WPDesk\Composer\Codeception\Commands;

use WCWeightVendor\Composer\Command\BaseCommand as CodeceptionBaseCommand;
use WCWeightVendor\Symfony\Component\Console\Output\OutputInterface;
/**
 * Base for commands - declares common methods.
 *
 * @package WPDesk\Composer\Codeception\Commands
 */
abstract class BaseCommand extends \WCWeightVendor\Composer\Command\BaseCommand
{
    /**
     * @param string $command
     * @param OutputInterface $output
     */
    protected function execAndOutput($command, \WCWeightVendor\Symfony\Component\Console\Output\OutputInterface $output)
    {
        \passthru($command);
    }
}
