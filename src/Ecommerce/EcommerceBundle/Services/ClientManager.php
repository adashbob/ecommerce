<?php

namespace Ecommerce\EcommerceBundle\Services;


use Ecommerce\EcommerceBundle\Entity\Client;

class ClientManager extends EcommerceManager
{

    public function getClient($id)
    {
        return $this->repository->find($id);
    }

    public function clientArray(Client $client)
    {
        return array('prenom' => $client->getPrenom(),
            'nom' => $client->getNom(),
            'telephone' => $client->getTelephone(),
            'adresse' => $client->getAdresse(),
            'cp' => $client->getCp(),
            'ville' => $client->getVille(),
            'pays' => $client->getPays(),
            'complement' => $client->getComplement());
    }


}