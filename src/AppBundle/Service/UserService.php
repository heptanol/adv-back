<?php

namespace AppBundle\Service;


use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;

class UserService
{

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param User $authenticateUser
     * @param string $id
     * @return \stdClass
     */
    public function getPublicData(User $authenticateUser, $id)
    {
        $data = array();
        $data['user'] = $this->userRepository->findByUsernameDetails($id);
        $data['followStatus'] = $this->getFollowStatus($authenticateUser, $id);
        return $data;
    }

    /**
     * @param User $user
     * @param string $id
     * @return bool
     */
    private function getFollowStatus(User $user, $id)
    {
        foreach($user->getIFollow()->getIterator() as $i => $item) {
            if ($item == $id) {
                return true;
            }
        }
        return false;
    }
}