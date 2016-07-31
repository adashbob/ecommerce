define([
    'angular',
    'angular-route',
    'angular-resource'
],
    function (angular) {
        var app = angular.module('app', ['ngResource', 'ngRoute']);

        app.run(['$rootScope', function ($rootScope) {
            $rootScope.baseViewProduit = '/bundles/ecommercefrontangular/app/Produit/views/';
            $rootScope.baseViewCat = '/bundles/ecommercefrontangular/app/Categorie/views/';
            $rootScope.baseImage = '/upload/';
            $rootScope.panier = 0;

            console.log('------------ app Module Loaded! -----------');
        }]);

        return app;
    }
)

/*
var app = angular.module('appEcommerce', ['ngRoute', 'ngResource']);

var baseViewProduit = '/bundles/ecommercefrontangular/app/Produit/views/';
var baseViewCat = '/bundles/ecommercefrontangular/app/Categorie/views/';

/!*app.run(function ($rootScope) {
    $rootScope.baseImage = '/upload/';
    $rootScope.panier = 0;

});*!/
app.run(['$rootScope',
    function ($rootScope) {

        $rootScope.baseImage = '/upload/';
        $rootScope.panier = 0;
        console.log('----------- Ecommerce Loaded! -----------');
    }
]);

app.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            controller: 'allProduitsCtr',
            templateUrl: baseViewProduit + 'index.html'
        })
        .when('/produits/:id', {
            controller: 'oneProduitCtr',
            templateUrl: baseViewProduit + 'produit.html'
        })
        .when('/categories/:id', {
            controller: 'produitsOfCatCtr',
            templateUrl: baseViewProduit + 'index.html'
        })
        .otherwise({redirect : '/'})

});

*/
