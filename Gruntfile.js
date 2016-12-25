module.exports = function(grunt){

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		// less: {
		// 	dev: {
		// 		files: {
		// 			'assets/css/app.css': 'assets/css/app.less'
		// 		}
		// 	}
		// },
		cssmin: {
			dist: {
				options: {
					keepSpecialComments: 0
				},
				files: {
					'assets/css/gitedescimes.min.css': [
						'assets/libs/jquery.easy-pie-chart/jquery.easy-pie-chart.css',
						'assets/libs/odometer/themes/odometer-theme-default.css',
						'assets/libs/jquery.gritter/css/jquery.gritter.css',
						'assets/libs/jquery-icheck/skins/flat/purple.css',
						'assets/libs/fullcalendar/fullcalendar.css',
						'assets/css/datatables-bootstrap-adapter.css',
						'assets/css/flatdream.css',
						'assets/css/app.css',
						'assets/css/responsive.css'
					]
				}
			}
		},
		// uncss: {
		//   dist: {
		//     files: {
		//       'assets/css/gitedescimes.min.css': ['modules/*.php']
		//     }
		//   }
		// },
		//

		concat: {
			options: {
				separator: ';',
				stripBanners: false
			},
			main: {
				src: [
					'assets/libs/datatables/media/js/jquery.daTatables.js',
					'assets/js/libs/datatables-bootstrap-adapter.js',
					'assets/js/libs/datatables-french.js',

					'assets/libs/jquery.gritter/js/jquery.gritter.js',

					'assets/libs/bootstrap-file-input/bootstrap.file-input.js',
					'assets/libs/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
					'assets/libs/jquery-icheck/icheck.min.js',
					'assets/libs/parsleyjs/dist/parsley.min.js',
					'assets/libs/parsleyjs/src/extra/validator/comparison.js',
					'assets/libs/parsleyjs/src/i18n/fr.js',

					'assets/libs/jquery-maskedinput/dist/jquery.maskedinput.min.js',
					'assets/libs/jquery-stickytabs/jquery.stickytabs.js',

					'assets/libs/fullcalendar/fullcalendar.min.js',
					'assets/js/libs/fullcalendar.year.js',

					'assets/js/libs/flatdream-core.js',
					'assets/js/app.js'
				],
				dest: 'assets/js/gitedescimes.js',
			},
			stats: {
				src: [
				'assets/libs/jquery-flot/jquery.flot.js',
				'assets/libs/jquery-flot/jquery.flot.pie.js',
				'assets/libs/jquery-flot/jquery.flot.resize.js',
				'assets/libs/jquery-flot/jquery.flot.categories.js',
				],
				dest: 'assets/js/stats.js',
			},
			stats: {
				src: [
					'assets/js/dashboard.min.js',
					'assets/js/libs/jquery.easy-pie-chart.min.js',
					'assets/js/libs/odometer.min.js',
				],
				dest: 'assets/js/dashboard.js',
			}
		},
		uglify: {
			main: {
				files: {
					'assets/js/gitedescimes.min.js': ['assets/js/gitedescimes.js']
				}
			},
			stats: {
				files: {
					'assets/js/stats.min.js': ['assets/js/stats.js']
				}
			},
			dashboard: {
				files: {
					'assets/js/dashboard.min.js': ['assets/js/dashboard.js']
				}
			}
		}

	});

	grunt.registerTask('default', ['prod']);
	grunt.registerTask('prod', ['cssmin','concat', 'uglify']);
}