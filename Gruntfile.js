module.exports = function(grunt) {
	// Project configuration.
	grunt.initConfig({
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
		// 監視内容
		regarde: {
			fred: {
				files: ['scss/*.scss'], // 監視対象
				tasks: ['compass'] //監視対象が変更された際に実行する内容
			}
		},
	});
	// load task
	grunt.loadNpmTasks('grunt-regarde');
	grunt.loadNpmTasks('grunt-contrib-compass');

	// Default task
	grunt.registerTask('default', ['regarde']);
};