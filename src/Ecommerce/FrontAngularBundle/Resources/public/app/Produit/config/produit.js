define(['app'], function (app) {

    app.config[
        '$routeProvider',
        '$rootScope',
        function ($routeProvider, $rootScope) {
            $routeProvider
                .when('/', {
                    controller: 'allProduitsCtr',
                    templateUrl: '/bundles/ecommercefrontangular/app/Produit/views/index.html'
                })
                .when('/produits/:id', {
                    controller: 'oneProduitCtr',
                    templateUrl: $rootScope.baseViewProduit + 'produit.html'
                })
                .otherwise({redirect : '/'})
        }
    ];
    console.log('------------ Produit config loaded! ----------------');
})

/*
define([], function () {
    'use strict';

    function config($routeProvider) {
        $routeProvider
            .when('/', {
                controller: 'allProduitsCtr',
                templateUrl: baseViewProduit + 'index.html'
            })
            .when('/produits/:id', {
                controller: 'oneProduitCtr',
                templateUrl: baseViewProduit + 'produit.html'
            })
            .otherwise({redirect : '/'})
    }

    config.$inject = ['$routeProvider'];

    return config;
})*/
