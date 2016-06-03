<?php
namespace App\Module\Api\Action\User;

use App\Module\Api\Domain\Validator\UserValidator;
use App\Module\Api\Responder\ValidationJsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Action that modify an user
 *
 * @package App\Module\Api
 */
class ModifyAction extends UserAction
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

        // recovering the user data and validate
        $user = $this->getUser($request->getAttribute('id'));
 
        $validator = new UserValidator('modify', $request, $this->container);
        
        if (!$validator->validate()) {
            return new ValidationJsonResponse($validator->errors());
        }
        
        // update the user
        $entityManager = $this->container->get('EntityManager');
        $data = $request->getParsedBody();
        
        foreach ($data as $field => $value) {
            $user->{'set'.ucfirst($field)}($value);
        }

        $entityManager->flush();
        
        return new JsonResponse(['status' => 'updated'], 200);
    }
}
