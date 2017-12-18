<?php
namespace AppBundle\Filter;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class NodeFilter
{
    /**
     * @var ParameterBag
     */
    protected $query;

    public function __construct(Request $request = null)
    {
        $this->query = $request->query;
    }

    /**
     * exemple: 
     * 
     * ['user' => 1]
     * 
     * @return array
     */
    public function getFiltersCriteria()
    {
        $data = array();
        if ($this->query->has('user')) {
            $data['user'] = $this->query->get('user');
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getOrderBy()
    {
        $data = array(
            'createdAt' => 'DESC'
        );
        if ($this->query->has('orderBy')) {
            $data = array(
                $this->query->get('orderBy') => $this->query->has('order') ? $this->query->get('order') : 'DESC'
            );
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->query->get('limit');
    }

    /**
     * @return mixed
     */
    public function getOffset()
    {
        if ($this->query->has('page') && $this->query->has('limit')) {
            return ($this->query->get('page') - 1) * $this->query->get('limit');
        }
    }
}