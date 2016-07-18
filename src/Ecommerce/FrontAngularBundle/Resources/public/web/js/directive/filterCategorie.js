'use strict';

app.directive('filterByCategorie', function () {
    return {
        controller: 'filterCatCtr',
        templateUrl : baseView + 'Produits/_filterCategorie.html.twig',
        restrict : 'E'
    }
});