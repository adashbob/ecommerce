<?php

namespace Ecommerce\FrontBundle\Form\Type;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;


class ClientType extends AbstractType
{
    protected $container;

    public function __construct(ContainerInterface $container){
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('telephone')
            ->add('adresse')
            ->add('cp', null, array('attr' => array('class' => 'cp', 'maxlength' => 5)))
            ->add('ville', ChoiceType::class, array('attr' => array('class' => 'ville')))
            ->add('complement')
            ->add('pays', CountryType::class)
        ;
       $this->addEventListener($builder);
    }

    private function addEventListener(FormBuilderInterface $builder)
    {
        $city = function(FormInterface $form, $cp) {
            $villeCP = $this->container->get('doctrine.orm.default_entity_manager')
                ->getRepository('EcommerceFrontBundle:Ville')
                ->findBy(array('villeCodePostal' => $cp));

            if ($villeCP) {
                $villes = array();
                foreach($villeCP as $ville) {
                    $villes[$ville->getVilleNom()] = $ville->getVilleNom();
                }
            } else {
                $villes = null;
            }

            $form->add('ville', ChoiceType::class, array(
                'attr' => array('class'   => 'ville'),
                'choices' => $villes));
        };

        $builder->get('cp')->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) use ($city) {
                $city($event->getForm()->getParent(), $event->getForm()->getData());
            });
    }


    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\FrontBundle\Entity\Client'
        ));
    }


}
