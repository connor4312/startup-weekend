module.exports = function(grunt) {

  grunt.initConfig({
    uglify: {
      options: {
        banner: '/*! Built <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      production: {
        files: [
        {
          expand: true,
          cwd: 'src/public/js/',
          src: ['*.js'],
          dest: 'public/js/',
          ext: '.min.js',
        },
        {
          "public/js/jquery.min.js": ["node_modules/jquery/lib/node-jquery.js"]
        }]
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