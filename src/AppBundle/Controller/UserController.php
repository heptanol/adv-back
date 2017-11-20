<?php
/**
 * Created by PhpStorm.
 * User: PV5355
 * Date: 31/10/2017
 * Time: 16:08
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Node;
use AppBundle\Entity\User;
use AppBundle\Model\Message;
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
    public function getUserAction($id = null)
    {
        if (!empty($id)) {
            return  $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(['username'=> $id]);
        }
        return  $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
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
     * @Rest\Get("/nodes/{id}", defaults={"id" = null})
     */
    public function nodesAction($id = null)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneBy(['username'=> $id]);
        return $this->getDoctrine()->getRepository(Node::class)->findBy(['user'=> $user->getId()]);
    }
}