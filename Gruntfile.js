'use strict';
module.exports = function (grunt) {

    // load all tasks
    require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        clean: {
            css: ['css/blocks.css']
        },
        watch: {
            css: {
                files: ['blocks/**/assets/css/*.css'],
                tasks: ['combine'],
                options: {
                    reload: true
                }
            }
        },
        concat: {
            dist: {
                src: [
                    'blocks/**/assets/css/style.css'
                ],
                dest: 'css/blocks.css'
            }
        }
    });

    //Loading tasks
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    
    grunt.registerTask('combine', ['clean:css', 'concat']);
};
