<?php
namespace MH\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;

class MHUserProvider extends FOSUBUserProvider
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $oAuthPropertyName = $this->getProperty($response);
        $username = $response->getUsername();
        $user = $this->userManager->findUserBy([$oAuthPropertyName => $username]);

        if (null !== $user) {
            return $user;
        }

        $data = $response->getResponse();
        if (!isset($data['email'])) {
            throw new AccountNotLinkedException(sprintf("Email address for user '%s' not provided.", $username));
        }
        $userEmail = $data['email'];

        $user = $this->userManager->findUserBy(['email' => $userEmail]);
        if (null === $user) {
            $user = $this->userManager->createUser();
            $user->setEmail($userEmail);
            $user->setPassword('');
            $user->setEnabled(true);
        }
        $user->setOAuthProperty($oAuthPropertyName, $username);

        try {
            $this->userManager->updateUser($user);
        } catch (\Doctrine\DBAL\DBALException $exception) {
            throw new AccountNotLinkedException(sprintf("User '%s' could not be crated.", $username), null, 0, $exception);
        }

        return $user;
    }
}
