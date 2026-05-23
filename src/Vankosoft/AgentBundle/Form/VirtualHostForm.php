<?php namespace Vankosoft\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;

class VirtualHostForm extends AbstractType
{
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add( 'virtualHost', TextType::class, [
                'label'                 => 'vs_issue_tracking.form.project_issue.title',
                'translation_domain'    => 'VSIssueTrackingBundle',
                'required'              => true
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
        return 'vs_issue_tracking_project_kanbanboard_subtask';
    }
}
