<?php
namespace App\Module\Api\Action\User;

use App\Exception\HttpNotFoundException;
use App\Middleware\Route\Action;
use App\Module\Api\Domain\Entity\User;

/**
 * Base class for actions user
 */
abstract class UserAction extends Action
{
    /**
     * Method that retrieves the user's entity
     *
     * Used by methods PUT and DELETE
     *
     * @param int $idUser Id User
     * @return User
     * @throws HttpNotFoundException
     */
    protected function getUser($idUser)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        /** @var \App\Module\Api\Domain\Entity\UserRepository $userRepository */

        $entityManager  = $this->container->get('EntityManager');
        $userRepository = $entityManager->getRepository('Api:User');

        $user = $userRepository->getUser($idUser);
        
        if (!$user) {
            throw new HttpNotFoundException('The user does not exist');
        }
        
        return $user;
    }
}
