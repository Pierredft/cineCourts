<?php 

namespace App\Security;

use App\Entity\User; 
use App\Repository\UserRepository;
use League\OAuth2\Client\Provider\GoogleUser; 
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

final class OAuthRegistrationService 
{
    public function __construct (
        private UserRepository $repository
    ) {

    }

    /**
     * @param GoogleUser $resourceOwner
     */

    public function persist(ResourceOwnerInterface $resourceOwner): User
    {
        $user = (new User())
            ->setEmail($resourceOwner->getEmail())
            ->setGoogleId($resourceOwner->getId())
            ->setPassword('password')
            ->setNom($resourceOwner->getLastName())
            ->setPrenom($resourceOwner->getFirstName())
            ->setTelephone('telephone');

        $this->repository->add($user, flush: true);
        return $user; 
    }
}