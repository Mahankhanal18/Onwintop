 module.exports = function(grunt){
	"use strict";
	grunt.initConfig({
		  concat: {
		    dist: {
		      src: [
				  'css/bootstrap.min.css', //-- framework
				  'css/icofont.min.css', //-- iconfonts libarary
				  'css/animate.min.css', //-- for animations
				  'css/owl.carousel.css',//-- carousel
				  'css/chosen.css', //-- select dropdown options
				  'css/ripple.css', //-- on click animation button
				  'css/perfect-scrollbar.min.css', //-- for scrollbar 
				  'css/datetimepicker.min.css', //-- date and time widget
				  'css/dropzone.min.css', //-- drag and drop file for upload
				  'css/emojies.css', //-- emojies in the new post text area
				  'css/eventCalendar.css', //-- calendar widget
				  'css/gifpreview.css', //-- gif image on click play and pause
				  'css/fancybox.min.css', //-- image gallery
				  'css/aud-vid-player.css' //-- audio video plugin
			      ],
		      dest: 'css/main.min.css',
		    },
			  
		    extras: {
		      src: [
				  'js/jquery.js',
				  'js/popperjs-bootstrap.js', //-- bootstarp4 essential file	 
				  'js/bootstrap.min.js', //-- framework
				  'js/owl.carousel.min.js', //-- carousel
				  'js/sticky-kit.min.js', //-- sticky widgets
				  'js/stickit-header.js', //-- sticky header
				  'js/chosen.jquery.js', //-- select dropdown plugin
				  'js/ripple.js', //-- click animation on button
				  'js/perfect-scrollbar.jquery.min.js', //-- scrollbar custome
				  'js/scrolltopcontrol.js', //-- scroll to top button icon
				  'js/jquery.downCount.js', //--- for coming soon page time down counter
				  'js/counterup.min.js', //-- for funfacts on scroll
				  'js/counterup-t-waypoint.js', //-- for funfacts on scroll
				  'js/datetimepicker.full.min.js', //-- for date and time widget
				  'js/dropzone.min.js', //-- for upload or drag drop the image
				  'js/emojies.js', //-- for emojies in the new post text area
				  'js/gifpreview.js', //-- gif image on click play and pause
				  'js/jquery.eventCalendar.min.js', //-- widget calendar
				  'js/progress-circle.js', //-- complete profile progress bar widget
				  'js/vivus.min.js', //-- animation for svg drawing
				  'js/fancybox.min.js', //-- for picture gallery
				  'js/aud-vid-player.js' //-- audio-video player
			  ],
		      dest: 'js/main.min.js',
		    },
		  },

		  cssmin: {
		    target: {
			    files: {
			      'css/main.min.css': 
					[
					  'css/bootstrap.min.css',
					  'css/icofont.min.css', 
					  'css/animate.min.css',
					  'css/owl.carousel.css', 
					  'css/chosen.css',
					  'css/ripple.css',
					  'css/perfect-scrollbar.min.css',
					  'css/datetimepicker.min.css',
					  'css/dropzone.min.css',
					  'css/emojies.css',
					  'css/eventCalendar.css',
					  'css/gifpreview.css',
					  'css/fancybox.min.css',
					  'css/aud-vid-player.css'
					],
			    }
			  }
		  },

		uglify: {
		    my_target: {
		      files: {
		        'js/main.min.js': 
				 [
				  'js/jquery.js',
				  'js/popperjs-bootstrap.js',	 
				  'js/bootstrap.min.js',
				  'js/owl.carousel.min.js',
				  'js/sticky-kit.min.js',
				  'js/stickit-header.js', 
				  'js/chosen.jquery.js',
				  'js/ripple.js',
				  'js/perfect-scrollbar.jquery.min.js',
				  'js/scrolltopcontrol.js',
				  'js/jquery.downCount.js',
				  'js/counterup.min.js',
				  'js/counterup-t-waypoint.js',
				  'js/datetimepicker.full.min.js',
				  'js/dropzone.min.js',
				  'js/emojies.js',
				  'js/gifpreview.js',
				  'js/jquery.eventCalendar.min.js',
				  'js/progress-circle.js',
				  'js/vivus.min.js',
				  'js/fancybox.min.js',
				  'js/aud-vid-player.js' 
				 ]
		      },
		    },
		  },
		
		watch: {
		  configFiles: {
		    files: 
			  [
				  'css/bootstrap.min.css', 
				  'css/nice-select.css', 
		          'css/owl.carousel.css'
			  ],
		    options: {
		      reload: true
		    },
		  },
		},
	  
	});

	//load the plugins
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');
};