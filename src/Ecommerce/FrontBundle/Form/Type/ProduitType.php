<?php

namespace Ecommerce\FrontBundle\Form\Type;

use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('name', null, array('required' => false))
            ->add('description', TextareaType::class)
            ->add('price')
            ->add('categorie')
            ->add('pays', CountryType::class, array('mapped' => false))
            ->add('client', EntityType::class, array(
                'class'   => 'UserBundle\Entity\User',
                'mapped'  => false
            ))
            ->add('tva')
            ->add('image', MediaType::class)
            ->add('available')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\FrontBundle\Entity\Produit',
        ));
    }

    public function getName(){
        'bobobobo';
    }
    public function getBlockPrefix()
    {
        return $this->getName();
    }
}
