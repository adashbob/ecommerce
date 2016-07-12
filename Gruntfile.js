'use strict';

module.exports = function (grunt) {

    grunt.initConfig({
        concat: {
            dist: {
                src: ['web/js/jquery*.js', 'web/js/bootstrap.js', 'web/js/ajax.js', 'web/bundles/*/js/*.js'],
                dest: 'web/tmp/built.js',
            },
        },
        uglify: {
            dist: {
                files: {
                    'web/tmp/build-min.js': ['web/tmp/built.js']
                }
            }
        },
    });

    // Chargement des tâches
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Définition de nouvelles tâches
    grunt.registerTask('default', ['concat', 'uglify']);

}