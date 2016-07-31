'use strict';

// Surveille modification des fichiers

module.exports = function (grunt) {
    grunt.config.set('watch', {
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
        }
    });
}