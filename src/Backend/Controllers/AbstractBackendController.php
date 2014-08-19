<?php

namespace Jtl\Shop4\Backend\Controllers;

use Twig_Environment;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
abstract class AbstractBackendController
{
    protected $twig;

    public function __construct(Twig_Environment $twig)
    {
        if (is_null($twig)) {
            throw new \InvalidArgumentException('twig');
        }

        $this->twig = $twig;
    }    
}
