// Empty JS for your own code to be here
//jquery konfirmasi
jQuery(function($) 
{
    //edit
    $('.confirm-edit').on('click', function (e) { 
        var href = this.href;
        if (!$(this).data('response')) 
        {           
           e.preventDefault();
        }
        bootbox.dialog({
            title:"Konfirmasi",
            message: "Yakin ingin merubah data ini?",
            buttons: {
                "cancel" : {
                    "label" : "<i class='ace-icon fa fa-times'></i> Tidak",
                    "className" : "btn-sm btn-danger"
                },
                "main" : {
                    "label" : "<i class='ace-icon fa fa-check'></i> Ya",
                    "className" : "btn-sm btn-primary",
                    callback:function(response){
                        if (response) {
                            window.location = href;
                        }
                    }
                }
            }
        });       
    });
    //end edit

    //delete
    $('.confirm-delete').on('click', function (e) { 
        var href = this.href;
        if (!$(this).data('response')) 
        {           
           e.preventDefault();
        }
        bootbox.dialog({
            title:"Konfirmasi",
            message: "Yakin ingin menghapus data ini?",
            buttons: {
                "cancel" : {
                    "label" : "<i class='ace-icon fa fa-times'></i> Tidak",
                    "className" : "btn-sm btn-danger"
                },
                "main" : {
                    "label" : "<i class='ace-icon fa fa-check'></i> Ya",
                    "className" : "btn-sm btn-primary",
                    callback:function(response){
                        if (response) {
                            window.location = href;
                        }
                    }
                }
            }
        });       
    });
    //end delete
})
//jquery konfirmasi

//choosen
$(".select-single").select2({

})
// end chosen select

$(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $(".side-nav .collapse").on("hide.bs.collapse", function() {                   
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
    });
    $('.side-nav .collapse').on("show.bs.collapse", function() {                        
        $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");        
    });
})


// password metter
$(document).ready(function(){

//minimum 8 characters
var bad = /(?=.{8,}).*/;
//Alpha Numeric plus minimum 8
var good = /^(?=\S*?[a-z])(?=\S*?[0-9])\S{8,}$/;
//Must contain at least one upper case letter, one lower case letter and (one number OR one special char).
var better = /^(?=\S*?[A-Z])(?=\S*?[a-z])((?=\S*?[0-9])|(?=\S*?[^\w\*]))\S{8,}$/;
//Must contain at least one upper case letter, one lower case letter and (one number AND one special char).
var best = /^(?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9])(?=\S*?[^\w\*])\S{8,}$/;

$('#password').on('keyup', function () {
    var password = $(this);
    var pass = password.val();
    var passLabel = $('[for="password"]');
    var stength = 'Weak';
    var pclass = 'danger';
    if (best.test(pass) == true) {
        stength = 'Very Strong';
        pclass = 'success';
    } else if (better.test(pass) == true) {
        stength = 'Strong';
        pclass = 'warning';
    } else if (good.test(pass) == true) {
        stength = 'Almost Strong';
        pclass = 'warning';
    } else if (bad.test(pass) == true) {
        stength = 'Weak';
    } else {
        stength = 'Very Weak';
    }

    var popover = password.attr('data-content', stength).data('bs.popover');
    popover.setContent();
    popover.$tip.addClass(popover.options.placement).removeClass('danger success info warning primary').addClass(pclass);

});

$('input[data-toggle="popover"]').popover({
    placement: 'top',
    trigger: 'focus'
});

})
// password metter


//back to top//
$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});
//back to top//

//tooltips//
$(document).ready(function(){
    // Method 1 - uses 'data-toggle' to initialize
$('[data-toggle="myToolTip"]').tooltip();   

/* - - - - - - - - - - - - - - - - - - - */

// Method 2 - uses the id, class or native tag, could use .btn as class 

$('button').tooltip();

// options set in JS by class
    $(".tip-top").tooltip({
        placement : 'top'
    });
    $(".tip-right").tooltip({
        placement : 'right'
    });
    $(".tip-bottom").tooltip({
        placement : 'bottom'
    });
    $(".tip-left").tooltip({
        placement : 'left',
        html : true
    });

    $(".tip-auto").tooltip({
        placement : 'auto',
        html : true
    });

});
//tooltips//



