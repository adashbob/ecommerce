define(['app'], function (app) {

    app.directive('addPanierForm', [
        '$rootScope',
        function ($rootScope) {
            if($rootScope.panier ==  0)
                return {
                    templateUrl : $rootScope.baseViewProduit + 'partials/_addPanierForm.html',
                    restrict : 'E'
                }
            else
                return {
                    templateUrl : $rootScope.baseViewProduit + 'vide.html'
                }
        }
    ])
})

/*'use strict';

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
});*/

/*
define([], function () {
    'use strict';

    function addPanierForm($rootScope) {
        if ($rootScope.panier == 0)
            return {
                templateUrl: baseViewProduit + 'partials/_addPanierForm.html',
                restrict: 'E'
            }
        else
            return {
                templateUrl: baseViewProduit + 'vide.html'
            }
    }

    addPanierForm.$inject = ['$rootScope'];

    return addPanierForm;
})*/
