<?php

namespace AppBundle\Service;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SerializerService
 * @package AppBundle\Service
 */
class SerializerFactory
{
    /**
     * @param string $param
     * @return JsonSerializerService|XmlSerializerService|null
     */
    public function createSerializer($param)
    {
        if ($param == JsonEncoder::FORMAT) {
            return new JsonSerializerService();
        } elseif ($param == XmlEncoder::FORMAT) {
            return new XmlSerializerService();
        }
        else return null;
    }

}