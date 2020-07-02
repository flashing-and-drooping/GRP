$(function() {






    $("input").keypress(function(e) {

        if (e.which == 13) {
            $("form input").blur()
            $("form input, form label").css({
                "color": "red"
            });
        }

    });


    setTimeout(function() {

        $("figure").addClass("t");

    }, 1000);


    $(".menu-button").on("click", function() {


        if ($(this).hasClass("a")) {
            $(this).removeClass("a")
            $(".nav").slideUp();
        } else {
            $(this).addClass("a")
            $(".nav").slideDown();
        }
    });




    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		
		
		
		$(".logo").on("click", function() {

        	$("html,body").animate({"scrollTop": 0},0);
			$(".info").stop();
			$(".info").slideDown();
		});
    

        $(".gallery").css("margin-top", $(".header").outerHeight())

        var timer = 0

        $(window).on("scroll", function() {
        
        
        	if ($(window).scrollTop() < 0) {
        		$(".info").slideDown()
        	}
            

            if ($(window).scrollTop() > 0) {

                if (timer == 0) {
                    $(".info").slideUp();
                }

            } else {
/*                 $(".info").slideDown(); */
                timer = 1
                setTimeout(function() {
                    timer = 0
                }, 1000)
            }


            clearTimeout($.data(this, 'scrollTimer'));

            $.data(this, 'scrollTimer', setTimeout(function() {

                loadImage();

            }, 50));

        });

        function loadImage() {
        
        console.log("load image")

            $("img[data-src]:in-viewport(0)").each(function() {
                $(this).attr("src", $(this).attr("data-src-mobile"));
                $(this).removeAttr("data-src");
                $(this).parent().addClass("a");
            });

        }




        $(".nav li[data-i]").on("click", function() {

            var i = $(this).attr("data-i");
            
            
            
            $(".info").stop();

            /*
				$("html,body").animate({
                "scrollTop": $("figure[data-i=" + i + "]").offset().top - ($(".nav").outerHeight() + $(".logo").outerHeight())
				});
			*/

			$("html,body").animate({
                "scrollTop": $("figure[data-i=" + i + "]").offset().top
            });
            
            if ($("form").css("display") == "block") {
                $("form").slideUp();
            }
            
            $(".menu-button").removeClass("a")
            $(".nav").slideUp();

        });




    } else {
    
        $(".logo").on("click", function() {

        $("html,body").animate({
            "scrollTop": 0
        });
        

    });
    
        $(".gallery").css("margin-top", $(".header").outerHeight())

        $(window).on("resize", function() {

            $(".gallery").css("margin-top", $(".header").outerHeight())


        })

        setTimeout(function() {
            $(window).on("scroll", function() {


                if ($(window).scrollTop() > 5) {
                    $(".info").slideUp();
                } else {
                    $(".info").slideDown();
                }

                clearTimeout($.data(this, 'scrollTimer'));

                $.data(this, 'scrollTimer', setTimeout(function() {

                    loadImage();

                }, 20));

            });
        }, 300)

        function loadImage() {

            $("img[data-src]:in-viewport(0)").each(function() {
                $(this).attr("src", $(this).attr("data-src"));
                $(this).removeAttr("data-src");
                $(this).parent().addClass("a");
            });

        }



        $(".nav li[data-i]").on("click", function() {

            var i = $(this).attr("data-i");

            window.location.hash = $(this).attr("data-i")

            $("html,body").animate({
                "scrollTop": $("figure[data-i=" + i + "]").offset().top - $(".logo").outerHeight()
            });

            if ($("form").css("display") == "block") {
                $("form").slideUp();
            }

        });




    }


    if (window.location.hash) {
        var i = window.location.hash;
        $("html,body").animate({
            "scrollTop": $("figure[data-i=" + i.substring(1) + "]").offset().top - $(".logo").outerHeight()
        });

    }




    loadImage();



    $(".private").on("click", function() {
        
        if ($("form").css("display") == "block") {
            $("form").slideUp();
        } else {
            $("form").slideDown();
        }
        
    });

});