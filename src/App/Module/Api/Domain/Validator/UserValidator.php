<?php
namespace App\Module\Api\Domain\Validator;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Valitron\Validator;

/**
 * Validator for User Entities
 *
 * @package App\Module\Api
 */
class UserValidator
{
    /// properties
    /** @var string  */
    private $action;

    /** @var mixed  */
    private $idUser;

    /** @var array|null|object */
    private $data;

    /** @var \Doctrine\ORM\EntityManager */
    private $entityManager;

    /** @var array */
    private $errors = [];
    
    /// validation rules
    /** @var array */
    private $rulesGlobal = [
        'email' => [
            ['email'],
        ],
        'lengthBetween' => [
            ['password', 4, 15]
        ]
    ];

    /** @var array */
    private $rulesNew = [
        'required' => [
            ['email'],
            ['password']
        ]
    ];

    /** @var array */
    private $rulesModify = [];
    
    /**
     * Constructor
     *
     * @param string $action Type of action to validate
     * @param ServerRequestInterface $request Request Http
     * @param ContainerInterface $container Dependency Injection
     */
    public function __construct($action, ServerRequestInterface $request, ContainerInterface $container)
    {
        $this->action        = $action;
        $this->idUser        = $request->getAttribute('id');
        $this->data          = $request->getParsedBody();
        $this->entityManager = $container->get('EntityManager');
    }
    
    /**
     * Method that validates the entity
     *
     * @return boolean
     */
    public function validate()
    {
        $this->validateFields();
        $this->validateEntityFields();
        $this->validateUnique();
        
        return (count($this->errors)) ? false : true;
    }
    
    /**
     * Method that returns the errors found
     *
     * @return array
     */
    public function errors()
    {
        return $this->errors;
    }
    
    /**
     * Method that validates fields of the entity based on its restrictions
     */
    protected function validateFields()
    {
        $validator = new Validator($this->data, [], 'en'); //@todo: if use external i18n library?
        
        if ($this->action == 'new') {
            $validator->rules(
                array_merge($this->rulesNew, $this->rulesGlobal)
            );
        } else {
            $validator->rules(
                array_merge($this->rulesModify, $this->rulesGlobal)
            );
        }
        
        if (!$validator->validate()) {
            $this->errors = array_merge($this->errors, $validator->errors());
        }
    }
    
    /**
     * Method that validates the existence/availability of the fields in the entity
     */
    protected function validateEntityFields()
    {
        $class = $this->entityManager->getClassMetadata('Api:User');
        
        foreach (array_keys($this->data) as $field) {
            if ($field == 'id' || !$class->hasField($field)) {
                $this->errors[$field][] = 'it is not a valid field';
            }
        }
    }
    
    /**
     * Method that validates that the entity is unique
     */
    protected function validateUnique()
    {
        /** @var \App\Module\Api\Domain\Entity\UserRepository $userRepository */

        $user = null;
        $userRepository = $this->entityManager->getRepository('Api:User');

        if (isset($this->data['email'])) {
            $user = $userRepository->searchForDuplicateEmail($this->data['email'], $this->idUser);
        }
        
        if ($user) {
            $this->errors['email'][] = 'already registered/existing';
        }
    }
}
