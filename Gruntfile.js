module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // Copy web assets from bower_components to more convenient directories.
        copy: {
            main: {
                files: [
                    // Bootstrap
                    {
                        expand: true,
                        filter: 'isFile',
                        flatten: true,
                        cwd: 'bower_components/bootstrap/dist/',
                        src: ['**/*.css'],
                        dest: 'src/public/css/'
                    },
                    {
                        expand: true,
                        filter: 'isFile',
                        flatten: true,
                        cwd: 'bower_components/bootstrap/dist/',
                        src: ['**/*.js'],
                        dest: 'src/public/js/'
                    },
                    {
                        expand: true,
                        filter: 'isFile',
                        flatten: true,
                        cwd: 'bower_components/bootstrap/dist/fonts/',
                        src: ['**'],
                        dest: 'src/public/fonts/'
                    },
                    // JQuery
                    {
                        expand: true,
                        cwd: 'bower_components/jquery/dist/',
                        src: ['**/*.js', '**/*.map'],
                        dest: 'src/public/js/'
                    }
                ]
            }
        },
        uglify: {
            main: {
                files: [{
                    expand: true,
                    cwd: 'src/js/',
                    src: '**/*.js',
                    dest: 'src/public/js/',
                }]
            }
        }
    });

    // Load externally tasks. 
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    //grunt.loadNpmTasks('grunt-contrib-watch');
    

    // register tasks
    grunt.registerTask('build', ['copy', 'uglify']);
    grunt.registerTask('default', ['build']);
    //grunt.registerTask('default', ['build', 'watch']);
}
