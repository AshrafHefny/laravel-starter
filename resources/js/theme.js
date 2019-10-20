$(function () {
    'use strict';
    // showing 2nd level sub menu while hiding others
    $('.sidebar-nav-link').on('click', function (e) {
        var subMenu = $(this).next();

        $(this).parent().siblings().find('.sidebar-nav-sub').slideUp();
        $('.sub-with-sub ul').slideUp();

        if (subMenu.length) {
            e.preventDefault();
            subMenu.slideToggle();
        }
    });

    // showing 3rd level sub menu while hiding others
    $('.sub-with-sub .nav-sub-link').on('click', function (e) {
        e.preventDefault();
        $(this).parent().siblings().find('ul').slideUp();
        $(this).next().slideDown();
    });

    $('#slimSidebarMenu').on('click', function (e) {
        e.preventDefault();
        if (window.matchMedia('(min-width: 1200px)').matches) {
            $('body').toggleClass('hide-sidebar');
        } else {
            $('body').toggleClass('show-sidebar');
        }
    });

    if ($.fn.perfectScrollbar) {
        $('.slim-sidebar').perfectScrollbar({
            suppressScrollX: true
        });
    }

    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });


    /////////////////// START: TEMPLATE SETTINGS /////////////////////
    var loc = window.location.pathname;
    var path = loc.split('/');
    var isRtl = (path[1].indexOf('rtl') >= 0) ? true : false; // path[2] for production
    var isSidebar = (path[1].indexOf('sidebar') >= 0) ? true : false; // path[2] for production
    var newloc = '';

    // inject additional link tag for header skin
    $('head').append('<link id="headerSkin" rel="stylesheet" href="">');

    // inject template options content
    /*$.get('../settings.html', function(data){
     $('body').append(data);

     if($.fn.perfectScrollbar) {
     $('.template-options-inner').perfectScrollbar({
     suppressScrollX: true
     });
     }

     // set direction value in settings
     if(isRtl) {
     $('.slim-direction[value="rtl"]').prop('checked', true);
     } else {
     $('.slim-direction[value="ltr"]').prop('checked', true);
     }

     if(isSidebar) {
     $('.nav-layout[value="vertical"]').prop('checked', true);
     } else {
     $('.nav-layout[value="horizontal"]').prop('checked', true);
     }

     //check if header set to sticky
     if($.cookie('sticky-header')) {
     $('body').addClass('slim-sticky-header');
     $('.sticky-header[value="yes"]').prop('checked', true);
     } else {
     $('.sticky-header[value="no"]').prop('checked', true);
     }

     //check if header have skin
     if($.cookie('header-skin')) {
     var sk = $.cookie('header-skin');
     $('body').addClass(sk);
     $('#headerSkin').attr('href',  '../css/slim.'+sk+'.css');
     $('.header-skin[value="'+sk+'"]').prop('checked', true);
     } else {
     $('.header-skin[value="default"]').prop('checked', true);
     }

     //check if page set to wide
     if($.cookie('full-width')) {
     $('body').addClass('slim-full-width');
     $('.full-width[value="yes"]').prop('checked', true);
     } else {
     $('.full-width[value="no"]').prop('checked', true);
     }

     //check if sidebar set to sticky
     if($.cookie('sticky-sidebar') && $('.slim-sidebar').length) {
     $('body').addClass('slim-sticky-sidebar');
     $('.sticky-sidebar[value="yes"]').prop('checked', true);
     } else {
     $('.sticky-sidebar[value="no"]').prop('checked', true);
     }
     });*/

    // show/hide template options panel
    $('body').on('click', '.template-options-btn', function (e) {
        e.preventDefault();
        $('.template-options-wrapper').toggleClass('show');
    });

    // set current page to light mode
    $('body').on('click', '.skin-light-mode', function (e) {
        e.preventDefault();
        newloc = loc.replace('template-dark', 'template');
        if (isSidebar) {
            newloc = loc.replace('sidebar-dark', 'sidebar');
        }
        $(location).attr('href', newloc);
    });

    // set current page to dark mode
    $('body').on('click', '.skin-dark-mode', function (e) {
        e.preventDefault();
        if (loc.indexOf('template-dark') >= 0) {
            newloc = loc;
        } else {
            newloc = loc.replace('template', 'template-dark');
            if (isSidebar) {
                newloc = loc.replace('sidebar', 'sidebar-dark');
            }
        }
        $(location).attr('href', newloc);
    });

    // set current page to rtl/ltr direction
    $('body').on('click', '.slim-direction', function () {
        var val = $(this).val();

        if (val === 'rtl') {
            if (!isRtl) {
                if (path[2]) {
                    newloc = '/' + path[1] + '-rtl/' + path[2];
                } else {
                    newloc = '/' + path[1] + '-rtl/';
                }
                $(location).attr('href', newloc);
            }
        } else {
            if (isRtl) {
                if (path[2]) {
                    newloc = '/' + path[1].replace('-rtl', '') + '/' + path[2];
                } else {
                    newloc = '/' + path[1].replace('-rtl', '') + '/';
                }
                $(location).attr('href', newloc);
            }
        }
    });

    // set current page to sidebar/navbar
    $('body').on('click', '.nav-layout', function () {
        var val = $(this).val();

        if (val === 'vertical') {
            if (!isSidebar) {
                if (loc.indexOf('-dark') >= 0) {
                    if (path[2]) {
                        newloc = '/sidebar-dark/' + path[2];
                    } else {
                        newloc = '/sidebar-dark/';
                    }
                } else {
                    if (path[2]) {
                        newloc = '/sidebar/' + path[2];
                    } else {
                        newloc = '/sidebar/';
                    }
                }
                $(location).attr('href', newloc);
            }
        } else {
            if (isSidebar) {
                if (path[2]) {
                    newloc = '/' + path[1].replace('sidebar', 'template') + '/' + path[2];
                } else {
                    newloc = '/' + path[1].replace('sidebar', 'template') + '/';
                }
                $(location).attr('href', newloc);
            }
        }
    });

    // toggles header to sticky
    $('body').on('click', '.sticky-header', function () {
        var val = $(this).val();
        if (val === 'yes') {
            $.cookie('sticky-header', 'true');
            $('body').addClass('slim-sticky-header');
        } else {
            $.removeCookie('sticky-header');
            $('body').removeClass('slim-sticky-header');
        }
    });

    // toggles sidebar to sticky
    $('body').on('click', '.sticky-sidebar', function () {
        if ($('.slim-sidebar').length) {
            var val = $(this).val();
            if (val === 'yes') {
                $.cookie('sticky-sidebar', 'true');
                $('body').addClass('slim-sticky-sidebar');
            } else {
                $.removeCookie('sticky-sidebar');
                $('body').removeClass('slim-sticky-sidebar');
            }
        } else {
            alert('Can only be used when navigation is set to vertical');
            $('.sticky-sidebar[value="no"]').prop('checked', true);
        }
    });

    // set skin to header
    $('body').on('click', '.header-skin', function () {
        var val = $(this).val();
        if (val !== 'default') {
            $.cookie('header-skin', val);
            $('#headerSkin').attr('href', '../css/slim.' + val + '.css');
        } else {
            $.removeCookie('header-skin');
            $('#headerSkin').attr('href', '');
        }
    });

    // set page to wide
    $('body').on('click', '.full-width', function () {
        var val = $(this).val();
        if (val === 'yes') {
            $.cookie('full-width', 'true');
            $('body').addClass('slim-full-width');
        } else {
            $.removeCookie('full-width');
            $('body').removeClass('slim-full-width');
        }
    });

    /////////////////// END: TEMPLATE SETTINGS /////////////////////

    //////////////////////////////////////////////////////////////// Plugins
    function confirmation() {
        $('button[data-confirm]').on('click', function () {
            var btn = $(this);
            var title = $(this).data("title");
            if (!$('#dataConfirmModal').length) {
                $('body').append('  <div class="modal fade" id="dataConfirmModal" tabindex="-1" role="document">\n\
						   <div class="modal-dialog modal-sm" role="document">\n\
						    <div class="modal-content bd-0">\n\
						      <div class="modal-body tx-center pd-y-20 pd-x-20">\n\
						        Hi there, I am a Modal Example for Dashio Admin Panel.\n\
						      </div>\n\
						      <div class="modal-footer justify-content-center">\n\
						        <button type="button" class="btn btn-master" data-dismiss="modal">Cancel</button>\n\
						        <button class="btn btn-danger" id="dataConfirmOK">Yes</button>\n\
						      </div>\n\
						    </div>\n\
						  </div>\n\
						</div> ');
            }
            $('#dataConfirmModal').find('.modal-body').html('<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>' + $(this).attr('data-confirm'));
            $('#dataConfirmOK').click(function () {
                btn.parent('form').submit();
            });
            $('#dataConfirmModal').modal({show: true});
            return false;
        });
    }
    confirmation();
    $('.select2').select2();
    // Datatable
    var table = $('.dataTable').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
        "order": [[0, 'desc']]
    });
    table.on('draw', function () {
        confirmation();
    });
    $('.dataTables_length select').select2({minimumResultsForSearch: Infinity});
    // Select2

    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        maxDate: 0,
        yearRange:'c-90:c+10'
    });

    $('.editor').trumbowyg({
        svgPath: 'svg/icons.svg',
        btns: [
            // ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            //  ['superscript', 'subscript'],
            ['link'],
            //  ['insertImage'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            // ['horizontalRule'],
            ['removeformat'],
            //['fullscreen']
        ]
    });
    $('.timepicker').timepicker({'disableTextInput': true, 'scrollDefault': 'now', 'step': 15, 'timeFormat': 'h:i A'});

    $('.peity-donut').peity('donut');
    $(document).on('keydown', 'input[pattern]', function (e) {
        var input = $(this);
        var oldVal = input.val();
        var regex = new RegExp(input.attr('pattern'), 'g');
        setTimeout(function () {
            var newVal = input.val();
            if (!regex.test(newVal)) {
                input.val(oldVal);
            }
        }, 0);
    });

});
