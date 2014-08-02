<?php

namespace Jtl\Shop4\Backend\Controller\Auth;

use Symfony\Component\HttpFoundation\Request;

class LoginController
{
    /**
     * Shows login page
     * @param  Request $request Symfony Request object
     * @return Response         Response with login page
     */
    public function showLogin(Request $request)
    {
        return 'Hello, world!';
    }

    /**
     * Handle login request via POST
     * @param  Request $request Symfony Request object
     * @return Response         [description]
     */
    public function processLogin(Request $request)
    {

    }
}
