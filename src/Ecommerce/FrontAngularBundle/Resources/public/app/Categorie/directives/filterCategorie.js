'use strict';

app.directive('filterByCategorie', function () {
    return {
        controller: 'filterCatCtr',
        templateUrl : baseViewCat + 'partials/_filterCategorie.html',
        restrict : 'E'
    }
});