// from grunt-contrib-livereload github README
var path = require('path');
var lrSnippet = require('grunt-contrib-livereload/lib/utils').livereloadSnippet;

var folderMount = function folderMount(connect, point) {
  return connect.static(path.resolve(point));
};

module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    pkg: '<json:package.json>',
    // ローカルサーバを設定
    connect: {
      livereload: {
        options: {
          port: 9001,
          middleware: function(connect, options) {
            return [lrSnippet, folderMount(connect, '.')];
          }
        }
      }
    },
    // compassの設定
    compass: {
    dist: {
      options: {
        sassDir: 'scss', //このフォルダ以下の内容を
        cssDir: 'stylesheets', //ココに書き出す
        environment: 'production'
        }
      }
    },
    // slimの設定
    slim: {
      dist: {
        files: [{
          expand: true,
          cwd: './',
          src: ['{,*/}*.slim'],
          dest: './',
          ext: '.html'
        }]
      }
    },
    // 自動的にブラウザを開く設定
      open : {
      dev : {
        path: 'http://localhost:9001/'
      }
    },
    // 監視内容
    regarde: {
      fred: {
        files: ['scss/*.scss','*.slim'], // 監視対象
        tasks: ['compass','slim','livereload'] //監視対象が変更された際に実行する内容
      }
    },
  });

  // load task
  grunt.loadNpmTasks('grunt-regarde');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-livereload');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-slim');
  grunt.loadNpmTasks('grunt-open'); 

  // Default task
  grunt.registerTask('default', ['livereload-start','connect','open:dev','regarde']);
};