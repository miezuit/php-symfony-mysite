<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class LuckyController {
    public function lucky()
    {
        $number = rand(1, 100);
        
        $response = new Response(
                "<html><body><div>$number</div></body></html>"
        );
        
        return $response;
    }
    
}
