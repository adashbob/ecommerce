'use strict';

// munify js file

module.exports = function (grunt) {
    grunt.config.set('uglify', {
        options: {
            mangle : false
        },
        dist: {
            files: {
                'web/tmp/js/bundles/fosjsrouting/js/router-min.js': ['web/bundles/fosjsrouting/js/router.js'],
                'web/tmp/js/jquery-min.js': ['web/js/jquery*.js'],
                'web/tmp/js/bootstrap-min.js': ['web/js/bootstrap.js'],
                'web/tmp/js/ajax-min.js': ['web/js/ajax.js'],
            }
        }
    });
}