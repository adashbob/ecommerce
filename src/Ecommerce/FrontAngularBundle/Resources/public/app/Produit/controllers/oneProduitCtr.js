define(['app'], function (app) {

    app.controller('oneProduitCtr', [
        '$scope',
        '$routeParams',
        'ProduitFactory',
        function ($scope, $routeParams, ProduitFactory) {
            $scope.produit = {};
            $scope.produit = ProduitFactory.find($routeParams.id).then(
                function (produit) {
                    $scope.produit = produit;

                },
                function (msg) {
                    console.log(msg);
                });
        }
    ]);
})

/*app.controller('oneProduitCtr', function ($scope, $routeParams, ProduitFactory, $rootScope) {
        $scope.produit = {};
        $scope.produit = ProduitFactory.find($routeParams.id).then(
            function (produit) {
                $scope.produit = produit;

            },
            function (msg) {
                console.log(msg);
            })

    })*/

/*

define([], function () {
    'use strict';

    function oneProduitCtr($scope, $routeParams, ProduitFactory) {
        $scope.produit = {};
        $scope.produit = ProduitFactory.find($routeParams.id).then(
            function (produit) {
                $scope.produit = produit;

            },
            function (msg) {
                console.log(msg);
            });

    }

    oneProduitCtr.$inject = ['$scope', '$routeParams', 'ProduitFactory'];

    return oneProduitCtr;
})*/
