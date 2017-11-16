<?php

namespace AppBundle\Model;


class Message
{
    const SUCCESS = '0';
    
    const ERROR = '1';
    
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $text;

    /**
     * Message constructor.
     * @param string $code
     * @param string $text
     */
    public function __construct($text = '', $code = '')
    {
        $this->text = $text;
        $this->code = $code;
    }


    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//    }


}