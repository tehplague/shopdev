<?php

namespace Jtl\Shop4\Backend\Controllers;

/**
 * @author Christian Spoo <christian.spoo@jtl-software.com>
 */
class DashboardController extends AbstractBackendController
{
    public function show()
    {
        return $this->twig->render('dashboard/show.html.twig');
    }    
}
