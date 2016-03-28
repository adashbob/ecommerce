<?php

namespace Ecommerce\EcommerceBundle\Services;



use Doctrine\ORM\EntityNotFoundException;
use Ecommerce\EcommerceBundle\Entity\Commande;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class Facturation
{
    private $produitManager;
    private $panierSession;
    private $clientManager;
    private $commandeManager;
    private $facture;
    private $totalHT;
    private $totalTVA;
    private $panier;
    private $adresse;
    private $security;

    public function __construct(ContainerInterface $containerInterface)
    {
        $this->produitManager = $containerInterface->get('produit_manager');
        $this->clientManager = $containerInterface->get('client_manager');
        $this->commandeManager = $containerInterface->get('commande_manager');
        $this->panierSession = $containerInterface->get('panier_session');
        $this->security = $containerInterface->get('security.token_storage');
        $this->facture = array();
        $this->totalHT = 0;
        $this->totalTVA = 0;
        $this->panier = $this->panierSession->get('panier');
        $this->adresse = $this->panierSession->get('adresse');
    }

    /**
     * @return Commande|mixed
     */
    public function prepareCommande()
    {
        if($this->panierSession->has('commande')){
            $commande = $this->panierSession->get('commande');
        }else{
            $commande = new Commande();
        }

        $commande->setDate(new \DateTime());
        $commande->setUser($this->security->getToken()->getUser());
        $commande->setValid(0);
        $commande->setReference(0);
        $commande->setFacture($this->doFacture());

        if (!$this->panierSession->has('commande')) {
            $this->commandeManager->persit($commande);
            $this->panierSession->set('commande', $commande);
        }
        $this->commandeManager->flushEntity();

        return $commande;
    }

    /**
     * Recupère les produits du panier et calcule les prix et ajoute les
     * adresse de livraison et de facturation
     * @return array
     */
    public function doFacture()
    {
        $produits = $this->produitManager->findProduitsInArray(array_keys($this->panier));

        $this->calcul($produits);
        $this->addAdresseInCommande('livraison');
        $this->addAdresseInCommande('facturation');

        $this->facture['prixHT'] = round($this->totalHT, 2);
        $this->facture['prixTTC'] = round($this->totalHT + $this->totalTVA, 2);
        $this->facture['token'] = bin2hex(random_bytes(20));

        return $this->facture;
    }

    /**
     * @param $id
     * @throws EntityNotFoundException
     */
    public function validerCommande($id)
    {
        $commande = $this->commandeManager->getCommande($id);

        if (!$commande || $commande->getValid())
            throw new EntityNotFoundException('La commande n\'existe pas');

        $commande->setValid(true);
        $commande->setReference($this->getReference());
        $this->commandeManager->flushEntity();

        $this->panierSession->remove('adresse');
        $this->panierSession->remove('panier');
        $this->panierSession->remove('commande');
    }

    /**
     * @param $produits
     */
    private function calcul($produits)
    {
        foreach($produits as $produit)
        {
            $prixHT = ($produit->getPrice() * $this->panier[$produit->getId()]);
            $prixTTC = ($produit->getPrice() * $this->panier[$produit->getId()] / $produit->getTva()->getMultiplicate());
            $this->totalHT += $prixHT;

            if (!isset($this->facture['tva']['%'.$produit->getTva()->getValue()]))
                $this->facture['tva']['%'.$produit->getTva()->getValue()] = round($prixTTC - $prixHT, 2);
            else
                $this->facture['tva']['%'.$produit->getTva()->getValue()] += round($prixTTC - $prixHT, 2);

            $this->totalTVA += round($prixTTC - $prixHT, 2);

            $this->addProduitsInCommande($produit);
        }
    }

    /**
     * @param $produit
     */
    private function addProduitsInCommande($produit)
    {
        $this->facture['produit'][$produit->getId()] = array(
            'reference' => $produit->getName(),
            'quantite' => $this->panier[$produit->getId()],
            'prixHT' => round($produit->getPrice(), 2),
            'prixTTC' => round($produit->getPrice() / $produit->getTva()->getMultiplicate(), 2));
    }

    /**
     * @param $type
     */
    private function addAdresseInCommande($type)
    {
        $client = $this->clientManager->getClient($this->adresse[$type]);
        $this->facture[$type] = $this->clientManager->arrayClient($client);

    }

    public function getReference(){
        $commande = $this->commandeManager
            ->getRepository()
            ->findOneBy(array('valid' => true), array('id' => 'DESC'), 1, 1);

        return !$commande ? 1 : $commande->getReference() + 1;
    }
}