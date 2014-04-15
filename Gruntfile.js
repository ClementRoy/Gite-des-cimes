module.exports = function(grunt){

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		less: {
			dev: {
				files: {
					'assets/css/app.css': 'assets/css/app.less'
				}
			}
		},
		cssmin: {
			dist: {
				options: {
					keepSpecialComments: 0
				},
				files: {
					'assets/dist/css/s.css': ['assets/css/bootstrap.css', 'assets/css/lib/bootstrap.datepicker.css', 'assets/css/animate.css', 'assets/css/lib/jquery.dataTables.css', 'assets/css/lib/font-awesome.css', 'assets/css/app.css']
				}
			}
		},
		concat: {
			options: {
				separator: ';',
				stripBanners: false
			},
			dist: {
				src: ['assets/js/bootstrap.min.js', 'assets/js/bootstrap.datepicker.js', 'assets/js/select2.js', 'assets/js/jquery.mask.js', 'assets/js/parsley.js', 'assets/js/parsley.extend.js', 'assets/js/jquery.dataTables.js', 'assets/js/fullcalendar.js', 'assets/js/fullcalendar.year.js' 'assets/js/app.js', 'assets/js/ajax.js'],
				dest: 'assets/dist/js/s.js',
			}
		},
		uglify: {
			my_target: {
				files: {
					'assets/dist/js/s.js': ['assets/dist/js/s.js']
				}
			}
		}

	});

	grunt.registerTask('default', ['less', 'cssmin', 'concat', 'uglify']);
}




