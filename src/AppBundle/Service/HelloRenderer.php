<?php
/**
 * Created by PhpStorm.
 * User: formation
 * Date: 08/09/2017
 * Time: 10:24
 */

namespace AppBundle\Service;


class HelloRenderer
{
    public function render( $text){
        return "<h3>$text</h3>";
    }

}