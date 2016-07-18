app.controller('produitCtr', function ($scope, $http) {
    $scope.produits = [];
    $scope.baseImage = baseImage;
    $http({
        method: 'GET',
        url: Routing.generate('api_get_produits')
    }).then(
        function success(response) {
            $scope.produits = response.data;
        },
        function error(response) {
            console.log("Erreur statut="+response.statusText);
        });
});

