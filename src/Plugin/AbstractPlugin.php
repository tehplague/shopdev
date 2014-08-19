<?php

namespace Jtl\Shop4\Plugin;

/**
 * Abstract base class from which all plugins must inherit
 *
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
abstract class AbstractPlugin
{
    /**
     * Returns the plugin name
     * 
     * @return string
     */
    abstract public function getName();

    /**
     * Returns the plugins author as an RFC-5322 conforming address string,
     * such as "Christian Spoo <christian.spoo@jtl-software.com>" (without
     * quotes)
     * 
     * @return string
     */
    abstract public function getAuthor();

    /**
     * Returns an URL at which the homepage of the plugin author can be found
     * or NULL if there is none. Note, that this URL must be fully specified,
     * i.e. including the protocol scheme, such as "http://".
     *
     * @return string|null
     */
    abstract public function getUrl();
}
