'use strict'

app.controller('filterCatCtr', function ($scope, $http) {
    $scope.categories = []; 
    $http
        .get(Routing.generate('api_get_categories'))
        .then(function (response) {
            $scope.categories = response.data;
        })
})