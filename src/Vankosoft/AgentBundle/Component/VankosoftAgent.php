<?php namespace Vankosoft\AgentBundle\Component;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Persistence\ManagerRegistry;

final class VankosoftAgent
{
    /** @var string */
    private $agentMail;
    
    /** @var ParameterBagInterface */
    private $params;
    
    /** @var ManagerRegistry */
    private $doctrine;
    
    /** @var TranslatorInterface */
    private $translator;
    
    /** @var MailerInterface */
    private $mailer;
    
    public function __construct(
        ParameterBagInterface $params,
        ManagerRegistry $doctrine,
        TranslatorInterface $translator,
        MailerInterface $mailer
    ) {
        $this->params       = $params;
        $this->doctrine     = $doctrine;
        $this->translator   = $translator;
        $this->mailer       = $mailer;
        
        $this->agentMail    = $this->params->get( 'vs_application.agent_target_email' );
    }
    
    public function userPasswordChanged(
        UserInterface $fromUser,
        UserInterface $changedUser,
        array $data
    ): void {
        $agentEnanled   = $this->params->get( 'vs_agent.enabled' );
        if ( ! $agentEnanled ) {
            return;
        }
        
        $email = ( new TemplatedEmail() )
                ->from( $fromUser->getEmail() )
                ->to( $this->agentMail )
                ->priority( Email::PRIORITY_HIGH )
                ->subject( "[VankoSoft Agent] Agent Email" )
                ->htmlTemplate( '@VSAgent/Agent/agent.html.twig' )
                ->context([
                    'changedUser'   => $changedUser->getUsername(),
                    'fromUser'      => $fromUser->getUsername(),
                    'data'          => $data,
                ]);
        
        $this->mailer->send( $email );
    }
}