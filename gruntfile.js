'use strict';
module.exports = function(grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        // watch for changes and trigger compass, jshint, uglify and livereload
        watch: {
            options: {
                livereload: true,
            },
            compass: {
                files: ['src/scss/**/*.{scss,sass}'],
                tasks: ['compass']
            },
            js: {
                files: '<%= jshint.all %>',
                tasks: ['jshint', 'uglify']
            },
            livereload: {
                files: ['*.html', '*.php', 'public/images/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },

        // compass and scss
        compass: {
            dist: {
                options: {
                    config: 'src/scss/config.rb',
                    force: true
                }
            }
        },

        // javascript linting with jshint
        jshint: {
            options: {
                jshintrc: '.jshintrc',
                "force": true
            },
            all: [
                'Gruntfile.js',
                'public/js/source/**/*.js'
            ]
        },

        // uglify to concat, minify, and make source maps
        uglify: {
            dist: {
                options: {
                    sourceMap: 'public/js/map/source-map.js'
                },
                files: {
                    'public/js/plugins.min.js': [
                        'public/js/source/plugins.js',
                        'public/js/vendor/**/*.js',
                        '!public/js/vendor/modernizr*.js'
                    ],
                    'public/js/main.min.js': [
                        'public/js/source/main.js'
                    ]
                }
            }
        },

        // image optimization
        imagemin: {
            dist: {
                options: {
                    optimizationLevel: 7,
                    progressive: true
                },
                files: [{
                    expand: true,
                    cwd: 'public/images/',
                    src: '**/*',
                    dest: 'public/images/'
                }]
            }
        },

        // deploy via rsync
        deploy: {
            staging: {
                src: "./",
                dest: "~/Desktop/onlinecrew_v2/wp-content/theme",
                host: "root@localhost:8888",
                recursive: true,
                syncDest: true,
                exclude: ['.git*', 'node_modules', '.sass-cache', 'Gruntfile.js', 'package.json', '.DS_Store', 'README.md', 'config.rb', '.jshintrc']
            },
            production: {
                src: "./",
                dest: "~/Desktop/onlinecrew_v2/wp-content/theme",
                host: "root@localhost:8888",
                recursive: true,
                syncDest: true,
                exclude: '<%= rsync.staging.exclude %>'
            }
        }

    });

    // rename tasks
    grunt.renameTask('rsync', 'deploy');

    // register task
    grunt.registerTask('default', ['watch']);

};