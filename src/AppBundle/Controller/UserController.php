<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Node;
use AppBundle\Entity\User;
use AppBundle\Model\Message;
use AppBundle\Service\UserService;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends FOSRestController implements ClassResourceInterface
{

    /**
     * @Rest\View()
     * @Rest\Get("/user/{id}", defaults={"id" = null})
     */
    public function getAction($id)
    {
        return  $this->get(UserService::class)->getPublicData($this->getUser(), $id);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/register")
     */
    public function registerAction(Request $request)
    {

        $userManager = $this->get('fos_user.user_manager');
        $encoder = $this->get('security.encoder_factory')->getEncoder(User::class);

        $email_exist = $userManager->findUserByEmail($request->get('email'));
        $user_exist = $userManager->findUserByUsername($request->get('username'));

        if ($email_exist) {
            return new Message('Email existe déja', Message::ERROR);
        }

        if ($user_exist) {
            return new Message('Username existe déja', Message::ERROR);
        }

        try {
            /* @var $user User */
            $user = $userManager->createUser();
            $user->setUsername($request->get('username'));
            $user->setPassword($encoder->encodePassword($request->get('password'), ''));
            $user->setEmail($request->get('email'));
            $user->setFirstName($request->get('firstName'));
            $user->setLastName($request->get('lastName'));
            $user->setSex($request->get('sex'));
            $user->setBirthDate(new \DateTime($request->get('birthdate')));
            $user->setRoles(array('ROLE_READER'));
            $user->setConfirmationToken(md5($request->get('username') . $request->get('firstName') . $request->get('lastName')));

            $this->get('fos_user.mailer')->sendConfirmationEmailMessage($user);
            $userManager->updateUser($user);

        } catch (Exception $e) {
            return new Message($e->getMessage(), Message::ERROR);
        }


        return new Message('User créer', Message::SUCCESS);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/user/{id}/nodes", defaults={"id" = null})
     */
    public function nodesAction($id = null)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username'=> $id]);
        return $this->getDoctrine()->getRepository(Node::class)->findNodePositionByUser($user->getId());
    }

    /**
     * @Rest\View()
     * @Rest\Get("/user/{id}/i-follow")
     */
    public function getIFollow($id)
    {
        return $this->getDoctrine()->getRepository(User::class)->findIFollow($id);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/user/{id}/follows-me")
     */
    public function getFollowsMe($id)
    {
        return $this->getDoctrine()->getRepository(User::class)->findFollowsMe($id);
    }

    /**
     * @Rest\View()
     * @Rest\Get("/user/follows/{id}")
     */
    public function followAction($id)
    {
        $iFollow = $this->getUser();
        $followsMe = $this->getDoctrine()->getRepository(User::class)->find($id);

        $followsList = $iFollow->getIFollow();
        $followsList->add($followsMe);

        $iFollow->setIFollow($followsList);

        try {
            $this->getDoctrine()->getManager()->persist($iFollow);
            $this->getDoctrine()->getManager()->flush();
        } catch (Exception $e) {
            return new Message($e->getMessage(), Message::ERROR);
        }

        return new Message('OK', Message::SUCCESS);
    }
    /**
     * @Rest\View()
     * @Rest\Get("/user/abort-follows/{id}")
     */
    public function abortFollowAction($id)
    {
        /** @var User $iFollow */
        $iFollow = $this->getUser();
        $followsMe = $this->getDoctrine()->getRepository(User::class)->find($id);

        $followsList = $iFollow->getIFollow();
        $followsList->removeElement($followsMe);

        $iFollow->setIFollow($followsList);

        try {
            $this->getDoctrine()->getManager()->persist($iFollow);
            $this->getDoctrine()->getManager()->flush();
        } catch (Exception $e) {
            return new Message($e->getMessage(), Message::ERROR);
        }

        return new Message('OK', Message::SUCCESS);
    }
}