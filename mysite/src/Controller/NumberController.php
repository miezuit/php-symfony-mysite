<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NumberController extends AbstractController {
    
    /**
     *
     * @var PDO 
     */
    private $db;
    
    /**
     * 
     * @param \PDO $db
     */
    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    /**
     * @Route("/drink")
     * @return Response
     */
    public function showRandomDrink()
    {
   
        $statement = 'SELECT drink_name FROM drink_info
                      ORDER BY RAND() LIMIT 1';
        
        $result = $this->db->query($statement);
        
        $row = $result->fetch();
        
        $response = new Response($row['drink_name']);
        
        return $response;
    }
    
    /**
     * @Route("/number")
     * @return Response
     */
    public function showRandomNumber()
    {
        $number = rand(1, 100);
        
        $response = $this->render(
                'number.html.twig',
                ['lucky_number' => $number,
                 'message' => '<script>alert("Hacked")</script>'
                ]
        );
        
        return $response;
    }
}
