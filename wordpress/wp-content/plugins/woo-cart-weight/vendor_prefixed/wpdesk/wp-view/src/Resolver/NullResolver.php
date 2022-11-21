<?php

namespace WCWeightVendor\WPDesk\View\Resolver;

use WCWeightVendor\WPDesk\View\Renderer\Renderer;
use WCWeightVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * This resolver never finds the file
 *
 * @package WPDesk\View\Resolver
 */
class NullResolver implements \WCWeightVendor\WPDesk\View\Resolver\Resolver
{
    public function resolve($name, \WCWeightVendor\WPDesk\View\Renderer\Renderer $renderer = null)
    {
        throw new \WCWeightVendor\WPDesk\View\Resolver\Exception\CanNotResolve("Null Cannot resolve");
    }
}
