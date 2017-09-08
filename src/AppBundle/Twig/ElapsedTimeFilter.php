<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/09/2017
 * Time: 16:13
 */

namespace AppBundle\Twig;


use function Symfony\Component\Debug\Tests\testHeader;

class ElapsedTimeFilter extends \Twig_Extension
{

    private $intervalFormat=[
        "y"=>"an",
        "m"=>"mois",
        "d"=>"jours",
        "h"=>"heure",
        "i"=>"minute",
        "s"=>"seconde"

    ];



    public function getName(){
        return "elapsedTimeFilter";
    }

    public function getFilters(){
        return [new \Twig_SimpleFilter("elapsed", [$this,"elapsed"])];
    }


    //le {{ post.createdAt | date('d/m/Y') }}
    public function elapsed($date){
        $now=new \DateTime();

        $interval=$now->diff($date);
        $format="";

        foreach ($this->intervalFormat as $key=>$val){
          $value=$interval->$key;

          if ($value>0){
              $format.=" %$key $val";
          }
        }
        return $interval->format($format);
    }


}