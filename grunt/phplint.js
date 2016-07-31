'use strict';

// Validate php file

module.exports = function (grunt) {
    grunt.config.set('phplint', {
        options: {
            swapPath: "var/tmp/phplint"
        },
        src: ["src/**/*.php "],
        app: ["app/**/*.php"],
        web: ["web/*.php"]
    });
}