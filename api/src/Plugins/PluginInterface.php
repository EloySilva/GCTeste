<?php


namespace CMS\Plugins;
use CMS\ServiceContainerInterface;
interface PluginInterface
{
    public function register(ServiceContainerInterface $container);
}


