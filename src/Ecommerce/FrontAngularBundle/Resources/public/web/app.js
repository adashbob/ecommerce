'use strict';

var app = angular.module('appEcommerce', ['ngRoute']);
var baseView = '/bundles/ecommercefrontangular/web/js/views/';
var baseImage = 'upload/';

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: baseView + 'Produits/index.html.twig',
            controller: 'produitCtr'
        }).otherwise({redirect : '/'});
});

