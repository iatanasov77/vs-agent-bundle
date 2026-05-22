<?php namespace Vankosoft\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActionsController extends AbstractController
{
    public function index( Request $request ): Response
    {
        return $this->render( '@VSAgent/Pages/Actions/index.html.twig', [
            
        ]);
    }
}
