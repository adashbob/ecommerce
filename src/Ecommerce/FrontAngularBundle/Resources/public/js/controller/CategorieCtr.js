'use strict';

app
    // Menu
    .controller('filterCatCtr', function ($scope, CategorieFactory) {
        $scope.categories = [];
        $scope.categories  = CategorieFactory.get().then(
            function (categories) {
                $scope.categories = categories;
            },
            function (msg) {
                console.log(msg);
            }
        )
    })

    // Produits d'une même catégorie
    .controller('produitsOfCatCtr', function ($scope, $routeParams, CategorieFactory) {
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
    })