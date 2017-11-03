<?php
/**
 * Created by PhpStorm.
 * User: PV5355
 * Date: 31/10/2017
 * Time: 16:08
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
            return  $this->getDoctrine()->getRepository('AppBundle:User')->find($id);
        }
        return  $this->getDoctrine()->getRepository('AppBundle:User')->findAll();
    }
}