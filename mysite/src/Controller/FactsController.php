<?php

namespace App\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FactsController extends AbstractController {
    public function showRandomFact()
    {
        $db = new \PDO(
                $this->getParameter('db_uri'), 
                $this->getParameter('db_user'), 
                $this->getParameter('db_password'));
        
        $result = $db->query('SELECT fact FROM facts ORDER BY RAND() LIMIT 1');
        
        var_dump($result);
    }
}
