'use strict';

app.controller('filterCatCtr', function ($scope, CategorieFactory) {
        $scope.categories = [];
        $scope.categories  = CategorieFactory.get().then(
            function (categories) {
                $scope.categories = categories;
            },
            function (msg) {
                console.log(msg);
            }
        )
    });

