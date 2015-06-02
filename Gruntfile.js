module.exports = function(grunt) {

	// 1. All configuration goes here
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		// 2. All functions go here.
		watch: {
			grunt: {
				files: [ 'Gruntfile.js'],
				options: {
					reload: true
				}
			},
			/*
			scripts: {
				files: [
				'js-dev/*.js',
				],
				tasks: ['concat', 'uglify'],
				options: {
					spawn: false,
				},
			},
			*/
			styles: {
				files: [
				'sass/**/*.scss',
				'sass/*.scss',
				'sass/style.scss'
				],
				tasks: ['sass:dev', 'sass:prod'],
				options: {
					spawn: false,
				}
			}
		},
		/*
		concat: {
			scripts: {
				src: [
					'js-dev/*.js'
				],
				dest: 'js/script.js',
			}
		},
		*/
		uglify: {
			scripts: {
				expand: true,
				cwd: 'js',
				src: ['*.js', '!*.min.js'],
				dest: 'js',
				ext: '.min.js'
			},
			vendor: {
				expand: true,
				cwd: 'js/vendor',
				src: ['**/*.js', '!**/*.min.js'],
				dest: 'js/vendor',
				ext: '.min.js'
			}
		},
		sass: {
			dev: {
				options: {
					style: 'expanded',
					loadPath: 'sass'
				},
				files: {
					'style.css': 'sass/style.scss'
				}
			},
			prod: {
				options: {
					style: 'compressed',
					loadPath: 'sass'
				},
				files: {
					'style.min.css': 'sass/style.scss'
				}
			}
		}
	});

	// 3. Where we tell Grunt we plan to use this plug-in.
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');

	// 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
	grunt.registerTask('build', ['sass', 'concat', 'uglify']);
	grunt.registerTask('default', ['watch']);

};