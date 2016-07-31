'use strict';

// text replace

module.exports = function (grunt) {
    grunt.config.set('replace', {
        dist: {
            src: ['src/**/*.html.twig'],
            overwrite: true,                 // overwrite matched source files
            replacements: [{
                from: "/upload/",
                to: "/tmp/min/upload"
            }]
        }
    });
}