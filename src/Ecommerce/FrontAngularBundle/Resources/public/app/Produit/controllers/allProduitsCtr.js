app.controller('allProduitsCtr', function ($scope, ProduitFactory, $rootScope) {
    $scope.produits = [];
    $scope.produits = ProduitFactory.get().then(function (response) {
        $scope.produits = response;

    });
});

