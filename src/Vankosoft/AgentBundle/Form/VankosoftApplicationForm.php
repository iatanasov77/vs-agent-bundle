<?php namespace Vankosoft\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class VankosoftApplicationForm extends AbstractType
{
    /** @var string */
    private $applicationClass;
    
    public function __construct(
        string $applicationClass
    ) {
        $this->applicationClass = $applicationClass;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add( 'application', EntityType::class, [
                'label'                 => 'vs_agent.form.vankosoft_application.form.vankosoft_application',
                'placeholder'           => 'vs_agent.form.form.vankosoft_application.vankosoft_application_placeholder',
                'translation_domain'    => 'VSAgentBundle',
                
                'class'                 => $this->applicationClass,
                'choice_label'          => 'title'
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
    {
        parent::configureOptions( $resolver );
        
        $resolver->setDefaults([
            'csrf_protection'   => false,
        ]);
    }
    
    public function getName()
    {
        return 'vs_agent_vankosoft_application';
    }
}
