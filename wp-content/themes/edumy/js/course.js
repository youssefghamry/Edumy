(function ($) {
    "use strict";

    $.extend($.apusThemeCore, {
        /**
         *  Initialize
         */
        course_init: function() {
            var self = this;
            
            self.coursesFilter();

            self.courseDetail();

            self.mixesFc();
            
            self.wishlistInit();
        },
        coursesFilter: function() {
            var self = this;

            $(document).on('change', '.filter-categories-widget form input', function(){
                $(this).closest('.filter-categories-widget form').trigger('submit');
            });
            $(document).on('change', '.filter-instructors-widget form input', function(){
                $(this).closest('.filter-instructors-widget form').trigger('submit');
            });
            $(document).on('change', '.filter-price-widget form input', function(){
                $(this).closest('.filter-price-widget form').trigger('submit');
            });
            $(document).on('change', '.filter-levels-widget form input', function(){
                $(this).closest('.filter-levels-widget form').trigger('submit');
            });
            $(document).on('change', '.filter-rating-widget form input', function(){
                $(this).closest('.filter-rating-widget form').trigger('submit');
            });
        },
        courseDetail: function() {
            var self = this;
            
            if ( $('.comment-form-rating').length > 0 ) {
                // var $star = $('.comment-form-rating .filled');
                // var $review = $('#apus_input_rating');
                // $star.find('li').on('mouseover', function () {
                //     $(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
                //     $(this).prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
                //     $(this).find('span').removeClass('fa-star-o').addClass('fa-star');
                // });
                // $star.on('mouseout', function(){
                //     var current = $review.val() - 1;
                //     var current_e = $star.find('li').eq(current);

                //     current_e.nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
                //     current_e.prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
                //     current_e.find('span').removeClass('fa-star-o').addClass('fa-star');
                // });
                // $star.find('li').on('click', function () {
                //     $(this).nextAll().find('span').removeClass('fa-star').addClass('fa-star-o');
                //     $(this).prevAll().find('span').removeClass('fa-star-o').addClass('fa-star');
                //     $(this).find('span').removeClass('fa-star-o').addClass('fa-star');
                    
                //     $review.val($(this).index() + 1);
                // } );


                var $star = $('.comment-form-rating .filled');
                var $review = $('#apus_input_rating');
                $star.find('li').on('mouseover', function () {
                    $(this).nextAll().addClass('active');
                    $(this).prevAll().removeClass('active');
                    $(this).removeClass('active');
                });
                $star.on('mouseout', function(){
                    var current = $review.val() - 1;
                    var current_e = $star.find('li').eq(current);

                    current_e.nextAll().addClass('active');
                    current_e.prevAll().removeClass('active');
                    current_e.removeClass('active');
                });
                $star.find('li').on('click', function () {
                    $(this).nextAll().addClass('active');
                    $(this).prevAll().removeClass('active');
                    $(this).removeClass('active');
                    
                    $review.val($(this).index() + 1);
                } );
            }

            $(document).on('click', '.share-wrapper .course-share', function(){
                $(this).parent().toggleClass('active');
            });
        },
        mixesFc: function() {
            $( '.courses-ordering' ).on( 'change', 'select.orderby', function() {
                $( this ).closest( 'form' ).submit();
            });
        },
        wishlistInit: function() {
            var self = this;
            // wishlist
            $( document ).on( "click", ".apus-wishlist-add", function( e ) {
                e.preventDefault();

                var $self = $(this);
                $self.addClass('loading');
                $.ajax({
                    url: edumy_course_opts.ajaxurl,
                    type:'POST',
                    data: {
                        action: 'edumy_add_wishlist',
                        post_id: $(this).data('id'),
                        security: edumy_course_opts.ajax_nonce,
                    },
                    dataType: 'json',
                }).done(function(reponse) {
                    if (reponse.status === 'success') {
                        $self.removeClass('apus-wishlist-add').addClass('apus-wishlist-added');
                        $self.find('.wishlist-text').html(reponse.text);
                    }
                    $self.removeClass('loading');
                });
            });

            $('.apus-wishlist-not-login').on('click', function(){
                var target = $('.apus-user-login').attr('href');
                
                self.loginRegisterPopup(target);
                return false;
            });

            // wishlist remove
            $( document ).on( "click", ".apus-wishlist-added", function( e ) {
                e.preventDefault();

                var $self = $(this);
                $self.addClass('loading');
                $.ajax({
                    url: edumy_course_opts.ajaxurl,
                    type:'POST',
                    data: {
                        action: 'edumy_remove_wishlist',
                        post_id: $(this).data('id'),
                        security: edumy_course_opts.ajax_nonce,
                    },
                    dataType: 'json',
                }).done(function(reponse) {
                    if (reponse.status === 'success') {
                        $self.removeClass('apus-wishlist-added').addClass('apus-wishlist-add');
                        $self.find('.wishlist-text').html(reponse.text);
                    }
                    $self.removeClass('loading');
                });
            });
            $( document ).on( "click", ".apus-wishlist-remove", function( e ) {
                e.preventDefault();

                var $self = $(this);
                var post_id = $(this).data('id');
                $self.addClass('loading');
                $.ajax({
                    url: edumy_course_opts.ajaxurl,
                    type:'POST',
                    data: {
                        action: 'edumy_remove_wishlist',
                        post_id: post_id,
                        security: edumy_course_opts.ajax_nonce,
                    },
                    dataType: 'json',
                }).done(function(reponse) {
                    $self.addClass('loading');
                    if (reponse.status === 'success') {
                        var parent = $('#wishlist-course-' + post_id).parent();
                        if ( $('.my-course-item-wrapper', parent).length <= 1 ) {
                            location.reload();
                        } else {
                            $('#wishlist-course-' + post_id).remove();
                        }
                    }
                });
            });
        }
    });

    $.apusThemeExtensions.course = $.apusThemeCore.course_init;
    
})(jQuery);

