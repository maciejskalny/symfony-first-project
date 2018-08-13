<?php
/**
 * Created by PhpStorm.
 * User: virtua
 * Date: 03.08.2018
 * Time: 10:09
 */

namespace App\Service;

class ApiService
{
    /**
     * @param $entity
     * @return array
     */
    public function Serialize($entity){
        return array(
            'id' => $entity->getId(),
            'name' => $entity->getName(),
        );
    }
}