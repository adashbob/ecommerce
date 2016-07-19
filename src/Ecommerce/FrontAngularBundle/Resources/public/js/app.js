'use strict';

var app = angular.module('appEcommerce', ['ngRoute']);

app.run(function ($rootScope) {
    $rootScope.baseView = '/bundles/ecommercefrontangular/web/js/views/';
    $rootScope.baseImage = '/upload/';
});

var baseView = '/bundles/ecommercefrontangular/web/js/views/';
var baseImage = '/upload/';

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

