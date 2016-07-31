'use strict';

// munify css file

module.exports = function (grunt) {
    grunt.config.set('cssmin', {
        target: {
            files: {
                'web/tmp/css/min.css': [
                    'web/css/bootstrap.css',
                    'web/css/bootstrap-responsive.css'
                ],
                'web/tmp/css/style-min.css': [
                    'web/css/style.css'
                ]
            }
        },
        icon: {
            files: {
                'web/tmp/css/minicon.css': ['web/css/font-awesome.css']
            }
        }
    });
}