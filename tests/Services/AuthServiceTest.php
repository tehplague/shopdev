<?php

namespace Jtl\Shop4\Tests\Services;

use Jtl\Shop4\Tests\Common\DatabaseTestCase;

use Jtl\Shop4\Services\AuthService;

class AuthServiceTest extends DatabaseTestCase
{
    protected function getFixtures()
    {
        return array(
            new Fixtures\AuthSimpleUserFixture()
        );
    }

    public function testPasswordHash()
    {
        $password = '12345';
        $hash = AuthService::encryptUserPassword($password);
        $this->assertNotNull($hash);
        $this->assertStringStartsWith('$', $hash);

        $verifyResult = AuthService::verifyUserPassword($password, $hash);
        $this->assertTrue($verifyResult);

        $failureResult = AuthService::verifyUserPassword('54321', $hash);
        $this->assertFalse($failureResult);
    }

    public function testAuthentication()
    {
        $app = $this->createApplication();

        $username = 'cspoo';
        $password = '12345';

        $user = $app['shop4.backend.auth']->checkLogin($username, $password);
        $this->assertNotNull($user);
        $this->assertInstanceOf('\Jtl\Shop4\Entity\Auth\User', $user);
    }
}
