'use strict';
module.exports = function(grunt) {
	grunt.config.set('php', {
		dev: {
			options: {
				protocol: 'http',
				hostname: 'ecommerce',
				port: '80',
				base: 'web',
				open: '/app_dev.php/produit',
				keepalive: true
			}
		},
		prod: {
			options: {
				protocol: 'http',
				hostname: 'ecommerce',
				port: '80',
				base: 'web',
				open: '/app.php/produit',
				keepalive: true
			}
		},
		apidoc: { // doc api
			options: {
				protocol: 'http',
				hostname: 'ecommerce',
				port: '80',
				base: 'web',
				open: 'app_api.php/api/doc',
				keepalive: true
			}
		},
		rest: {	// API rest avec angular
			options: {
				protocol: 'http',
				hostname: 'ecommerce',
				port: '80',
				base: 'web',
				open: 'app_api.php/',
				keepalive: true
			}
		}
	});
};