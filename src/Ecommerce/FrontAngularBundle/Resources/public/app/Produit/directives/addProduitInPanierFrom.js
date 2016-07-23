/* directive addProduitInPanierForm.js */
'use strict';

app.directive('addProduitInPanierForm', function () {
    return {
        templateUrl : baseViewProduit + 'partials/_addProduitInPanierForm.html',
        restrict : 'E'
    }
});