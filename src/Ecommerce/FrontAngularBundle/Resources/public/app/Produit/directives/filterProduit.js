'use strict';

app.directive('filterProduit', function () {
    return {
        templateUrl : baseViewProduit + 'partials/_filterProduit.html',
        restrict: 'E'
    }
});