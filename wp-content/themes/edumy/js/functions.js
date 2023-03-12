(function ($) {
    "use strict";

    if (!$.apusThemeExtensions)
        $.apusThemeExtensions = {};
    
    function ApusThemeCore() {
        var self = this;
        self.init();
    };

    ApusThemeCore.prototype = {
        /**
         *  Initialize
         */
        init: function() {
            var self = this;
            
            if ( self.target_html == null ) {
                self.target_html = $('#apus_login_register_form_wrapper').html();
                $('#apus_login_register_form_wrapper').html('');
            }

            self.preloadSite();

            // slick init
            self.initSlick($("[data-carousel=slick]"));

            // Unveil init
            setTimeout(function(){
                self.layzyLoadImage();
            }, 200);
            
            // isoto
            self.initIsotope();

            // Sticky Header
            self.intChangeHeaderMarginTop();
            self.initHeaderSticky();

            // back to top
            self.backToTop();

            // popup image
            self.popupImage();

            $('[data-toggle="tooltip"]').tooltip();

            self.initPopupNewsletter();
            
            self.searchForm();

            self.userLoginRegister();

            self.initMobileMenu();

            self.mapInit();

            self.mainMenuInit();

            self.breadcrumbsInit();

            $('.more').on('click', function(){
                $('.wrapper-morelink').toggleClass('active');
            });
            

            $(document.body).on('click', '.nav [data-toggle="dropdown"]' ,function(){
                if(  this.href && this.href != '#'){
                    window.location.href = this.href;
                }
            });

            $('.scroll-up-btn').on('click', function (e) {
                var target_id = $(this).attr('href');
                if ( target_id ) {
                    $('html, body').animate({scrollTop: $(target_id).offset().top - 50}, 800);
                }
                return false;
            });

            self.loadExtension();
        },
        /**
         *  Extensions: Load scripts
         */
        loadExtension: function() {
            var self = this;
            
            if ($.apusThemeExtensions.course) {
                $.apusThemeExtensions.course.call(self);
            }
            
            if ($.apusThemeExtensions.quantity_increment) {
                $.apusThemeExtensions.quantity_increment.call(self);
            }

            if ($.apusThemeExtensions.shop) {
                $.apusThemeExtensions.shop.call(self);
            }
        },
        initSlick: function(element) {
            var self = this;
            element.each( function(){
                var config = {
                    infinite: false,
                    arrows: $(this).data( 'nav' ),
                    dots: $(this).data( 'pagination' ),
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    prevArrow:"<button type='button' class='slick-arrow slick-prev pull-left'><i class='flaticon-left-arrow' aria-hidden='true'></i></span><span class='textnav'>"+ edumy_opts.previous +"</span></button>",
                    nextArrow:"<button type='button' class='slick-arrow slick-next pull-right'><span class='textnav'>"+ edumy_opts.next +"</span><i class='flaticon-right-arrow-1' aria-hidden='true'></i></button>",
                };
            
                var slick = $(this);
                if( $(this).data('items') ){
                    config.slidesToShow = $(this).data( 'items' );
                    config.slidesToScroll = $(this).data( 'items' );
                }
                if( $(this).data('infinite') ){
                    config.infinite = true;
                }
                if( $(this).data('autoplay') ){
                    config.autoplay = true;
                    config.autoplaySpeed = 1500;
                }
                if( $(this).data('centermode') ){
                    config.centerMode = true;
                }
                if( $(this).data('vertical') ){
                    config.vertical = true;
                }
                if( $(this).data('rows') ){
                    config.rows = $(this).data( 'rows' );
                }
                if( $(this).data('asnavfor') ){
                    config.asNavFor = $(this).data( 'asnavfor' );
                }
                if( $(this).data('slidestoscroll') ){
                    config.slidesToScroll = $(this).data( 'slidestoscroll' );
                }
                if( $(this).data('focusonselect') ){
                    config.focusOnSelect = $(this).data( 'focusonselect' );
                }
                if ($(this).data('large')) {
                    var desktop = $(this).data('large');
                } else {
                    var desktop = config.items;
                }
                if ($(this).data('smalldesktop')) {
                    var smalldesktop = $(this).data('smalldesktop');
                } else {
                    if ($(this).data('large')) {
                        var smalldesktop = $(this).data('large');
                    } else{
                        var smalldesktop = config.items;
                    }
                }
                if ($(this).data('medium')) {
                    var medium = $(this).data('medium');
                } else {
                    var medium = config.items;
                }
                if ($(this).data('smallmedium')) {
                    var smallmedium = $(this).data('smallmedium');
                } else {
                    var smallmedium = 2;
                }
                if ($(this).data('extrasmall')) {
                    var extrasmall = $(this).data('extrasmall');
                } else {
                    var extrasmall = 2;
                }
                if ($(this).data('smallest')) {
                    var smallest = $(this).data('smallest');
                } else {
                    var smallest = 1;
                }
                config.responsive = [
                    {
                        breakpoint: 321,
                        settings: {
                            slidesToShow: smallest,
                            slidesToScroll: smallest,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: extrasmall,
                            slidesToScroll: extrasmall,
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: smallmedium,
                            slidesToScroll: smallmedium
                        }
                    },
                    {
                        breakpoint: 981,
                        settings: {
                            slidesToShow: medium,
                            slidesToScroll: medium
                        }
                    },
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: smalldesktop,
                            slidesToScroll: smalldesktop
                        }
                    },
                    {
                        breakpoint: 1501,
                        settings: {
                            slidesToShow: desktop,
                            slidesToScroll: desktop
                        }
                    }
                ];
                if ( $('html').attr('dir') == 'rtl' ) {
                    config.rtl = true;
                }

                $(this).slick( config );

            } );

            // Fix owl in bootstrap tabs
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                var target = $(e.target).attr("href");
                var $slick = $("[data-carousel=slick]", target);

                if ($slick.length > 0 && $slick.hasClass('slick-initialized')) {
                    $slick.slick('refresh');
                }
                self.layzyLoadImage();
            });
        },
        layzyLoadImage: function() {
            $(window).off('scroll.unveil resize.unveil lookup.unveil');
            var $images = $('.image-wrapper:not(.image-loaded) .unveil-image'); // Get un-loaded images only
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.image-wrapper').first().addClass('image-loaded');
                        $(this).removeAttr('data-src');
                        $(this).removeAttr('data-srcset');
                        $(this).removeAttr('data-sizes');
                    });
                });
            }

            var $images = $('.product-image:not(.image-loaded) .unveil-image'); // Get un-loaded images only
            if ($images.length) {
                $images.unveil(1, function() {
                    $(this).load(function() {
                        $(this).parents('.product-image').first().addClass('image-loaded');
                    });
                });
            }
        },
        initIsotope: function() {
            $('.isotope-items').each(function(){  
                var $container = $(this);
                
                $container.imagesLoaded( function(){
                    $container.isotope({
                        itemSelector : '.isotope-item',
                        transformsEnabled: true,         // Important for videos
                        masonry: {
                            columnWidth: $container.data('columnwidth')
                        }
                    }); 
                });
            });

            /*---------------------------------------------- 
             *    Apply Filter        
             *----------------------------------------------*/
            $('.isotope-filter li a').on('click', function(){
               
                var parentul = $(this).parents('ul.isotope-filter').data('related-grid');
                $(this).parents('ul.isotope-filter').find('li a').removeClass('active');
                $(this).addClass('active');
                var selector = $(this).attr('data-filter'); 
                $('#'+parentul).isotope({ filter: selector }, function(){ });
                
                return(false);
            });
        },
        changeHeaderMarginTop: function() {
            if ($(window).width() > 991) {
                if ( $('.main-sticky-header').length > 0 ) {
                    var header_height = $('.main-sticky-header').outerHeight();
                    $('.main-sticky-header-wrapper').css({'height': header_height});
                }
            }
        },
        intChangeHeaderMarginTop: function() {
            var self = this;
            setTimeout(function(){
                self.changeHeaderMarginTop();
            }, 50);
            $(window).resize(function(){
                setTimeout(function(){
                    self.changeHeaderMarginTop();
                });
            });
        },
        initHeaderSticky: function() {
            var self = this;
            var main_sticky = $('.main-sticky-header');
            setTimeout(function(){
                if ( main_sticky.length > 0 ){
                    if ($(window).width() > 991) {
                        var _menu_action = main_sticky.offset().top;
                        $(window).scroll(function(event) {
                            self.headerSticky(main_sticky, _menu_action);
                        });
                        self.headerSticky(main_sticky, _menu_action);
                    }
                }
            }, 50);
        },
        headerSticky: function(main_sticky, _menu_action) {
            if( $(document).scrollTop() > _menu_action ){
                main_sticky.addClass('sticky-header');
            }else{
                main_sticky.removeClass('sticky-header');
            }
        },
        backToTop: function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 400) {
                    $('#back-to-top').addClass('active');
                } else {
                    $('#back-to-top').removeClass('active');
                }
            });
            $('#back-to-top').on('click', function () {
                $('html, body').animate({scrollTop: '0px'}, 800);
                return false;
            });
        },
        popupImage: function() {
            // popup
            $(".popup-image").magnificPopup({type:'image'});
            $('.popup-video').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });

            $('.widget-gallery').each(function(){
                var tagID = $(this).attr('id');
                $('#' + tagID).magnificPopup({
                    delegate: '.popup-image-gallery',
                    type: 'image',
                    tLoading: 'Loading image #%curr%...',
                    mainClass: 'mfp-img-mobile',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
        },
        preloadSite: function() {
            // preload page
            if ( $('body').hasClass('apus-body-loading') ) {
                $('body').removeClass('apus-body-loading');
                $('.apus-page-loading').fadeOut(100);
            }
        },
        initPopupNewsletter: function() {
            var self = this;

            if ($('.popupnewsletter').length > 0) {
                setTimeout(function(){
                    var hiddenmodal = self.getCookie('hidde_popup_newsletter');
                    if (hiddenmodal == "") {
                        var popup_content = $('.popupnewsletter').html();
                        $.magnificPopup.open({
                            mainClass: 'apus-mfp-zoom-in popupnewsletter-wrapper',
                            modal:true,
                            items    : {
                                src : popup_content,
                                type: 'inline'
                            },
                            callbacks: {
                                close: function() {
                                    var dont = $('.close-dont-show').attr('data-dont');
                                    if ( dont === 'yes' ) {
                                        self.setCookie('hidde_popup_newsletter', 1, 30);
                                    }
                                }
                            }
                        });
                    }
                }, 3000);
            }
            $('body').on('click', '.apus-mfp-close', function(e){
                e.preventDefault();
                $.magnificPopup.close();
            });
            $('body').on('click', '.close-dont-show', function(e){
                e.preventDefault();
                $(this).attr('data-dont', 'yes');
                $.magnificPopup.close();
            });
        },
        searchForm: function() {
            $(document).on('click', '.show-search-form-btn', function() {
                $.magnificPopup.open({
                    mainClass: 'apus-mfp-zoom-in',
                    items    : {
                        src : $('.search-form-popup-wrapper').html(),
                        type: 'inline'
                    }
                });
            });
        },
        loginRegisterPopup: function(target) {
            var self = this;
            $.magnificPopup.open({
                mainClass: 'apus-mfp-zoom-in login-register-mfp-zoom-in',
                items    : {
                    src : self.target_html,
                    type: 'inline'
                },
                callbacks: {
                    open: function() {
                        $(target).trigger('click');
                        $('.apus_login_register_form .nav-tabs li').removeClass('active');
                        $(target).parent().addClass('active');
                        var id = $(target).attr('href');
                        $('.apus_login_register_form .tab-pane').removeClass('active');
                        $(id).addClass('active').addClass('in');

                        $('#apus_forgot_password_form').hide();
                        $('#apus_login_form').show();

                        $('.apus_login_register_form').addClass('animated fadeInDown');
                    }
                }

            });
            
        },
        userLoginRegister: function() {
            var self = this;
            // login/register
            
            $('.apus-user-login').on('click', function(){
                var target = $(this).attr('href');
                
                self.loginRegisterPopup(target);
                return false;
            });
            
            $('.apus-user-register').on('click', function(){
                var target = $(this).attr('href');
                
                self.loginRegisterPopup(target);
                return false;
            });

            $('.account-sign-in a, .must-log-in a').on('click', function(e){
                e.preventDefault();
                var target = $('.apus-user-login').attr('href');
                self.loginRegisterPopup(target);
                return false;
            });
            $('body').on('click', '.apus_login_register_form .mfp-close', function(){
                $.magnificPopup.close();
            });
            
            // sign in proccess
            $('body').on('submit', 'form.apus-login-form', function(){
                var $this = $(this);
                $this.find('.alert').remove();
                $this.addClass('loading');
                $.ajax({
                    url: edumy_opts.ajaxurl,
                    type:'POST',
                    dataType: 'json',
                    data:  $(this).serialize()+"&action=apus_ajax_login"
                }).done(function(data) {
                    $this.removeClass('loading');
                    if ( data.loggedin ) {
                        $this.prepend( '<div class="alert alert-info">' + data.msg + '</div>' );
                        location.reload(); 
                    } else {
                        $this.prepend( '<div class="alert alert-warning">' + data.msg + '</div>' );
                    }
                });
                return false; 
            } );
            $('body').on('click', '.back-link', function(e){
                e.preventDefault();
                $('.form-container').hide();
                $($(this).attr('href')).show(); 
                return false;
            } );

             // lost password in proccess
            $('body').on('submit', 'form.forgotpassword-form', function(){
                var $this= $(this);
                $this.find('.alert').remove();
                $this.addClass('loading');
                $.ajax({
                  url: edumy_opts.ajaxurl,
                  type:'POST',
                  dataType: 'json',
                  data:  $(this).serialize()+"&action=apus_ajax_forgotpass"
                }).done(function(data) {
                     $this.removeClass('loading');
                    if ( data.loggedin ) {
                        $this.prepend( '<div class="alert alert-info">'+data.msg+'</div>' );
                        location.reload(); 
                    } else {
                        $this.prepend( '<div class="alert alert-warning">'+data.msg+'</div>' );
                    }
                });
                return false; 
            } );
            $('body').on('click', '#apus_forgot_password_form form .btn-cancel', function(e){
                e.preventDefault();
                $('#apus_forgot_password_form').hide();
                $('#apus_login_form').show();
            } );

            // register
            $('body').on('submit', 'form.apus-register-form', function(){
                var $this= $(this);
                $this.find('.alert').remove();
                $this.addClass('loading');
                $.ajax({
                  url: edumy_opts.ajaxurl,
                  type:'POST',
                  dataType: 'json',
                  data:  $(this).serialize()+"&action=apus_ajax_register"
                }).done(function(data) {
                    $this.removeClass('loading');
                    if ( data.loggedin ) {
                        $this.prepend( '<div class="alert alert-info">'+data.msg+'</div>' );
                        location.reload();
                    } else {
                        $this.prepend( '<div class="alert alert-warning">'+data.msg+'</div>' );
                        grecaptcha.reset();
                    }
                });
                return false;
            } );

            // dont-have-account
            $(document).on('click', '.dont-have-account', function() {
                $('#apus_register_tab').trigger('click');
            });
            $(document).on('click', '.already-have-account', function() {
                $('#apus_login_forgot_tab').trigger('click');
            });
        },
        mapInit: function() {
            if ( $('#event-contact-maps').length > 0 ) {
                var $items = $('#event-contact-maps');
                if ( $items.data('latitude') !== "" && $items.data('longitude') !== "" ) {
                    var latLng = new google.maps.LatLng( $items.data('latitude'), $items.data('longitude') );
                    var zoom = 15;
                
                    // Map
                    var mapOptions = {
                        center: latLng,
                        zoom: zoom
                    };
                    var map = new google.maps.Map( document.getElementById('event-contact-maps'), mapOptions );
                }
            }
        },
        mainMenuInit: function() {
            $('.apus-megamenu .megamenu .has-mega-menu.aligned-fullwidth').each(function(e){
                var $this = $(this),
                    i = $this.closest(".elementor-container"),
                    a = $this.closest('.apus-megamenu');
                $this.on('hover', function(){
                    var m = $(this).find('> .dropdown-menu .dropdown-menu-inner'),
                        w = i.width();
                        console.log(i.offset().left);
                        console.log(a.offset().left);
                    m.css({
                        width: w,
                        marginLeft: i.offset().left - a.offset().left
                    });
                });
            });
        },
        breadcrumbsInit: function() {
            setTimeout(function(){
                if ( $('#apus-breadscrumb').length > 0 && $('body').hasClass('header_transparent') ) {
                    var h_height = $('#apus-header').outerHeight();
                    $('#apus-breadscrumb').css({
                        'padding-top': h_height + 'px'
                    });
                }
            }, 300);
            $(window).resize(function(){
                if ($(window).width() >= 1200) {
                    if ( $('#apus-breadscrumb').length > 0 && $('body').hasClass('header_transparent') ) {
                        var h_height = $('#apus-header').outerHeight();
                        $('#apus-breadscrumb').css({
                            'padding-top': h_height + 'px'
                        });
                    }
                } else {
                    $('#apus-breadscrumb').css({
                        'padding-top':'0px'
                    });
                }
            });
        },
        initMobileMenu: function() {

            // mobile menu
            $('.btn-toggle-canvas,.btn-showmenu').on('click', function (e) {
                e.stopPropagation();
                $('.apus-offcanvas').toggleClass('active');           
                $('.over-dark').toggleClass('active');        
            });
            $('body').on('click', function() {
                if ($('.apus-offcanvas').hasClass('active')) {
                    $('.apus-offcanvas').toggleClass('active');
                    $('.over-dark').toggleClass('active');
                }
            });
            $('.apus-offcanvas').on('click', function(e) {
                e.stopPropagation();
            });

            $(".main-mobile-menu .icon-toggle").on('click', function(){
                $(this).parent().find('> .sub-menu').slideToggle();
                if ( $(this).find('i').hasClass('flaticon-down-arrow') ) {
                    $(this).find('i').removeClass('flaticon-down-arrow').addClass('flaticon-up-arrow');
                } else {
                    $(this).find('i').removeClass('flaticon-up-arrow').addClass('flaticon-down-arrow');
                }
                return false;
            } );

            // sidebar mobile
            $('.sidebar-right, .sidebar-left').perfectScrollbar();
            $('body').on('click', '.mobile-sidebar-btn', function(){
                if ( $('.sidebar-left').length > 0 ) {
                    $('.sidebar-left').toggleClass('active');
                } else if ( $('.sidebar-right').length > 0 ) {
                    $('.sidebar-right').toggleClass('active');
                }
                $('.mobile-sidebar-panel-overlay').toggleClass('active');
            });
            $('body').on('click', '.mobile-sidebar-panel-overlay, .close-sidebar-btn', function(){
                if ( $('.sidebar-left').length > 0 ) {
                    $('.sidebar-left').removeClass('active');
                } else if ( $('.sidebar-right').length > 0 ) {
                    $('.sidebar-right').removeClass('active');
                }
                $('.mobile-sidebar-panel-overlay').removeClass('active');
            });


            // show vertical mobile
            $('.mobile-vertical-menu-title').on('click', function(){
                $('.mobile-vertical-menu').slideToggle();
                $(this).toggleClass('active');
                if ( $(this).find('i').hasClass('flaticon-down-arrow') ) {
                    $(this).find('i').removeClass('flaticon-down-arrow').addClass('flaticon-up-arrow');
                } else {
                    $(this).find('i').addClass('flaticon-down-arrow').removeClass('flaticon-up-arrow');
                }
            });
            $('#vertical-mobile-menu .has-submenu > .icon-toggle').on('click', function (e) {
                e.stopPropagation();
                $(this).parent().find('> .sub-menu').toggle(350);

                if ( $(this).find('i').hasClass('flaticon-down-arrow') ) {
                    $(this).find('i').removeClass('flaticon-down-arrow').addClass('flaticon-up-arrow');
                } else {
                    $(this).find('i').removeClass('flaticon-up-arrow').addClass('flaticon-down-arrow');
                }
            });
        },
        setCookie: function(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires="+d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires+";path=/";
        },
        getCookie: function(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
            }
            return "";
        }
    }

    $.apusThemeCore = ApusThemeCore.prototype;
    
    
    $.fn.wrapStart = function(numWords){
        return this.each(function(){
            var $this = $(this);
            var node = $this.contents().filter(function(){
                return this.nodeType == 3;
            }).first(),
            text = node.text().trim(),
            first = text.split(' ', 1).join(" ");
            if (!node.length) return;
            node[0].nodeValue = text.slice(first.length);
            node.before('<b>' + first + '</b>');
        });
    };

    $(document).ready(function() {
        // Initialize script
        new ApusThemeCore();

        $('.mod-heading .widget-title > span').wrapStart(1);
    });

})(jQuery);

