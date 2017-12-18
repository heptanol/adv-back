<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Image;
use AppBundle\Entity\Node;
use AppBundle\Entity\User;
use AppBundle\Filter\NodeFilter;
use Doctrine\ORM\Query\FilterCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class NodeController extends FOSRestController implements ClassResourceInterface
{
    /**
     * @Rest\View()
     * @Rest\Get("/node/{id}")
     */
    public function getAction($id)
    {
        $node = $this->getDoctrine()->getRepository(Node::class)->find($id);
        $node->setUser(new User());

        return $node;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/nodes")
     */
    public function nodesAction(Request $request)
    {
        $filter = new NodeFilter($request);
        
        return $this->getDoctrine()->getRepository(Node::class)
            ->findBy($filter->getFiltersCriteria(), $filter->getOrderBy(), $filter->getLimit(), $filter->getOffset());
    }

}
