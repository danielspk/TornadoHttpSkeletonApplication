<?php
namespace App\Module\Api\Domain\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

class UserRepository extends EntityRepository
{
    protected function getFields()
    {
        return $this->getClassMetadata()->fieldNames;
    }

    protected function getFieldsAndOrFilter($fields = null)
    {
        if (!$fields) {
            $fields = $this->getFields();
        }

        if (!$fields['id']) {
            $fields[] = 'id';
        }

        unset($fields['password']);

        return $fields;
    }

    protected function getJoinFieldsAndOrFilter($fields = null)
    {
        $fields = $this->getFieldsAndOrFilter($fields);

        unset($fields['created'], $fields['updated']);

        return $fields;
    }

    public function getUser($idUser)
    {
        return $this->findOneBy([
            'id'      => $idUser
        ]);
    }

    public function searchForDuplicateEmail($email, $idUser)
    {
        $entityManager = $this->getEntityManager();

        return $entityManager->createQueryBuilder()
            ->select('u')
            ->from('Api:User', 'u')
            ->where('u.id != :id AND u.email= :email')
            ->setParameter('id', $idUser)
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult(Query::HYDRATE_ARRAY);
    }

    public function searchUser($idUser)
    {
        $entityManager = $this->getEntityManager();

        $fields = 'u.'.implode($this->getFieldsAndOrFilter(), ', u.');
        $query  = $entityManager->createQuery(
            'SELECT '.$fields.' FROM Api:User u WHERE u.id = :id'
        );
        
        $query->setParameter('id', $idUser);
        
        return $query->getOneOrNullResult(Query::HYDRATE_ARRAY);
    }
    
    public function searchUsers($filters)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQueryBuilder();

        if ($filters['fields']) {
            $fields = 'partial u.{'.implode($this->getFieldsAndOrFilter($filters['fields']), ',').'}';
        } else {
            $fields = 'partial u.{'.implode($this->getFieldsAndOrFilter(), ',').'}';
        }

        $query->select($fields);
        $query->from('Api:User', 'u');

        if ($filters['query']) {
            foreach ($filters['query'] as $q) {
                if ($q['operator'] == '=' || $q['operator'] == 'LIKE') {
                    $query->andWhere('u.'.$q['field'].' '.$q['operator'].' :'.$q['field']);
                    $query->setParameter($q['field'], $q['values']);
                } elseif ($q['operator'] == 'IN') {
                    $query->andWhere('u.'.$q['field'].' '.$q['operator'].' (:'.$q['field'].')');
                    $query->setParameter($q['field'], $q['values']);
                } elseif ($q['operator'] == 'BETWEEN') {
                    $query->andWhere('u.'.$q['field'].' '.$q['operator'].' :'.$q['field'].'A AND :'.$q['field'].'B');
                    $query->setParameter($q['field'].'A', $q['values'][0]);
                    $query->setParameter($q['field'].'B', $q['values'][1]);
                }
            }
        }

        if ($filters['sort']) {
            foreach ($filters['sort'] as $key => $value) {
                $query->addOrderBy('u.'.$key, $value);
            }
        }

        if ($filters['offset']) {
            $query->setFirstResult($filters['offset']);
        }

        if ($filters['limit']) {
            $query->setMaxResults($filters['limit']);
        } else {
            $query->setMaxResults(10);
        }

        $paginator = new Paginator($query, true);
        $results   = $paginator->getQuery()->getResult(Query::HYDRATE_ARRAY);

        return [
            'metadata' => [
                'total_rows'  => count($paginator),
                'result_rows' => count($results)
            ],
            'results' => $results
        ];
    }
}
