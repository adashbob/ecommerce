<?php


namespace Ecommerce\FrontBundle\DataFixtures\ORM\Dev;


use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class DataLoader extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__.'/medias.yml',
            __DIR__.'/categories.yml',
            __DIR__.'/clients.yml',
            __DIR__.'/tva.yml',
            __DIR__.'/produits.yml',
            '@UserBundle/DataFixtures/ORM/Dev/users.yml'
        ];
    }

    public function categorieName($id){

        $names = array(
            "Légume",
            'Fruit',
            'Epice',
            'Légume Frais',
            'Pâte'
        );

        return $names[$id];
    }
}