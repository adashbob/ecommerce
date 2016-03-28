<?php


namespace Ecommerce\FrontBundle\Twig\Extension;


class MontantTvaExtension extends BaseTwigExtension
{


    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('montantTva', array($this, 'montantTva')));
    }

    public function montantTva($prixHt, $tva){
        return round((($prixHt / $tva) - $prixHt), 2);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'montant_tva_extension';
    }
}