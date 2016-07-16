<?php


namespace Ecommerce\BackBundle\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class CommandeAdmin extends AbstractAdmin
{
    /**
     * Configure les champs à ajouter pour l'ajout et la modification
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('reference')
            ->add('date')
            ->add('valid')
            ->add('user');
    }


    /**
     * Configure les champs à trier
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('reference')
            ->add('date')
            ->add('valid')
            ->add('user')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('reference')
            ->add('date')
            ->add('valid')
            ->add('user');
    }

    /**
     * Personnalisation du dashboard
     * @return array
     */
    public function getDashboardActions()
    {
        $actions = parent::getDashboardActions();

        unset($actions['create']);

        return $actions;
    }
}