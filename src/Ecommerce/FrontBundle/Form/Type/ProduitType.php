<?php

namespace Ecommerce\FrontBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('type', ChoiceType::class, array(
                'mapped'  => false,
                'choices' => array('Légume' => '0', 'Fruit' => '1', 'Céréale' => '2')
            ))
            ->add('pays', CountryType::class, array('mapped' => false))
            ->add('client', EntityType::class, array(
                'class'   => 'UserBundle\Entity\User',
                'mapped'  => false
            ))
            ->add('available')
            ->add('Envoyer', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\FrontBundle\Entity\Produit'
        ));
    }
}
