'use strict';

app.controller('produitsOfCatCtr', function ($scope, $routeParams, CategorieFactory) {
    $scope.produits = [];
    $scope.categorieName = null;
    $scope.produits = CategorieFactory.findProduits($routeParams.id).then(
        function (produits) {
            $scope.produits = produits;
        },
        function (msg) {
            console.log(msg);
        }
    )
});