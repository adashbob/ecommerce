'use strict';

app
    .factory('CategorieFactory', function ($http, $q) {
        var factory  = {
            categories : [],
            panier : false,
            get : function(options){
                var deferred = $q.defer();
                if(factory.categories.length != 0){
                    factory.resolveData(deferred, [factory.categories, factory.panier]);
                }else{
                    $http.get(Routing.generate('api_get_categories'))
                        .then(
                            function success(response){
                                factory.categories = response.data.categories;
                                factory.panier = response.data.panier;
                                factory.resolveData(deferred, [factory.categories, factory.panier]);
                            },
                            function error(response){
                                deferred.reject('Impossible de trouver les catégories')
                            }
                        )
                }
                return deferred.promise;
            },
            // Trouver les produits d'une categories
            findProduits : function (id) {
                var produits = null;
                var deferred = $q.defer();
                var categories = factory.get().then(function (categories) {
                    angular.forEach(categories, function (value, key) {
                        if (value.id == id){
                            produits = value.produits;
                        }
                    });
                    deferred.resolve(produits);
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