<?php

namespace AppBundle\Repository;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findByUsernameDetails($username)
    {
        return $this->createQueryBuilder('u')
            ->select('u.id', 'u.username', 'u.firstName', 'u.lastName', 'u.birthDate', 'u.createdAt', 'u.sex', 'u.aboutMe', 'u.coverPic', 'u.profilePic')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getSingleResult();
    }

    public function findAllDetails()
    {
        return $this->createQueryBuilder('u')
            ->select('u.username', 'u.firstName', 'u.lastName', 'u.birthDate', 'u.createdAt', 'u.sex', 'u.aboutMe', 'u.coverPic', 'u.profilePic')
            ->getQuery()
            ->getResult();
    }

    public function findIFollow($id)
    {
        return $this->createQueryBuilder('u')
            ->join('u.followsMe', 'f')
            ->where('f.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
    
    public function findFollowsMe($id)
    {
        return $this->createQueryBuilder('u')
            ->join('u.iFollow', 'f')
            ->where('f.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

}