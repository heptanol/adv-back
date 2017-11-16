<?php

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

class DefaultController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Rest\View()
     * @Rest\Get("/date")
     */
    public function timeAction()
    {
        $data = new User();
        $data->setUsername('game');
        $ser = $this->get('serialize.service')->serialize($data);
        dump($ser);
        dump(new \DateTime());
        die;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/email")
     */
    public function sendMailAction()
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('thamine.alaeddine@gmail.com')
            ->setBody(
                $this->renderView(
                    'AppBundle:Emails:registration.html.twig'
                ),
                'text/html'
            );
        $this->get('mailer')->send($message);
    }
}
