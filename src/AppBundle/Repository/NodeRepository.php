<?php

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class NodeRepository extends EntityRepository
{

    public function findNodePositionByUser($id)
    {
        return $this->createQueryBuilder('n')
        ->select('n.id', 'n.latitude', 'n.longitude')
        ->where('n.user = :id')
        ->setParameter('id', $id)
        ->getQuery()
        ->getResult();
    }
}