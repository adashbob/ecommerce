'use strict';
module.exports = function(grunt) {
	grunt.config.set('shell', {
		clear_dev: {
			command: "php bin/console cache:clear"
		},
		clear_prod: {
			command: "php bin/console cache:clear -e prod"
		},
		symlink:{
			command: "php bin/console assetic:install"
		}
	});
};