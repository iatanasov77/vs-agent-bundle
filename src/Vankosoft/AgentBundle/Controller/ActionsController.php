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
        if ( $request->isMethod( 'POST' ) ) {
            $virtualHost = $request->request->get( 'virtualHost' );
            
            $filecontents = \file_get_contents( $virtualHost );
            $contents = \str_replace( '/public/shared_assets/build', '', $filecontents );
            
            return new JsonResponse([
                'status'    => Status::STATUS_OK,
                'data'      => [
                    'filecontents' => $contents,
                ]
            ]);
        }
        
        return new JsonResponse([
            'status'    => Status::STATUS_ERROR,
            'message'   => 'Controller Error !!!'
        ]);
    }
    
    public function brokeVirtualHost( Request $request ): Response
    {
        if ( $request->isMethod( 'POST' ) ) {
            $virtualHost    = $request->request->get( 'virtualHost' );
            $apacheService  = $request->request->get( 'apacheService' );
            
            $filecontents = \file_get_contents( $virtualHost );
            $contents = \str_replace( '/public/shared_assets/build', '', $filecontents );
            \file_put_contents( $virtualHost, $contents  );
            $shellResponse = \shell_exec( \sprintf( 'service %s restart &', $apacheService ) );
            
            return new JsonResponse([
                'status'    => Status::STATUS_OK,
                'data'      => [
                    'filecontents'  => $contents,
                    'shellResponse' => $shellResponse,
                ]
            ]);
        }
        
        return new JsonResponse([
            'status'    => Status::STATUS_ERROR,
            'message'   => 'Controller Error !!!'
        ]);
    }
}
