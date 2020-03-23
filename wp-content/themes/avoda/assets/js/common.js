jQuery(document).ready(function ($) {
    $('#contact-phone').inputmask("\\+\\9\\7\\2-999-999-9999");
    $('#candidate-telephone').inputmask("\\+\\9\\7\\2-999-999-9999");
    $('#phone-edit').inputmask("\\+\\9\\7\\2-999-999-9999");
    $('#cv-phone').inputmask("\\+\\9\\7\\2-999-999-9999");
        
    // $('#candidate-telephone').mask('+972-__-___-____');
    // $('#phone-edit').mask('+972-__-___-____');
    // $('#cv-phone').mask('+972-__-___-____');

    var $body = $(window.document.body);
    function bodyFreezeScroll() {
        var bodyWidth = $body.innerWidth();
        $body.css('overflow', 'hidden');
        $body.css('marginRight', ($body.css('marginRight') ? '+=' : '') + ($body.innerWidth() - bodyWidth));
        // $body.css('position', 'fixed');
    }

    function bodyUnfreezeScroll() {
        var bodyWidth = $body.innerWidth();
        $body.css('marginRight', '0');
        $body.css('overflow', 'auto');
        $body.css('position', 'relative');
    }

    // main page

    $(".dropdown-item").click(function () {
        $(this).parent().find(".dropdown-lv1").slideToggle(400);
        $(this).find(".arrow-drop").toggleClass('active');
    });

    $("body").on('click', '.third-list-choice' ,function () {
        $(this).toggleClass('active').parent().siblings('.third-list').find(".third-list-choice").removeClass('active');
        $(this).parent().find(".third-drop").slideToggle(400)
        $(this).parent().siblings('.third-list').find(".third-drop").slideUp(400);
    });

    //advanced search
    if($(window).innerWidth() >= 768) {
        $(".second-item").click(function () {
            $(".advanced-search").slideToggle(400);
            $(this).find(".arrow-drop").toggleClass('active');
            $(this).siblings('.second-search').fadeToggle(400);
           $('body').toggleClass('search');
        });
    } else {
        $(".second-item").click(function () {
            $(".advanced-search").slideToggle(400);
          $('body').toggleClass('search');
            $(this).find(".arrow-drop").toggleClass('active');
        });
    }
    
    // $(window).resize(function(){
    //     console.log($(window).innerWidth());
    //     if($(window).innerWidth() >= 768) {
    //         $(".second-item").click(function () {
    //             $(".advanced-search").slideToggle(400);
    //             $(this).find(".arrow-drop").toggleClass('active');
    //             $(this).siblings('.second-search').fadeToggle(400);
    //         });
    //     } else {
    //         $(".second-item").click(function () {
    //             $(".advanced-search").slideToggle(400);
    //             $(this).find(".arrow-drop").toggleClass('active');
    //         });
    //     }
    // })

    $(".second-item-search").click(function () {
        $(".second-search").slideToggle(400);
        $(this).find(".arrow-drop").toggleClass('active');
    });

    $(".advanced-search-flex .advanced-search-tab").click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        var index = $(this).index();
        $(this).parent(".advanced-search-flex").siblings('.advanced-search-drop').eq(index).addClass('active').siblings().removeClass('active');
    });

    
    
    $(".third-slider").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: true,
        centerMode: true,
        rtl: true,
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    variableWidth: true,
                    slidesToShow: 4,
                },
                breakpoint: 768,
                settings: {
                    variableWidth: true,
                    centerMode: false,
                    slidesToShow: 2,

                },
                breakpoint: 768,
                settings: {
                    variableWidth: false,
                    centerMode: false,
                    slidesToShow: 2,

                },

            }

        ]
    });

    $(".header-burder").click(function () {

        $(this).toggleClass('active');
        $(".header-menu, .header-sing").toggleClass('active');
        if($(".header-burder").hasClass('active')){
            bodyFreezeScroll();
        } else {
            $(".header-form, .header-left, .header-link").removeClass('active');
            bodyUnfreezeScroll();
        }
    });
    $(function() {
        $.fn.scrollToTop = function(e) {

            $(this).click(function() {
                $("html, body").animate({scrollTop: 0}, "slow")
            })
        }
    });

    
    $(".fixed-up").click(function (e) {
        e.preventDefault();
        $('html,body').animate({scrollTop:$('.header').offset().top + "px"},{duration:1E3});
    });

    /*if ($(".advanced-search-drop.active")){
        $(".advanced-search-item").click(function () {
            $(this).addClass('active').siblings().removeClass('active');
            var index = $(this).index();
            $(this).parents(".advanced-search-list").find(".advanced-search-inner").eq(index).addClass('active').siblings().removeClass('active');
        });
    }*/

     $(".fixed-support").click(function (e) {
         e.preventDefault();
         $.fancybox.open({
             src: ".popup-sending",
             type: "inline",
             opts: {
                 clickOutside: false,
                 touch: false,
                 smallBtn: false,
                 toolbar: false
             }

         });
     });


    $(".popup-close, .overlay").click(function () {
        $(".popup, .overlay").removeClass('active');
        bodyUnfreezeScroll();
    });

    $(".first-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows: false,
        centerMode: true,
        rtl: true,
        fade: true,
        speed: 2000,
        autoplay: true,
        autoplaySpeed: 4000,
    });

    $(".header-link").click(function (e) {
        $(this).addClass('active').siblings().removeClass('active');
        $(this).addClass('active').parents().siblings().find(".header-link").removeClass('active');
        if ($(".header-link-registration").hasClass("active")){
            e.preventDefault();
            $(".header-form").removeClass('active');
            $(".header-form-registration").toggleClass('active');
        } else if ($(".header-link-sing").hasClass("active")){
            e.preventDefault();
            $(".header-form").removeClass('active');
            $(".header-form-sing").toggleClass('active');
        } else {
            $(".header-form").removeClass('active');
        }

    });
    $(document).mouseup(function (e){
        var form = $(".header-form");
        if (!form.is(e.target) && form.has(e.target).length === 0) {
            form.removeClass('active');
        }
    });

    $(".header-next-registration").click(function (e) {
        e.preventDefault();
        $(".header-form, .header-link").removeClass('active');
        $(".header-form-registration, .header-link-registration").addClass('active');
    });

    /*$(".account-btn").click('submit', function () {
        $(".popup-thanks-data, .overlay").addClass('active');

    });
    $(".account-edit").click(function (e) {
        e.preventDefault();
        $(".popup-edit, .overlay").addClass('active');
    });*/
    $(".account-edit-foto").click(function (e) {
        $(".popup-edit").removeClass('active');
        $(".popup-foto, .overlay").addClass('active');
    });
    $(".header-next-recovery").click(function (e) {
        e.preventDefault();
        $.fancybox.open({
            src: ".popup-reset-pass",
            type: "inline",
            opts: {
                clickOutside: false,
                touch: false,
                smallBtn: false,
                toolbar: false
            }

        });
    });

    $(".btn-edit-work").click(function (e) {
        e.preventDefault();
        var edit_block_id = $(this).data('edit_id');
        $(".account-drop-work ").slideUp(400);
        var show_elem = '.account-work-editing-' + edit_block_id;
        $(show_elem).slideDown(400);

        $('html, body').animate({
            scrollTop: $('.account-flex').offset().top
        }, 1000);
    });

    $(".btn-edit-vacancy-moderation").click(function (e) {
        e.preventDefault();
        var edit_block_id = $(this).data('id');
        $(".account-drop-archives ").slideUp(400);
        var show_elem = '.account-work-editing-' + edit_block_id;
        $(show_elem).slideDown(400);

        $('html, body').animate({
            scrollTop: $('.account-flex').offset().top
        }, 1000);
    });

    

    $(".account-tab").click(function (e) {
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
        var index = $(this).index();
        $(".account-drop ").eq(index).addClass('active').siblings().removeClass('active');
        $(".account-drop-main, .account-form-mob").hide();
        $(".account-drop-work").slideDown(400);
        $(".account-work-editing").slideUp(400);
        $(".account-drop-archives").slideDown(400);
        $(".account-archives-edit").slideUp(400);
    });

    $(".header-sing").click(function (e) {
        e.preventDefault();
        $(".header-left").addClass('active');
        $(".header-left .header-link").removeClass('active');
    });

    if($(".popup")){
        if( $(this).find(".popup-container").parent(".popup").height() >= $(window).height()){
            $(".popup").addClass('active-top');
        }
    }

    $(".account-form-tabs .account-form-tab").click(function () {
        $(this).addClass('active').siblings().removeClass('active');
        var index = $(this).index();
        $(this).parents('.account-form-tabs').siblings('.account-form-drop').find('.account-form-list').eq(index).addClass('active').siblings().removeClass('active');
    });

    

    $(".account-form-item").click(function () {
        $(".account-form-accordion").slideToggle(400);
        $(this).find(".arrow-drop").toggleClass('active');
    });

    $(".account-select").select2({
        minimumResultsForSearch: -1,
        placeholder: "טסקט",
    });

    $(".account-select-add").select2({
        minimumResultsForSearch: -1,
        placeholder: "טסקט",
    });

    /*--- theme scripts ---*/
    $('.cstFileUpload').click(function(){
        $('.popup-load-hide').click();
    })

     $('.popup-load-hide').change(function(){
        var val = $(this).val();
        $('.cst-file-was-upload').text(val);
        console.log(val);
    })
    
    $('body').on('wpcf7mailsent', function (event) {
        if ($( '43' == event.detail.contactFormId )) {
            $.fancybox.close();
            $.fancybox.open({
                src: ".thanksForCv",
                type: "inline",
                opts: {
                    clickOutside: false,
                    touch: false,
                    smallBtn: false,
                    toolbar: false
                }
            });
        }
    });

    $('.watch-cv').on('click',function(e){
        e.preventDefault();
        var _this = $(this);
        var show_cv = _this.data('id');
        var parent = _this.parents('.account-drop');

        if(parent.find('.account-archives-edit-' + show_cv).length>0) {
            _this.parents('.account-drop-work').slideUp(600);
            parent.find('.account-archives-edit-' + show_cv).slideDown(600);
        } else {
            return false;
        }
    })

    $(".btn-edit-archives").click(function (e) {
        e.preventDefault();
        var _this = $(this);
        var show_cv = _this.data('id');
        var parent = _this.parents('.account-drop');

        if(parent.find('.account-archives-edit-' + show_cv).length>0) {
            _this.parents('.account-drop-archives').slideUp(600);
            parent.find('.account-archives-edit-' + show_cv).slideDown(600);
        } else {
            return false;
        }
    });

    $('form#additional-filter').on('submit', function(e) {
        e.preventDefault();
        var _this = $(this);

        var post_field_of_office = new Array();
        var post_type_of_job = new Array();
        var post_scope_of_job = new Array();
        var post_term_of_work = new Array();

        var post_vacancy_city_north = new Array();
        var post_vacancy_city_sharon = new Array();
        var post_vacancy_city_center = new Array();
        var post_vacancy_city_jerusalem = new Array();
        var post_vacancy_city_south = new Array();
        var post_vacancy_city_lowland = new Array();

        var category_north = _this.find("#city-north").find('.checkbox:checked');
        $.each(category_north, function() {
            post_vacancy_city_north.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_sharon = _this.find("#city-sharon").find('.checkbox:checked'); 
        $.each(category_sharon, function() {
            post_vacancy_city_sharon.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_center = _this.find("#city-center").find('.checkbox:checked'); 
        $.each(category_center, function() {
            post_vacancy_city_center.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_jerusalem = _this.find("#jerusalem-city").find('.checkbox:checked'); 
        $.each(category_jerusalem, function() {
            post_vacancy_city_jerusalem.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_south = _this.find("#south-city").find('.checkbox:checked'); 
        $.each(category_south , function() {
            post_vacancy_city_south.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_lowland = _this.find("#lowland-city").find('.checkbox:checked'); 
        $.each(category_lowland, function() {
            post_vacancy_city_lowland.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_field_of_office = _this.find('#field_of_office').find('.checkbox:checked');
        $.each(category_field_of_office, function() {
            post_field_of_office.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_type_of_job = _this.find('#type_of_job').find('.checkbox:checked');
        $.each(category_type_of_job, function() {
            post_type_of_job.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_scope_of_job = _this.find('#scope_of_job').find('.checkbox:checked');
        $.each(category_scope_of_job, function() {
            post_scope_of_job.push($(this).siblings('.dropdown-lv1-name').text());
        });
        
        var category_term_of_work = _this.find('#term_of_job').find('.checkbox:checked');
        $.each(category_term_of_work, function() {
            post_term_of_work.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var data = {
            'action': 'additionalfilter',
            'category_north':post_vacancy_city_north,
            'category_sharon':post_vacancy_city_sharon,
            'category_center':post_vacancy_city_center,
            'category_jerusalem':post_vacancy_city_jerusalem,
            'category_south':post_vacancy_city_south,
            'category_lowland':post_vacancy_city_lowland,
            'category_field_of_office': post_field_of_office,
            'category_scope_of_job': post_scope_of_job,
            'category_type_of_job': post_type_of_job,
            'category_term_of_work': post_term_of_work
        };

        console.log(data);

        $.ajax({
            url: ajax_account_object.ajax_url,
            type: 'POST',
            data: data,
            success: function (data, textStatus, jqXHR) {
                 _this.parent().siblings('.third').fadeOut(300);
                 _this.siblings('.filter-response').slideDown(300);
                 _this.siblings('.filter-response').find('.filter-response_inner').html(data);
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
        });

    });

    $('form#additional-filter-small').on('submit', function(e) {
        e.preventDefault();
        var _this = $(this);

        var post_field_of_office = new Array();

        var post_vacancy_city_north = new Array();
        var post_vacancy_city_sharon = new Array();
        var post_vacancy_city_center = new Array();
        var post_vacancy_city_jerusalem = new Array();
        var post_vacancy_city_south = new Array();
        var post_vacancy_city_lowland = new Array();

        var category_north = _this.find("#add-filter-city-north").find('.checkbox:checked');
        $.each(category_north, function() {
            post_vacancy_city_north.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_sharon = _this.find("#add-filter-city-sharon").find('.checkbox:checked'); 
        $.each(category_sharon, function() {
            post_vacancy_city_sharon.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_center = _this.find("#add-filter-city-center").find('.checkbox:checked'); 
        $.each(category_center, function() {
            post_vacancy_city_center.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_jerusalem = _this.find("#add-filter-city-jerusalem").find('.checkbox:checked'); 
        $.each(category_jerusalem, function() {
            post_vacancy_city_jerusalem.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_south = _this.find("#south-city").find('.checkbox:checked'); 
        $.each(category_south , function() {
            post_vacancy_city_south.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_lowland = _this.find("#lowland-city").find('.checkbox:checked'); 
        $.each(category_lowland, function() {
            post_vacancy_city_lowland.push($(this).siblings('.dropdown-lv1-name').text());
        });

        var category_field_of_office = _this.find('#add-filter-office').find('.checkbox:checked');
        $.each(category_field_of_office, function() {
            post_field_of_office.push($(this).siblings('.dropdown-lv1-name').text());
        });


        var data = {
            'action': 'additionalfilter-small',
            'category_north':post_vacancy_city_north,
            'category_sharon':post_vacancy_city_sharon,
            'category_center':post_vacancy_city_center,
            'category_jerusalem':post_vacancy_city_jerusalem,
            'category_south':post_vacancy_city_south,
            'category_lowland':post_vacancy_city_lowland,
            'category_field_of_office': post_field_of_office,
        };

        console.log(data);

        $.ajax({
            url: ajax_account_object.ajax_url,
            type: 'POST',
            data: data,
            success: function (data, textStatus, jqXHR) {
                 _this.parent().siblings('.third').slideUp(300);
                 _this.siblings('.filter-response').slideDown(300);
                 _this.siblings('.filter-response').find('.filter-response_inner').html(data);
            },
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
        });

    });


    $('.reset-filter').on('click', function(e) {
        e.preventDefault();
        var _this = $(this);
        var parent = _this.parent();

        parent.parent().siblings('.third').slideDown(300);
        parent.find('.filter-response_inner').html('');
        parent.slideUp(300);

        $('#additional-filter').find('.checkbox').prop('checked', false);
        $('#additional-filter-small').find('.checkbox').prop('checked', false);
        $('#additional-filter').find('.radio').prop('checked', false);

    })

    $('.header-form-label a').click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation()
        alert($(this).attr('href'));
    });
    /*--- end ---*/

    /** FAQ start **/
    $('.panel-group__item').click(function(){
        var th = $(this);
        $(th).find('.faq-description').slideToggle(400);
        $(th).find(".fa-chevron-up").toggleClass('display_up');
        $(th).find(".fa-chevron-down").toggleClass('display_none');
    });
    /** FAQ end **/

    /** All Checkbox **/
    
    $(document).on("change", "input[type=checkbox]", function() { // По изменению checkbox'а
        if ($(this).attr('class')) {
            var CBgroupID = $(this).attr('class');
        }
        if (($(this).attr('id')) && ($('input[type="checkbox"].' + $(this).attr('id')).length)) { 
            var CBgroupID = $(this).attr('id');
            if (this.checked) {
                $('input[type="checkbox"].' + CBgroupID).attr('checked', 'checked');
                $('input[type="button"][class*="' + CBgroupID + '"]').removeAttr('disabled');
            } else {
                $('input[type="checkbox"].' + CBgroupID).removeAttr('checked');
                $('input[type="button"][class*="' + CBgroupID+'"]').attr('disabled', 'disabled');
            }
        }
        if (!CBgroupID) {
            return;
        }
        if ($('input[type="checkbox"].' + CBgroupID + ':not(:checked)').length) {
            $('input[type="checkbox"]#' + CBgroupID).removeAttr('checked');
        } else {
            $('input[type="checkbox"]#' + CBgroupID).attr('checked', 'checked');
        }
        if ($('input[type="checkbox"].' + CBgroupID+':checked').length) {
            $('input[type="button"][class*="' + CBgroupID + '"]').removeAttr('disabled');
        } else {
            $('input[type="button"][class*="' + CBgroupID + '"]').attr('disabled', 'disabled');
        }
        if ($('input[type="checkbox"].' + CBgroupID + ':checked').length === 1) {
            $('.jToEdit').removeAttr('disabled');
        } else {
            $('.jToEdit').attr('disabled', 'disabled');
        }
        delete CBgroupID;
    });
    /** End All Checkbox **/

    /*** Salery Switcher ***/

        $('#swich_hourly').click(function(){
            $('#swich_hourly').addClass('active');
            $('#swich_mounthly').removeClass('active');
        });

        $('#swich_mounthly').click(function(){
            $('#swich_mounthly').addClass('active');
            $('#swich_hourly').removeClass('active');
        });

     /*** Salery Switcher End***/

     /*** Filter Carret ***/
     $('.drop__field_type').click(function(){
        var th = $(this);
        $(th).find(".fa-sort-down").toggleClass('display_none');
        $(th).find(".fa-caret-up").toggleClass('display_up');
        $('.drop__field-wrapper').find(".work__type").slideToggle();
    });
	$('.drop__field_direction').click(function(){
        var th = $(this);
        $(th).find(".fa-sort-down").toggleClass('display_none');
        $(th).find(".fa-caret-up").toggleClass('display_up');
        $('.drop__field-wrapper').find(".work__area").slideToggle();
    });
  
  
    /*** Scroll ***/   
    let oldScroll = 0;
  
    $(document).scroll(function() {

    var scrollTop = $(window).scrollTop(); 
      if(scrollTop < oldScroll) { 
        $('.fixed').removeClass('open');
      } else if(scrollTop > oldScroll) {
        $('.fixed').addClass('open');
      } 
      oldScroll = scrollTop;
    });
     /*** END Scroll ***/     


});
