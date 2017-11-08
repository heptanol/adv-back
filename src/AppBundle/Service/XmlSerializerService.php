<?php

namespace AppBundle\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class XmlSerializerService
 * @package AppBundle\Service
 */
class XmlSerializerService
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
        $this->serializer = new Serializer(array(new ObjectNormalizer()), array(new XmlEncoder()));
    }

    /**
     * @param $data
     * @return string|\Symfony\Component\Serializer\Encoder\scalar
     */
    public function serialize($data)
    {
        return $this->serializer->serialize($data, XmlEncoder::FORMAT);
    }
}