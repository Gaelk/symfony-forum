<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/09/2017
 * Time: 09:42
 */

namespace AppBundle\Service;


class HelloService
{
    /**
     * @var
     */
    private $name;
    /**
     * @var HelloRenderer
     */
    private $renderer;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * HelloService constructor.
     * @param $name
     * @param HelloRenderer $renderer
     */
     public function __construct($name, HelloRenderer $renderer)
     {
         $this->name=$name;
         $this->renderer= $renderer;
     }

    public function sayHello(){

      return $this->renderer->render( "hello Service  $this->name");
    }
}