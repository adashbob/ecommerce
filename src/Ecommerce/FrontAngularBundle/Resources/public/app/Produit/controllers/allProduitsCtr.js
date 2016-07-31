define(['app'], function (app) {

    app.controller('allProduitsCtr', [
        '$rootScope',
        'ProduitFactory',
        '$scope',
        function ($scope, ProduitFactory, $rootScope) {
            $scope.produits = [];
            $scope.produits = ProduitFactory.get().then(function (response) {
                $scope.produits = response;
                console.log(response);

            });
        }
    ]);
    console.log('------------ All Produits Controlllers ---------------');
});
/*app.controller('allProduitsCtr', function ($scope, ProduitFactory, $rootScope) {
    $scope.produits = [];
    $scope.produits = ProduitFactory.get().then(function (response) {
        $scope.produits = response;

    });
});*/

// Produit/controllers/allProduitsCtr.js
/*

define([], function () {
    'use strict';
    
    function allProduitsCtr($scope, $http) {
        $scope.produits = [];
        console.log('fff');
        $scope.produits = $http.get(Routing.generate('api_get_produits')).then(
            function (response) {
                console.log(response);
                $scope.produits = response.produits;
            },
            function (msg) {
                console.log(msg);
            }
        )
       /!* $scope.produits = ProduitFactory.get().then(function (response) {
            $scope.produits = response;

        })*!/
        
    }

    allProduitsCtr.$inject = ['$scope', '$http'];

    return allProduitsCtr;
})*/
