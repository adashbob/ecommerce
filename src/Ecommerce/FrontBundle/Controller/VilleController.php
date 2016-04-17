<?php

namespace Ecommerce\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class VilleController extends Controller
{
    public function villeAction($cp)
    {
        $request = $this->get('request_stack')->getCurrentRequest();

        if($request->isXmlHttpRequest()){
            $villesCodePostal = $this->get('doctrine.orm.entity_manager')
                ->getRepository('EcommerceFrontBundle:Ville')
                ->findBy(array('villeCodePostal' => $cp));

            if($villesCodePostal){
                $villes = array();
                foreach ($villesCodePostal as $ville) {
                    $villes[] = $ville->getVilleNom();
                }
            }
            $response = new JsonResponse();

            return $response->setData(array('ville' => $villes));
        }
        else throw new \Exception('Erreur');

    }
}
