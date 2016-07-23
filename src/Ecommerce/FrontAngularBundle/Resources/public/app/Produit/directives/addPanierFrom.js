'use strict';

app.directive('addPanierForm', function ($rootScope) {
    if($rootScope.panier ==  0)
        return {
            templateUrl : baseViewProduit + 'partials/_addPanierForm.html',
            restrict : 'E'
        }
    else
        return {
            templateUrl : baseViewProduit + 'vide.html'
        }
});