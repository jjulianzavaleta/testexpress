<?php

namespace WCWeightVendor\WPDesk\PluginBuilder\Storage;

class StorageFactory
{
    /**
     * @return PluginStorage
     */
    public function create_storage()
    {
        return new \WCWeightVendor\WPDesk\PluginBuilder\Storage\WordpressFilterStorage();
    }
}
