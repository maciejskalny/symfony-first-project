<?php
/**
 * This file supports Api Product and Api Category controllers.
 * @category Service
 * @Package Virtua_Internship
 * @copyright Copyright (c) 2018 Virtua (http://www.wearevirtua.com)
 * @author Maciej Skalny contact@wearevirtua.com
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