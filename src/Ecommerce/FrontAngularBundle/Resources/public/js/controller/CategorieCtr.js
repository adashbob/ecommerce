'use strict'

app
    // Menu
    .controller('filterCatCtr', function ($scope, $http) {
        $scope.categories = [];
        $http
            .get(Routing.generate('api_get_categories'))
            .then(function (response) {
                $scope.categories = response.data.categories;
            })
    })

    // Produits d'une même catégorie
    .controller('produitsOfCatCtr', function ($scope, $http, $routeParams) {
        $scope.produits = [];
        $scope.categorieName = null;

        $http
            .get(Routing.generate('api_get_categorie', {id : $routeParams.id}))
            .then(
                function success(response){
                    $scope.produits = response.data.produits;
                    $scope.categorieName = response.data.categorieName;
                },
                function error(response) {}
            )
    })