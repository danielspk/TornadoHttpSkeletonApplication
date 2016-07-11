<?php
namespace App\Module\Api\Action\User;

use App\Middleware\Route\Action;
use App\Exception\HttpNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Action that seeking users
 *
 * @package App\Module\Api
 */
class SearchAction extends Action
{
    /**
     * Action logic
     *
     * @param RequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     * @throws HttpNotFoundException
     */
    public function run(RequestInterface $request, ResponseInterface $response)
    {
        /** @var \Psr\Http\Message\ServerRequestInterface $request */
        /** @var \Doctrine\ORM\EntityManager $entityManager */
        /** @var \App\Service\UrlParameters $urlParameters */
        /** @var \App\Module\Api\Domain\Entity\UserRepository $userRepository */
        
        $idUser = $request->getAttribute('id');

        $entityManager  = $this->container->get('EntityManager');
        $userRepository = $entityManager->getRepository('Api:User');
        
        if ($idUser) {
            $result = $userRepository->searchUser($idUser);
            if (!$result) {
                throw new HttpNotFoundException('The user requested does not exist');
            }
        } else {
            $urlParams = $this->getContainer()->get('UrlParameters');
            $filters   = $urlParams->filter('Api:User', $request->getQueryParams());
            $result    = $userRepository->searchUsers($filters);
        }

        return new JsonResponse($result);
    }
}
