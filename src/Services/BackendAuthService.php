<?php

namespace Jtl\Shop4\Services;

use Doctrine\ORM\EntityManager;

class BackendAuthService
{
    private $em;

    public function __construct(EntityManager $em)
    {
        if (is_null($em)) {
            throw new \InvalidArgumentException('em');
        }

        $this->em = $em;
    }

    public static function encryptUserPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyUserPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function checkLogin($username, $password)
    {
        try {
            $user = $this->em->createQueryBuilder()
                ->from('\Jtl\Shop4\Entity\Auth\User', 'u')
                ->select('u')
                ->where('u.username = :username')
                ->setParameter(':username', $username)
                ->getQuery()
                ->getSingleResult();

            $passwordHash = $user->getPassword();
            if (self::verifyUserPassword($password, $passwordHash))
                return $user;

            return null;
        }
        catch (NoResultException $e)
        {
            return null;
        }
    }
}
