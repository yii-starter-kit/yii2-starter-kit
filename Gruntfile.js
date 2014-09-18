module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({
        pkg: 'yii2-starter-kit'
    });

    // Load the plugin that provides the "uglify" task.
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default task(s).
    grunt.registerTask('default', ['uglify']);

};