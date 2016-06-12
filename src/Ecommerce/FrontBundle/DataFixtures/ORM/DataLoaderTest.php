<?php


namespace Ecommerce\FrontBundle\DataFixtures\ORM;


use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class DataLoaderTest extends AbstractLoader
{
    /**
     * {@inheritdoc}
     */
    public function getFixtures()
    {
        return [
            __DIR__.'/Dev/medias.yml',
            __DIR__.'/Dev/categories.yml',
            __DIR__.'/Dev/clients.yml',
            __DIR__.'/Dev/tva.yml',
            __DIR__.'/Dev/produits.yml',
            '@UserBundle/DataFixtures/ORM/Dev/users.yml'
        ];
    }

    /**
     * Fornis le nom des categories au fixture categorie.yml
     * @param $id
     * @return mixed
     */
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