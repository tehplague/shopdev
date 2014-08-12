<?php

namespace Jtl\Shop4\Tests\Services;

use Jtl\Shop4\Tests\Common\TestCase;

use Jtl\Shop4\Services\AuthService;

class AuthServiceTest extends TestCase
{
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
}
