'use strict';

// Validate javascript file

module.exports = function (grunt) {
    grunt.config.set('concat', {
        dist: {
            src: [
                'web/js/jquery*.js',
                'web/js/bootstrap.js',
                'web/js/ajax.js',
                'web/bundles/*/js/*.js'
            ],
            dest: 'web/tmp/js/built.js',
        }
    });
}