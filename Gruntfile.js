module.exports = function(grunt) {

  grunt.initConfig({
    uglify: {
      options: {
        banner: '/*! Built <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'source': ['dest'],
        }
      }
    },
    less: {
      production: {
        options: {
          yuicompress: true
        },
        files: {
          "public/css/style.css": "src/css/style.less",
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-exec');

  grunt.registerTask('default', ['less', 'uglify']);

};