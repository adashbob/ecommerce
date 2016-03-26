<?php


namespace Ecommerce\EcommerceBundle\Twig\Extension;


class TvaExtension extends BaseTwigExtension
{

    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('tva', array($this, 'calculTva')));
    }

    public function calculTva($prixHt, $tva){
        return round($prixHt / $tva, 2);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ecommerce_twig_extension';
    }
}