<?php
namespace App\Module\Api\Action\User;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Action that delete an user
 *
 * @package App\Module\Api
 */
class DeleteAction extends UserAction
{
    /**
     * Action logic
     *
     * @param ServerRequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */

        $user = $this->getUser($request->getAttribute('id'));

        $entityManager = $this->container->get('EntityManager');
        
        // delete the user
        $entityManager->remove($user);
        $entityManager->flush();
        
        return new JsonResponse(['status' => 'deleted'], 200);
    }
}
