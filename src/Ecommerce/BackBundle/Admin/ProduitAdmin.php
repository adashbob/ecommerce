<?php


namespace Ecommerce\BackBundle\Admin;


use Ecommerce\FrontBundle\Form\Type\MediaType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitAdmin extends AbstractAdmin
{

    /**
     * Configure les champs à ajouter pour l'ajout et la modification
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
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
            ->add('available');
    }

    /**
     * Configure les champs à trier
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('categorie')
            ->add('available');

    }

    /**
     * Les colonnes à afficher
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('price')
            ->add('categorie')
            ->add('client')
            ->add('available');
    }
}