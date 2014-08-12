<?php

namespace Jtl\Shop4\Backend;

class BackendService
{
    protected $menuItems = array();

    public function addMenuItem(MenuItem $item)
    {
        $this->menuItems[] = $item;
        return $this;
    }

    public function getMenuItems()
    {
        return $this->menuItems();
    }
}
