<?php

namespace Jtl\Shop4\Backend\Menu;

class MenuItem
{
    protected $name;

    protected $action;

    protected $children = array();

    protected $parent = null;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    public function addChild(MenuItem $child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function clearChildren()
    {
        $this->children[] = array();
        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(MenuItem $parent)
    {
        $this->parent = $parent;
        return $this;
    }
}
