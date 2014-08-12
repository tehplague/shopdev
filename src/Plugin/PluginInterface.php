<?php

namespace Jtl\Shop4\Plugin;

use Jtl\Shop4\Application;

interface PluginInterface
{
    function register(Application $app);
}
