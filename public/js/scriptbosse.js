(function(window,document,$){
    $(function(){
		'use strict';
		
		$(document).ajaxError(function (event, jqXHR, ajaxSettings, error) {
            $('main').empty().append('Entschuldigung! Daten konnten nicht geladen werden.');
        });

		// var $likeDiv = $('.likeBox');
		// console.log($likeDiv);

        $('.likeLink').on('click', function(e){
			e.preventDefault();
			
			console.log($(this).attr('title'));
			if ($(this).attr('title') === 'login') {
				// var $hinweis = $('<div/>');
				// $hinweis.addClass('clearfix');
				// var $hinweisfig = $('<figure/>');
				// var $img = $('<img/>');
				// $img.attr('src','./public/images/warning-icon.png');
				// $hinweisfig.append($img);
				// $hinweis.append($hinweisfig);
				// $('main').append($hinweis);
				// alert('bitte anmelden');
				$('#plslogin').removeClass('hide');
			} else {
				var imageid = $(this).data('id');
			
				var haslikedClass = 0;
	
				if ( $(this).hasClass('liked') ) {
					haslikedClass = 2;
				} else {
					haslikedClass = 1;
				}
	
				// console.log(imageid, haslikedClass);
				$.ajax({
					url: './bootstrap.php',
					type: 'post',
					data: {
						'liked': haslikedClass,
						'image_id': imageid
					},
					success: function(response){
						// console.log('yeas');
	
						location.reload();
						// window.location = window.location;
						// funzt in älteren browsern nicht
	
						// console.log(response);
						
					}
				});
			}
		});

    }); //_______end load
}(window,document,jQuery));