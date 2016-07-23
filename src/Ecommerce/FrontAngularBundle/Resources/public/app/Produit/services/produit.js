'use strict';

app
    .factory('ProduitFactory', function ($http, $q) {
        var factory  = {
            produits : [],
            panier : false,
            // Liste des produits
            get : function(options){
                var deferred = $q.defer();
                if(factory.produits.length != 0){
                    factory.resolveData(deferred, [factory.produits, factory.panier]);
                }else{
                    $http.get(Routing.generate('api_get_produits'))
                        .then(
                            function success(response){
                                factory.produits = response.data.produits;
                                factory.panier = response.data.panier;
                                factory.resolveData(deferred, [factory.produits, factory.panier]);
                            },
                            function error(response){
                                deferred.reject('Impossible de trouver les produits')
                            }
                        )
                }
                return deferred.promise;
            },
            // Trouver un produits
            find : function (id) {
                var produit = {};
                var deferred = $q.defer();
                var produits = factory.get().then(function (produits) {
                    angular.forEach(produits, function (value, key) {
                        if (value.id == id){
                            produit = value;
                        }
                    });
                    deferred.resolve(produit);
                }, function (msg) {
                    deferred.reject(msg);
                });
                return deferred.promise;
            },
            resolveData : function(promise, datas){
                angular.forEach(datas, function (value){
                    promise.resolve(value);
                })
            }
        }
        return factory;
    })