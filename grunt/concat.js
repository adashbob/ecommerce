'use strict';

// contact file

module.exports = function (grunt) {
    grunt.config.set('jshint', {
        all: [
            'web/js/ajax.js',
            '!web/bundles/*/js/*.js',
            '!web/bundles/fosjsrouting/**/*.js'
        ]
    });
}