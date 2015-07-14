<?php

namespace DM\AnalyticsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportType extends AbstractType
{
    private $trends;

    public function __construct(array $trends)
    {
        $this->trends = $trends;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateFrom','date',array('label'=>'Date from'))
        
                ->add('dateTo','date',array('label'=>'Date to'))
        
                ->add('trend','choice',array('label'=>'Trend','choices'=>$this->trends))

                ->add('submit','submit',array('label'=>'Save'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'DM\AnalyticsBundle\Form\Model\Report',
        ));
    }

    public function getName()
    {
        return 'report';
    }
}