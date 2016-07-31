define(['app'], function (app) {

    app.directive('addOroduitPanierForm', [
        '$rootScope',
        function ($rootScope) {
            return {
                templateUrl : $rootScope.baseViewProduit + 'partials/_addProduitInPanierForm.html',
                restrict : 'E'
            }
        }
    ])
})

/*/!* directive addProduitInPanierForm.js *!/
'use strict';

app.directive('addProduitInPanierForm', function () {
    return {
        templateUrl : baseViewProduit + 'partials/_addProduitInPanierForm.html',
        restrict : 'E'
    }
});*/

/*
define([], function () {
    'use strict';

    function addProduitInPanierForm() {
        return {
            templateUrl : baseViewProduit + 'partials/_addProduitInPanierForm.html',
            restrict : 'E'
        }
    }


    return addProduitInPanierForm;
})*/
