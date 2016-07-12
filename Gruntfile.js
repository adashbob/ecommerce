'use strict';

module.exports = function (grunt) {

    // Chargement automatiques des packages
    require('load-grunt-tasks')(grunt);

    grunt.initConfig({
        // Validate javascript file
        jshint: {
            all: ['web/js/ajax.js', 'web/bundles/*/js/*.js', '!web/bundles/fosjsrouting/**/*.js']
        },
        // contact file
        concat: {
            dist: {
                src: [
                    'web/js/jquery*.js',
                    'web/js/bootstrap.js',
                    'web/js/ajax.js',
                    'web/bundles/*/js/*.js'
                ],
                dest: 'web/tmp/js/built.js',
            },
        },
        // munify js file
        uglify: {
            options: {
                mangle : false
            },
            dist: {
                files: {
                    'web/tmp/js/min.js': ['web/tmp/js/built.js']
                }
            }
        },
        // munify css file
        cssmin: {
            target: {
                files: {
                    'web/tmp/css/min.css': [
                        'web/css/bootstrap.css',
                        'web/css/bootstrap-responsive.css',
                        'web/css/style.css'
                    ]
                }
            },
            icon: {
                files: {
                    'web/tmp/css/minicon.css': ['web/css/font-awesome.css']
                }
            }
        },
        // Surveille modification des fichiers
        watch: {
            js: {
                files: ['web/**/*.js', '!web/tmp/js/min.js'],
                tasks: ['jshint', 'concat', 'uglify'],
                options: {
                    spawn: false,
                },
            },
            css: {
                files: ['web/**/*.css', '!web/tmp/css/min*.css'],
                tasks: ['cssmin:target'],
                options: {
                    spawn: false,
                },
            },
        },

    });

    // Définition de nouvelles tâches
    grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'cssmin']);

}