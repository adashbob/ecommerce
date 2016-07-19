<?php

namespace Ecommerce\FrontRestBundle\Controller;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{


    /**
     * @ApiDoc(resource=true, description="Obtenir la liste des catégories")
     */
    public function getCategoriesAction()
    {
        return array('categories' => $this->get('categorie_manager')->getAll());
    }

    /**
     * @ApiDoc(resource=true, description="Ajouter une categorie")
     */
    public function postCategoriesAction()
    {
    }

    /**
     * @ApiDoc(
     *     resource=true, description="Obtenir une categorie par son id",
     *     requirements={
     *      {
     *          "name"="id",
     *          "dataType"="integer",
     *          "requirement"="\d+"
     *      }},
     *     statusCodes={
     *         200="Returned when successful",
     *         403="Returned when the user is not authorized to say hello",
     *         404={
     *           "Returned when the user is not found",
     *           "Returned when something else is not found"
     *         }
     *     },
     *     parameters={
     *      {"name"="id", "dataType"="integer", "required"=true, "description"="categorieid"}
     *  })
     */

    public function getCategorieAction($id)
    {
        $id = (int) $id;
        $categorie = $this->get('categorie_manager')->getCategorie($id);

        if(!$categorie){
            array('error' => 'La catégorie n\'existe pas');
        }

        return array(
            'produits' => $categorie->getProduits(),
            'categorieName' => $categorie->getName(),
            'panier' => $this->get('panier_session')->has('panier')
        );
    }

    /**
     * @ApiDoc(resource=true, description="Modifier une catégorie")
     */
    public function updateCategorieAction($slug)
    {
    }

    /**
     * @ApiDoc(resource=true, description="Supprimer une catégorie")
     */
    public function deleteCategorieAction($id)
    {
    }


    /**
     * @ApiDoc(resource=true, description="Obtenir les produits d'une même catégorie")
     */
    public function getCategorieProduitsAction($id){

    }
}
