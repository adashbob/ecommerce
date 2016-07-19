app
    // get all produits
    .controller('allProduitsCtr', function ($scope, $http) {
        $scope.produits = [];
        $scope.baseImage = baseImage;
        $http({
            method: 'GET',
            url: Routing.generate('api_get_produits')
        }).then(
            function success(response) {
                $scope.produits = response.data.produits;
                $scope.panier = response.data.panier;
                console.log(response.data.panier);
            },
            function error(response) {
                console.log("Erreur statut="+response.statusText);
            });
    })

    // get produit by id
    .controller('oneProduitCtr', function ($scope, $http, $routeParams) {
        $scope.produit = null;
        $http
            .get(Routing.generate('api_get_produit', {id : $routeParams.id}))
            .then(
                function success(response){
                    $scope.produit = response.data.produit;
                    $scope.panier = response.data.panier;
                    console.log($scope.produit);
                },
                function error (response){
                    $scope.error = response.data.error;
                });
    })

