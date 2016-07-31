define(['app'], function (app) {

    app.directive('filterProduit', [
        '$rootScope',
        function ($rootScope) {
            return {
                templateUrl : $rootScope.baseViewProduit + 'partials/_filterProduit.html',
                restrict: 'E'
            }
        }
    ])
})
/*'use strict';

app.directive('filterProduit', function () {
    return {
        templateUrl : baseViewProduit + 'partials/_filterProduit.html',
        restrict: 'E'
    }
});*/

/*
define([], function () {
    'use strict';

    function filterProduit() {
        return {
            templateUrl : baseViewProduit + 'partials/_filterProduit.html',
            restrict: 'E'
        }
    }


    return filterProduit;
})*/
