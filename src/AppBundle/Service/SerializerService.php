<?php

namespace AppBundle\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SerializerService
 * @package AppBundle\Service
 */
class SerializerService
{
    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * SerializerService constructor.
     */
    public function __construct()
    {
        $this->serializer = new Serializer(array(new ObjectNormalizer()), array(new JsonEncoder()));
    }

    /**
     * @param $data
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    public function toJson($data)
    {
        return $this->serializer->serialize($data, JsonEncoder::FORMAT);
    }
}