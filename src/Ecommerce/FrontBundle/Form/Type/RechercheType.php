<?php


namespace Ecommerce\FrontBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recherche', SearchType::class, array(
                'label' => false,
                'attr' => array('class' => 'input-medium search-query')));;
    }


}