/* main.js */
'use strict';

require.config({

    // alias of paths modules
    paths : {
        'jquery' : '../../../../lib/jquery/dist/jquery',
        'bootstrapLib' : '../../../../tmp/js/bootstrap',
        'angular-route' : '../../../../lib/angular-route/angular-route',
        'angular-resource' : '../../../../lib/angular-resource/angular-resource',
        'angular' : '../../../../lib/angular/angular'
    },

    // dependancies of modules do not supported by AMD
    shim : {
        'angular-route' : {
            deps : ['angular'],
            exports : 'angular'
        },
        'angular-resource' : {
            deps : ['angular'],
            exports : 'angular'
        },
        'angular' : {
            exports : 'angular',
            deps : ['jquery']
        },
        'bootstrapLib' : {
            deps : ['jquery']
        },
        'jquery' : {
            exports : 'jquery'
        }
    },

    // Kick start
    deps : [
        './Produit/ProduitModule',
        'bootstrap'
    ],
    priority: [
        "angular"
    ]
})