<?php

namespace App\Controller;

use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FactsController extends AbstractController {

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * FactsController constructor.
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @Route("/facts")
     */
    public function showRandomFact()
    {
        $result = $this->pdo->query('SELECT fact FROM facts ORDER BY RAND() LIMIT 1');

        $row = $result->fetch();

        return new Response($row['fact']);
    }
}
