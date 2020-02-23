$(document).ready(function () {
    $('.nav li a').hover(function(e) {
        var $parent = $(this).parent();
        if (!$parent.hasClass('active')) {
            $parent.addClass('active');
        }else{
			 $('.nav li').removeClass('active');
			}
        e.preventDefault();
       
    });
	});
