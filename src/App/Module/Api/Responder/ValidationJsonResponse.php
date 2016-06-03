<?php
namespace App\Module\Api\Responder;

use Zend\Diactoros\Response\JsonResponse;

/**
 * Response for validation errors in json format
 *
 * @package App\Module\Api
 */
class ValidationJsonResponse extends JsonResponse
{
    /**
     * Constructor
     *
     * @todo Customize according to project
     * @param array $errors Errors
     */
    public function __construct(array $errors)
    {
        parent::__construct([
            'status' => 'error',
            'errors' => $errors
        ], 422);
    }
}
