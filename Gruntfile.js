module.exports = fonction(grunt) {

	require('load-grunt-tasks')(grunt);

	// grunt.initConfig({

	// 	less: {
	// 	  dev: {
	// 	    files: {
	// 	      'assets/css/app.css': 'assets/less/app.less',
	// 	      'assets/css/message.css': 'assets/less/message.less'
	// 	    }
	// 	  }
	// 	},

	// 	autoprefixer: {
	// 		options: {
	// 			browsers: ['> 1%']
	// 		},
	// 		app: {
	// 			src: 'assets/css/app.css'
	// 		},
	// 		message: {
	// 			src: 'assets/css/message.css'
	// 		}
	// 	},

	// 	csslint: {
	// 	  strict: {
	// 	    options: {
	// 	      import: 2
	// 	    },
	// 	    src: ['assets/css/app.css']
	// 	  },
	// 	  lax: {
	// 	    options: {
	// 	      import: false
	// 	    },
	// 	    src: ['assets/css/app.css']
	// 	  }
	// 	},

	// 	cssmin: {
	// 		cssbase: {
	// 			options: {
	// 				keepSpecialComments: 0,
	// 				report: 'min'
	// 			},
	// 			files: {
	// 				'assets/dist/css/app.min.css': ['assets/css/bootstrap.css', 'assets/css/font-awesome.css', 'assets/css/animate.css', 'assets/css/app.css']
	// 			}
	// 		},
	// 		fullpage: {
	// 			options: {
	// 				keepSpecialComments: 0,
	// 				report: 'min'
	// 			},
	// 			files: {
	// 				'assets/dist/css/jquery.fullPage.min.css': ['assets/css/jquery.fullPage.css']
	// 			}
	// 		},
	// 		flipclock: {
	// 			options: {
	// 				keepSpecialComments: 0,
	// 				report: 'min'
	// 			},
	// 			files: {
	// 				'assets/dist/css/flipclock.min.css': ['assets/css/flipclock.css']
	// 			}
	// 		},
	// 		message: {
	// 			options: {
	// 				keepSpecialComments: 0,
	// 				report: 'min'
	// 			},
	// 			files: {
	// 				'assets/dist/css/message.min.css': ['assets/css/message.css']
	// 			}
	// 		}
	// 	},

	// 	concat: {
	// 		options: {
	// 			separator: ';'
	// 		},
	// 		members: {
	// 			src: ['assets/js/jquery.easing.1.3.js', 'assets/js/raphael.js', 'assets/js/mapsvg.js', 'assets/js/jquery.fullPage.js'],
	// 			dest: 'assets/js/members.js'
	// 		},
	// 		app: {
	// 			src: ['assets/js/bootstrap.js', 'assets/js/plugins.js', 'assets/js/jquery.mixitup.min.js', 'assets/js/jquery.validate.min.js', 'assets/js/app.js', 'assets/js/ajax.js'],
	// 			dest: 'assets/js/app.concat.js'
	// 		}
	// 	},

	// 	uglify: {
	// 		members: {
	// 			files: {
	// 				'assets/dist/js/members.min.js': 'assets/js/members.js'
	// 			}
	// 		},
	// 		app: {
	// 			files: {
	// 				'assets/dist/js/app.min.js': 'assets/js/app.concat.js'
	// 			}
	// 		}
	// 	},

	// 	imagemin: {
	// 		png: {
	// 			options: {
	// 				optimizationLevel: 7
	// 			},
	// 			files: [
	// 				{
	// 					expand: true,
	// 					cwd: 'assets/',
	// 					src: ['img/*.png'],
	// 					dest: 'assets/dist/',
	// 					ext: '.png'
	// 				}
	// 			]
	// 		},
	// 		jpg: {
	// 			options: {
	// 				progressive: true
	// 			},
	// 			files: [
	// 				{
	// 				expand: true,
	// 					cwd: 'assets/',
	// 					src: ['img/*.jpg'],
	// 					dest: 'assets/dist/',
	// 				ext: '.jpg'
	// 				}
	// 			]
	// 		}
	// 	},

	// 	watch: {
	// 		less: {
	// 			files: ['assets/less/app.less'],
	// 			tasks: ['default'],
	// 			options: {
	// 				livereload: false,
	// 				spawn: false
	// 			}
	// 		},
	// 		php: {
	// 			files: ['*.php'],
	// 			options: {
	// 				livereload: 20248
	// 			}
	// 		},
	// 		livereload: {
	// 			files: ['assets/css/*.css', '**/**/**/*.php', '**/**/*.php', '**/*.php', '*.php'],
	// 			options: { livereload: 20248 }
	// 		}
	// 	}



	// });

	// grunt.registerTask('default', ['less', 'autoprefixer']);
	// grunt.registerTask('prod', ['less', 'autoprefixer', 'cssmin', 'concat', 'uglify']);

}