app
    // get all produits
    .controller('allProduitsCtr', function ($scope, ProduitFactory) {
        $scope.produits = [];
        $scope.produits = ProduitFactory.get().then(function (response) {
            $scope.produits = response;
        });
    })

    // get produit by id
    .controller('oneProduitCtr', function ($scope, $routeParams, ProduitFactory) {
        $scope.produit = {};
        $scope.produit = ProduitFactory.find($routeParams.id).then(
            function (produit) {
               $scope.produit = produit;
            },
            function (msg) {
                console.log(msg);
            })

    })

