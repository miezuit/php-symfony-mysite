<?php

namespace App\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactsController extends AbstractController {

    /**
     * @Route("/facts")
     */
    public function showRandomFact()
    {
        $db = new \PDO(
                $this->getParameter('db_uri'), 
                $this->getParameter('db_user'), 
                $this->getParameter('db_password'));
        
        $result = $db->query('SELECT fact FROM facts ORDER BY RAND() LIMIT 1');

        $row = $result->fetch();

        return new Response(var_export($row['fact'], true));
    }
}
