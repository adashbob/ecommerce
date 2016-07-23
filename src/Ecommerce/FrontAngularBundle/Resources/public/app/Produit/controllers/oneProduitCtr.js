app.controller('oneProduitCtr', function ($scope, $routeParams, ProduitFactory, $rootScope) {
        $scope.produit = {};
        $scope.produit = ProduitFactory.find($routeParams.id).then(
            function (produit) {
                $scope.produit = produit;

            },
            function (msg) {
                console.log(msg);
            })

    })

