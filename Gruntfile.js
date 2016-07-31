'use stric t';

module.exports = function (grunt) {
    // Définition des tâches exécutés par default
    grunt.registerTask('default', [
        'jshint',
        // 'concat',
        'uglify',
        'cssmin',
        'phplint',
        //'imagemin',
        //'replace'
    ]);
    grunt.initConfig({});
    // Chargement automatiques des packages
    require('load-grunt-tasks')(grunt);
    require('./grunt/concat')(grunt);
    require('./grunt/cssmin')(grunt);
    require('./grunt/imagemin')(grunt);
    require('./grunt/jshint')(grunt);
    require('./grunt/phplint')(grunt);
    require('./grunt/uglify')(grunt);
    require('./grunt/replace')(grunt);
    require('./grunt/watch')(grunt);
    require('./grunt/shell')(grunt);
    require('./grunt/connect')(grunt);  


}