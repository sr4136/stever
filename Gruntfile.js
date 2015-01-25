module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkgc: grunt.file.readJSON('package.json'),

    // Watch files that may change and should trigger updates
    watch: {
      sass: {
        files: ['sass/*.{scss,sass}', 'sass/**/*.scss'],
        tasks: ['sass', 'autoprefixer', 'uglify'],
      },
      js: {
        files: ['js/app.js'],
        tasks: ['uglify'],
      },
      /*livereload: {
        options: { livereload: true },
        files: [
          '*.php',
          'inc/*.php',
          'style.css',
          'js/app.js',
          'images/*.{png,jpg,jpeg,gif,webp,svg}',
        ],
      }*/
    },

    // Compile SASS
    sass: {
      dist: {
        options: {
          style: 'expanded',
        },
        files: { // 'destination': 'source' ... obviously.
          'style.css': 'sass/style.scss',
        }
      }
    },

    // Autoprefix CSS
    autoprefixer: {
      options: {
        browsers: ['last 2 versions', 'ie 8', 'ios 6', 'android 4'],
        map: true
      },
      files: {
        expand: true,
        flatten: true,
        src: 'style.css'
      },
    },

    // Uglify to concat, minify, and make source maps
    uglify: {
      main: {
        options: {
          sourceMap: 'js/main.js.map',
          sourceMappingURL: 'main.js.map',
          sourceMapPrefix: 2,
        },
        files: {
          'js/main.min.js': [
            'js/app.js'
          ]
        }
      }
    },

	/*
    // SFTP
    'sftp-deploy': {
      build: {
        auth: {
          host: 'server.com',
          port: 22,
          authKey: 'key1'
        },
        cache: 'sftpCache.json',
        src: '/path/to/source/folder',
        dest: '/path/to/destination/folder',
        exclusions: [
          '/path/to/source/folder/.DS_Store',
          'dist/tmp'
        ],
        serverSep: '/',
        concurrency: 4,
        progress: true
      }
    },
	*/
  });

  // Load all grunt tasks matching the `grunt-*` pattern
  require('load-grunt-tasks')(grunt);

  // Default task(s)
  // We can do better! http://gruntjs.com/creating-tasks
  grunt.registerTask('default', ['watch']);
  //grunt.registerTask('deploy', ['sftp-deploy']);
  grunt.registerTask('build', ['sass', 'autoprefixer', 'uglify', 'imagemin']);
}