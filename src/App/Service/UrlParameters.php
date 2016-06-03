<?php
namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\QueryException;

/**
 * Service for parse parameters in the URL of the search services
 *
 * @package App\Service
 */
class UrlParameters
{
    /**
     * @var EntityManager
     */
    private $entityManager;
    
    /**
     * Constructor
     *
     * @param EntityManager $entityManager Entity Manager by Doctrine
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * Method that filtering parameters and converts them to an array
     *
     * @param string $entity Entity to validate
     * @param array  $urlParameters Parameters to filter
     * @return null|array
     */
    public function filter($entity, array $urlParameters)
    {
        if (!$urlParameters) {
            return null;
        }

        $this->validateSections($urlParameters);

        $filters = [];

        foreach ($urlParameters as $key => $value) {
            $this->parseParameter($filters, $key, $value);
        }

        $this->validateFields($entity, $filters);
        
        return $filters;
    }

    /**
     * Method that parse the parameters
     *
     * @param array $filters Reference filters array
     * @param string $key Key of parameter
     * @param string|array $value Value of parameter
     */
    private function parseParameter(&$filters, $key, $value)
    {
        if ($key == 'offset') {
            $filters['offset'] = $value;
        } elseif ($key == 'limit') {
            $filters['limit'] = $value;
        } elseif ($key == 'fields') {
            $this->extractFields($filters, $value);
        } elseif ($key == 'sort') {
            $this->extractSort($filters, $value);
        } elseif ($key == 'query') {
            $this->extractquery($filters, $value);
        } else {
            $filters['query'][] = $this->parseFilter($key, $value);
        }
    }

    /**
     * Method that extract the fields parameter
     *
     * @param array $filters Reference filters array
     * @param string $value Value of fields parameter
     */
    private function extractFields(&$filters, $value)
    {
        $fields = explode(',', $value);

        foreach ($fields as $field) {
            $filters['fields'][$field] = $field; // this is the format with doctrine returns the fields
        }
    }

    /**
     * Method that extract the sort parameter
     *
     * @param array $filters Reference filters array
     * @param string $value Value of sort parameter
     */
    private function extractSort(&$filters, $value)
    {
        $sorts = explode(',', $value);

        foreach ($sorts as $sort) {
            if ($sort[0] != '-') {
                $filters['sort'][$sort] = 'ASC';
            } else {
                $filters['sort'][substr($sort, 1)] = 'DESC';
            }
        }
    }

    /**
     * Method that extract the query parameter
     *
     * @param array $filters Reference filters array
     * @param string $value Value of query parameter
     */
    private function extractQuery($filters, $value)
    {
        $queries = explode(',', $value);

        foreach ($queries as $query) {
            $data = explode(':', $query);
            $filters['query'][] = $this->parseFilter($data[0], $data[1]);
        }
    }

    /**
     * Method that parse string filter for query
     *
     * @param string $field Field name
     * @param string|array $value Value
     * @return array
     */
    private function parseFilter($field, $value)
    {
        if (strstr($value, '*') !== false) {
            return ['field' => $field, 'operator' => 'LIKE', 'values' => str_replace('*', '%', $value)];
        } elseif (strstr($value, '<>') !== false) {
            return ['field' => $field, 'operator' => 'BETWEEN', 'values' => explode('<>', $value)];
        } elseif (strstr($value, '|') !== false) {
            return ['field' => $field, 'operator' => 'IN', 'values' => explode('|', $value)];
        } else {
            return ['field' => $field, 'operator' => '=', 'values' => $value];
        }
    }

    /**
     * Method that validates the sections of url parameters
     *
     * @param array $urlParameters
     * @throws QueryException
     */
    private function validateSections(array $urlParameters)
    {
        if (array_key_exists('query', $urlParameters)) {
            foreach (array_keys($urlParameters) as $key) {
                if ($key != 'offset' && $key != 'limit' && $key != 'fields' && $key != 'sort' && $key != 'query') {
                    throw new QueryException('If your use the `query` section, the filter `'.$key.
                        '` is not allowed outside');
                }
            }
        }
    }

    /**
     * Method that validates the extracted URL fields
     *
     * @todo: validate values according to the type of data (date, bool, etc)
     * @param string $entity Entity to validate
     * @param array $filters Filters extracted from the URL
     * @throws QueryException
     */
    private function validateFields($entity, array $filters)
    {
        $class = $this->entityManager->getClassMetadata($entity);

        $fields = [];

        if ($filters['fields']) {
            $fields = array_merge($fields, array_values($filters['fields']));
        }
        if ($filters['sort']) {
            $fields = array_merge($fields, array_keys($filters['sort']));
        }
        if ($filters['query']) {
            $fields = array_merge($fields, array_column($filters['query'], 'field'));
        }

        $fields = array_unique($fields);

        foreach ($fields as $field) {
            if (!$class->hasField($field) && !$class->hasAssociation($field)) {
                throw new QueryException('The '.$field.' field is not valid');
            }
        }
    }
}
