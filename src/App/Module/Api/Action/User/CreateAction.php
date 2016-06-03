<?php
namespace App\Module\Api\Action\User;

use App\Middleware\Route\Action;
use App\Module\Api\Domain\Entity\User;
use App\Module\Api\Domain\Validator\UserValidator;
use App\Module\Api\Responder\ValidationJsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Action that create an new user
 *
 * @package App\Module\Api
 */
class CreateAction extends Action
{
    /**
     * Action logic
     *
     * @param ServerRequestInterface $request Petición
     * @param ResponseInterface $response Respuesta
     * @return ResponseInterface
     */
    public function run(ServerRequestInterface $request, ResponseInterface $response)
    {
        /** @var \Doctrine\ORM\EntityManager $entityManager */

        // data is validated
        $validator = new UserValidator('new', $request, $this->container);
        
        if (!$validator->validate()) {
            return new ValidationJsonResponse($validator->errors());
        }
        
        // insert the user
        $entityManager = $this->container->get('EntityManager');

        $data = $request->getParsedBody();
        $user = new User();
        
        foreach ($data as $field => $value) {
            $user->{'set'.ucfirst($field)}($value);
        }
        
        $entityManager->persist($user);
        $entityManager->flush();
        
        return new JsonResponse(['status' => 'created'], 201);
    }
}
