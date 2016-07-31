'use strict';

module.exports = function (grunt) {
    grunt.config.set('imagemin', {
        dist: {                         // Another target
            files: [{
                expand: true,                       // Enable dynamic expansion
                cwd: 'web/',                        // Src matches are relative to this path
                src: ['**/*.{png,jpg,gif}'],        // Actual patterns to match
                dest: 'web/tmp/min/'                  // Destination path prefix
            }]
        }
    });
}