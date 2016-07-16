<?php


namespace Ecommerce\BackBundle\Admin;


use Ecommerce\FrontBundle\Form\Type\MediaType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class ClientAdmin extends AbstractAdmin
{

    /**
     * Configure les champs à ajouter pour l'ajout et la modification
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Info Client    ', array('class' => 'col-md-6'))
                ->add('nom')
                ->add('prenom')
                ->add('adresse')
                ->add('telephone')
            ->end()
            ->with('Plus d\'info', array('class' => 'col-md-6'))
                ->add('cp')
                ->add('pays', CountryType::class, array('mapped' => true))
                ->add('ville')
                ->add('user')
            ->end()

           ;
    }

    /**
     * Configure les champs à trier
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('telephone')
            ->add('ville');

    }

    /**
     * Les colonnes à afficher
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nom') // contient le lien de modification de l'entité
            ->add('prenom')
            ->add('adresse')
            ->add('telephone')
            ->add('ville')
            ->add('user');
    }
}