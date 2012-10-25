<?php
namespace MH\UserBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;

class MHUserProvider extends FOSUBUserProvider
{
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $oAuthPropertyName = $this->getProperty($response);
        $data = $response->getResponse();
        if (isset ($data['email'])) {
            $userEmail = $data['email'];
        } else {
            throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
        }

        $username = $response->getUsername();
        $user = $this->userManager->findUserBy([$oAuthPropertyName => $username]);

        if (null === $user) {
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
                throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
            }
        }

        return $user;
    }
}
