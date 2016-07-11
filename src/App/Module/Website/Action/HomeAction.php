<?php
namespace App\Module\Website\Action;

use App\Middleware\Action\Action;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Action module showing homepage
 *
 * @package App\Module\Website
 */
class HomeAction extends Action
{
    /**
     * Action logic
     *
     * @param RequestInterface $request Request
     * @param ResponseInterface $response Response
     * @return ResponseInterface
     */
    public function run(RequestInterface $request, ResponseInterface $response)
    {
        /** @var \Twig_Environment $template */

        $template = $this->container->get('Template');

        return new HtmlResponse(
            $template->render('index.html', ['title' => 'Tornado HTTP - Skeleton Application'])
        );
    }
}
