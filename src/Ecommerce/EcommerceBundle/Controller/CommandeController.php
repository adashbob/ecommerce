<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CommandeController extends Controller
{
    /**
     * @Route("/prepareCommande")
     */
    public function prepareCommandeAction()
    {
        $panierSession =  $this->get('panier_session');
        $commandeManager = $this->get('commande_manager');

        if($panierSession->has('commande')){
            $commande = new Commande();
        }else{
            $commande = $commandeManager->getCommande($panierSession->get('commande'));
        }
        $commande->setDate(new \DateTime());
        $commande->setUser($this->getUser());
        $commande->setValid(0);
        $commande->setReference(0);
        $commande->setCommande($this->facture());

        if (!$panierSession->has('commande')) {
            $commandeManager->persit($commande);
            $panierSession->set('commande',$commande);
        }

        $commandeManager->flush();

        return new Response($commande->getId());
    }

    public function facture()
    {
        $panier = $this->get('panier_session')->get('panier');
        $commande = array();
        $totalHT = 0;
        $totalTVA = 0;

        $produits = $this->get('produit_manager')->findProduitsInArray(array_keys($panier));

        $this->calcul($produits, $panier, $totalTVA, $totalHT);
        $commande = $this->addLivraisonInCommande($commande);
        $commande = $this->addFacturationInCommande($commande);

        $commande['prixHT'] = round($totalHT,2);
        $commande['prixTTC'] = round($totalHT + $totalTVA,2);
        $commande['token'] = bin2hex(random_bytes(20));

        return $commande;
    }

    private function calcul($produits, $panier, $totalTVA, $totalHT)
    {
        foreach($produits as $produit)
        {
            $prixHT = ($produit->getPrice() * $panier[$produit->getId()]);
            $prixTTC = ($produit->getPrice() * $panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
            $totalHT += $prixHT;

            if (!isset($commande['tva']['%'.$produit->getTva()->getValue()]))
                $commande['tva']['%'.$produit->getTva()->getValue()] = round($prixTTC - $prixHT, 2);
            else
                $commande['tva']['%'.$produit->getTva()->getValue()] += round($prixTTC - $prixHT, 2);

            $totalTVA += round($prixTTC - $prixHT, 2);

            $commande = $this->addProduitsInCommande($commande, $produit, $panier);
        }
    }

    private function addProduitsInCommande($commande, $produit, $panier)
    {
        $commande['produit'][$produit->getId()] = array('reference' => $produit->getNom(),
            'quantite' => $panier[$produit->getId()],
            'prixHT' => round($produit->getPrix(), 2),
            'prixTTC' => round($produit->getPrix() / $produit->getTva()->getMultiplicate(),2));
        return $commande;
    }
    private function addLivraisonInCommande($commande)
    {
        $adresse = $this->get('panier_session')->get('adresse');
        $livraison = $this->get('client_manager')->getClient($adresse['livraison']);
        $commande['livraison'] = $this->get('client_manager')->clientArray($livraison);
        return $commande;
    }

    private function addFacturationInCommande($commande)
    {
        $adresse = $this->get('panier_session')->get('adresse');
        $facturation = $this->get('client_manager')->getClient($adresse['facturation']);

        $commande['facturation'] = $this->get('client_manager')->clientArray($facturation);
        return $commande;
    }


}
