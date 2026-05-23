<?php namespace Vankosoft\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Vankosoft\ApplicationBundle\Component\Status;

class ActionsController extends AbstractController
{
    public function index( Request $request ): Response
    {
        return $this->render( '@VSAgent/Pages/Actions/index.html.twig', [
            
        ]);
    }
    
    public function brokeVirtualHost( Request $request ): Response
    {
        $filecontents = \file_get_contents( "/etc/httpd/conf.d/25-myprojects.lh.conf" );
        
        return new JsonResponse([
            'status'    => Status::STATUS_OK,
            'data'      => [
                'filecontents' => $filecontents,
            ]
        ]);
    }
}
