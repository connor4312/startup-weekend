module.exports = function(grunt) {

  grunt.initConfig({
    uglify: {
      options: {
        banner: '/*! Built <%= grunt.template.today("dd-mm-yyyy") %> at #SWPNS */\n'
      },
      production: {
        files: [
        {
          expand: true,
          cwd: 'src/js/',
          src: ['*.js'],
          dest: 'public/js/',
          ext: '.min.js',
        },
        {
          "public/js/bootstrap.min.js": ["node_modules/twitter-bootstrap-3.0.0/dist/js/bootstrap.js"]
        }]
      }
    },
    less: {
      production: {
        options: {
          yuicompress: true
        },
        files: {
          "public/css/style.css": "src/css/styles.less",
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-exec');

  grunt.registerTask('js', ['uglify']);
  grunt.registerTask('css', ['less']);
  grunt.registerTask('default', ['less', 'uglify']);

};