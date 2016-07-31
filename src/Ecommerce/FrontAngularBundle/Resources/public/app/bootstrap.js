// bootstrap.js

define([
    'angular',
    'app',
], function (angular, app){
    'use strict';

    console.log('------------ bootstrap started ------------');
    angular.bootstrap(document, ['app']);
});

/*
require(['angular', 'app'],
    function() {
        console.log('Core Module started ...');
        angular.bootstrap(document, ['app']);
    }
);*/
