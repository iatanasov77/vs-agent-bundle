<?php namespace Vankosoft\AgentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Vankosoft\ApplicationBundle\Component\Status;
use Vankosoft\AgentBundle\Form\VirtualHostForm;

class ActionsController extends AbstractController
{
    public function index( Request $request ): Response
    {
        $virtualhostForm   = $this->createForm( VirtualHostForm::class );
        
        return $this->render( '@VSAgent/Pages/Actions/index.html.twig', [
            'virtualhostForm'   => $virtualhostForm,
        ]);
    }
    
    public function showBrokenVirtualHost( Request $request ): Response
    {
        $filecontents = \file_get_contents( "/etc/httpd/conf.d/25-myprojects.lh.conf" );
        $contents = \str_replace( '/public/shared_assets/build', '', $filecontents );
        
        return new JsonResponse([
            'status'    => Status::STATUS_OK,
            'data'      => [
                'filecontents' => $contents,
            ]
        ]);
    }
    
    public function brokeVirtualHost( Request $request ): Response
    {
        $filecontents = \file_get_contents( "/etc/httpd/conf.d/25-myprojects.lh.conf" );
        $contents = \str_replace( '/public/shared_assets/build', '', $filecontents );
        
        return new JsonResponse([
            'status'    => Status::STATUS_OK,
            'data'      => [
                'filecontents' => $contents,
            ]
        ]);
    }
}
