'use strict';

var app = angular.module('appEcommerce', ['ngRoute']);

var baseView = '/bundles/ecommercefrontangular/js/views/';

app.run(function ($rootScope) {
    $rootScope.baseImage = '/upload/';

});

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            controller: 'allProduitsCtr',
            templateUrl: baseView + 'Produits/index.html'
        })
        .when('/produits/:id', {
            controller: 'oneProduitCtr',
            templateUrl: baseView + 'Produits/produit.html'
        })
        .when('/categories/:id', {
            controller: 'produitsOfCatCtr',
            templateUrl: baseView + 'Produits/index.html'
        })
        .otherwise({redirect : '/'})

});

