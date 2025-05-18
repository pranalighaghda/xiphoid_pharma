// login start
var csrf = $('meta[name="csrf-token"]').attr('content');
var base_url = $('meta[name="base_url"]').attr('content');
var curr_url = window.location.origin+window.location.pathname;

jQuery(".form-control")
  .on("blur", function() {
    if (jQuery(this).val().length <= 0) {
      jQuery(this)
        .siblings("label")
        .removeClass("moveUp");
      jQuery(this).removeClass("outline");
    }
  })
  .on("focus", function() {
    if (jQuery(this).val().length >= 0) {
      jQuery(this)
        .siblings("label")
        .addClass("moveUp");
      jQuery(this).addClass("outline");
    }
  });

// login over

$('.give_service_class input[type=radio][name=give_service]').change(function() {
    if (this.value == 'Salon') {
        $("#home_charges_div").hide(600);
        $("#home_charges_div").removeClass("display-none");
    }
    else{
        $("#home_charges_div").show(600);
        $("#home_charges_div").removeClass("display-none");
    }
});

function service_search()
{
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_service");
    filter = input.value.toUpperCase();
    table = document.getElementById("main_div");
    tr = table.getElementsByClassName("single_div");
    for (i = 0; i < tr.length; i++)
    {
        td = tr[i].getElementsByTagName("h4")[0];
        if (td)
        {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) == -1) {
                tr[i].style.setProperty( 'display', 'none', 'important' );
            } else {
                tr[i].style.display = "block";
            }
        }
    }
}

function emp_search()
{
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_emp");
    filter = input.value.toUpperCase();
    table = document.getElementById("main_div_emp");
    tr = table.getElementsByClassName("single_div_emp");
    for (i = 0; i < tr.length; i++)
    {
        td = tr[i].getElementsByTagName("h4")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) == -1) {
                tr[i].style.setProperty( 'display', 'none', 'important' );
            } else {
                tr[i].style.display = "block";
            }
        }
    }
}

function hideCategory(categoryId)
{
    $.ajax({
        url: 'categories/hideCategory',
        method: 'post',
        data: {categoryId: categoryId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}

function changeDirection(languageId)
{
    $.ajax({
        url: 'language/changeDirection',
        method: 'post',
        data: {languageId: languageId, _token: csrf},
        success: function(res) {
            window.location.reload();
        },
        error: function(error) {}
    });
}

function hideLanguage(languageId)
{
    $.ajax({
        url: 'language/hideLanguage',
        method: 'post',
        data: {languageId: languageId, _token: csrf},
        success: function(res) {
            window.location.reload();
        },
        error: function(error) {}
    });
}
function hideUser(userId)
{
    $.ajax({
        url: 'users/hideUser',
        method: 'post',
        data: {userId: userId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideSalon(salonId)
{
    $.ajax({
        url: 'salons/hideSalon',
        method: 'post',
        data: {salonId: salonId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideService(serviceId)
{
    $.ajax({
        url: 'services/hideService',
        method: 'post',
        data: {serviceId: serviceId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideGallery(galleryId)
{
    $.ajax({
        url: 'gallery/hideGallery',
        method: 'post',
        data: {galleryId: galleryId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideCoupon(couponId)
{
    $.ajax({
        url: 'coupon/hideCoupon',
        method: 'post',
        data: {couponId: couponId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideEmp(empId)
{
    $.ajax({
        url: 'employee/hideEmp',
        method: 'post',
        data: {empId: empId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideBanner(bannerId)
{
    $.ajax({
        url: 'banner/hideBanner',
        method: 'post',
        data: {bannerId: bannerId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}
function hideOffer(offerId)
{
    $.ajax({
        url: 'offer/hideOffer',
        method: 'post',
        data: {offerId: offerId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}

function changeStatus(bookingId)
{
    var con = "#selector"+bookingId;
    var status = $(con).val();
    $.ajax({
        url: 'booking/changestatus',
        method: 'post',
        data: {bookingId: bookingId,status: status, _token: csrf},
        success: function(res) {
            if (status == 'Completed' || status == 'Cancel') {
                $(con).prop("disabled", true);
            }
        },
        error: function(error) {}
    });
}

function reportReview(reviewId)
{
    $.ajax({
        url: 'review/reportreview',
        method: 'post',
        data: {reviewId: reviewId, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}

$(document).ready(function() {
    // Select2
    $(".select2").select2({
        width: '-webkit-fill-available'
    });

    // Editor
    $('#template_form .textarea_editor').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link','picture']],
            ['view', [ 'codeview', 'help']]
        ],
        height: 500,
    });
    $('#settingform .terms_conditions').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link','picture']],
            ['view', [ 'codeview', 'help']]
        ],
        height: 300,
    });
    $('#settingform .privacy_policy').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link','picture']],
            ['view', [ 'codeview', 'help']]
        ],
        height: 300,
    });

    // 

});

function template_edit(id,base_url) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type:"get",
        url:base_url+'/admin/notification/template/edit/'+id,
        success: function(result){
            document.getElementById('temp_title').innerHTML = result.data.title;
            $(".form-group input[name='subject']").val(result.data.subject);
            $(".form-group input[name='msg_content']").val(result.data.msg_content);
            $("input[name='mail_content']").val(result.data.mail_content);

            // $('#template_form .textarea_editor').data("wysihtml5").editor.setValue(result.data.mail_content);
            $('#template_form .textarea_editor').summernote('code', result.data.mail_content);


            $('#template_form').get(0).setAttribute('action', base_url+'/admin/notification/template/update/'+result.data.id);
        },
        error: function(err){
            console.log('err ',err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys( err.responseJSON.errors)) {
                $(".invalid-div ."+v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}
function copy_function(id){
    var value = document.getElementById(id).innerHTML;
    var input_temp = document.createElement("input");
    input_temp.value = value;
    document.body.appendChild(input_temp);
    input_temp.select();
    document.execCommand("copy");
    document.body.removeChild(input_temp);
};

function copy_url(url){
    var input_temp = document.createElement("input");
    input_temp.value = url;
    document.body.appendChild(input_temp);
    input_temp.select();
    document.execCommand("copy");
    document.body.removeChild(input_temp);
};

$(document).ready(function () {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        language: {
            paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
            }
        },
        buttons: [{
                extend: 'copyHtml5',
                title: new Date().toISOString()
            },
            {
                extend: 'excelHtml5',
                title: new Date().toISOString()
            },
            {
                extend: 'csvHtml5',
                title: new Date().toISOString()
            },
            {
                extend: 'pdfHtml5',
                title: new Date().toISOString()
            },
        ]
    });
    $('#dataTableUser').DataTable({
        dom: 'Bfrtip',
        language: {
            paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
            }
        },
        buttons: []
    });
});

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};

var loadFile_banner = function(event) {
    var output = document.getElementById('banner_output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};

var loadFile_edit_banner = function(event) {
    var output = document.getElementById('output_edit_banner');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};


var loadFile_edit = function(event) {
    var output = document.getElementById('output_edit');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src)
    }
};

var loadFile1 = function(event) {
    var black_logo = document.getElementById('black_logo_output');
    black_logo.src = URL.createObjectURL(event.target.files[0]);
    black_logo.onload = function() {
        URL.revokeObjectURL(black_logo.src)
    }
};
var loadFile2 = function(event) {
    var white_logo = document.getElementById('white_logo_output');
    white_logo.src = URL.createObjectURL(event.target.files[0]);
    white_logo.onload = function() {
        URL.revokeObjectURL(white_logo.src)
    }
};

var loadFile3 = function(event) {
    var bg_img = document.getElementById('bg_img_output');
    bg_img.src = URL.createObjectURL(event.target.files[0]);
    bg_img.onload = function() {
        URL.revokeObjectURL(bg_img.src)
    }
};

var loadFile4 = function(event) {
    var shared_image = document.getElementById('shared_image_output');
    shared_image.src = URL.createObjectURL(event.target.files[0]);
    shared_image.onload = function() {
    URL.revokeObjectURL(shared_image.src)
    }
};
// day off 

$(document).ready(function() {
    $('.check_center .salonCheck').on('change', function (e) {
        if($(this).prop("checked") == true){
            $('.input-group  input[name="'+this.value+'open"]').attr('disabled', true);
            $('.input-group  input[name="'+this.value+'close"]').attr('disabled', true);
            
            $('.input-group  input[name="'+this.value+'open"]').val('');
            $('.input-group  input[name="'+this.value+'close"]').val('');
        }
        else{
            $('.input-group  input[name="'+this.value+'open"]').attr('disabled', false);
            $('.input-group  input[name="'+this.value+'close"]').attr('disabled', false);
        }
    });
})

function salonDayOff(day,base_url)
{
    $.ajax({
        url: base_url + '/owner/salons/dayoff',
        method: 'post',
        data: {day: day, _token: csrf},
        success: function(res) {},
        error: function(error) {}
    });
}

//Appointment
$(".add_appointment").click(function (){
    $(".invalid-div span").html('');
    $("#add_appointment_sidebar").slideDown(50), $("#add_appointment_sidebar").toggleClass("show_sidebar_create")
});

var service;
var date;


// Book Appointment

$(document.body).on("change","#booking_at",function(){
    if (this.value == 'Salon') {
        $("#address_div").hide(600);
        $("#address_div").removeClass("display-none");
    }
    else{
        $("#address_div").show(600);
        $("#address_div").removeClass("display-none");
    }
});

$(document.body).on("change",".users_class",function(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type:"POST",
        url:'booking/addressSelect',
        data: {user_id: $(this).val(), _token: csrf},
        success: function(result){
            $('.address_id').html('<option value=""  disabled selected> -- Select Address -- </option>');
            if(result.success == true) {
                result.data.forEach(element => {
                    $('.address_id').append('<option value="'+element.address_id+'">'+element.street+', '+element.city+', '+element.state+'</option>');
                });
            }
        },
        error: function(err){}
    });
});

$(document.body).on("change",".service_class",function(){
    var booking_at = $('#booking_at').val();
    service = $(this).val();
    if ($(this).val().length == 0) {
        $("#create_appointment_form input[name='payment']").val(0);
    }
    else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            type:"POST",
            url:'booking/paymentcount',
            data: {ser_id: $(this).val(), booking_at:booking_at, _token: csrf},
            success: function(result){
                $(".invalid-div span").html('');
                $("#create_appointment_form input[name='payment']").val(result.data.price);
            },
            error: function(err){}
        });
    }
});

$(document.body).on("change",".select_date",function() {
    date = $(this).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type:"POST",
        url:'booking/timeslot',
        data: {date: $(this).val(), _token: csrf},
        success: function(result){
            $('#start_time').html('<option value=""  disabled selected> -- Select Time -- </option>');
            if(result.success == true) {
                result.data.forEach(element => {
                    $('#start_time').append('<option value="'+element.start_time+'">'+element.start_time+'</option>');
                });
            } else {
                $('#start_time').html('<option value="" disabled selected> Closed </option>');
            }
        },
        error: function(err){}
    });
});

$(document.body).on("change",".start_time",function() {
    var booking_at = $('#booking_at').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type:"POST",
        url:'booking/selectemployee',
        data: {start_time: $(this).val(), service:service, date:date, booking_at:booking_at, _token: csrf},
        success: function(result){
            $('#emp_id').html('<option value=""  disabled selected> -- Select Employee -- </option>');
            if(result.success == true) {
                result.data.forEach(element => {
                    $('#emp_id').append('<option value="'+element.emp_id+'">'+element.name+'</option>');
                });
            } else {
                $('#emp_id').html('<option value="" disabled selected> -- No employee available at this time -- </option>');
            }
        },
        error: function(err){}
    });
});


// salon owner
$(".show_owner_close").click(function (){
    $("#show_owner_sidebar").slideDown(50), $("#show_owner_sidebar").toggleClass("show_sidebar")
});
// module 1234
$(".add_module").click(function (){ 
    $(".invalid-div span").html('');
    $("#add_module_sidebar input[name='zip']").val('');
    $("#add_module_sidebar").slideDown(50), $("#add_module_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_loyaltyModule_close").click(function (){
    $("#edit_loyaltyModule_sidebar").slideDown(50), $("#edit_loyaltyModule_sidebar").toggleClass("show_sidebar_edit")
});

// Open Cat
$(".add_cat").click(function (){
    $(".invalid-div span").html('');
    $("#add_cat_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_cat_sidebar").slideDown(50), $("#add_cat_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_cat_close").click(function (){
    $("#edit_cat_sidebar input[name='image']").val('');
    $("#edit_cat_sidebar").slideDown(50), $("#edit_cat_sidebar").toggleClass("show_sidebar_edit")
});

// Open banner
$(".add_banner").click(function (){
    $(".invalid-div span").html('');
    $("#add_banner_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_banner_sidebar").slideDown(50), $("#add_banner_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_banner_close").click(function (){
    $("#edit_banner_sidebar input[name='image']").val('');
    $("#edit_banner_sidebar").slideDown(50), $("#edit_banner_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_banner_close").click(function (){
    $("#show_banner_sidebar").slideDown(50), $("#show_banner_sidebar").toggleClass("show_sidebar")
});

// Open Offer
$(".add_offer").click(function (){
    $(".invalid-div span").html('');
    $("#add_offer_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_offer_sidebar").slideDown(50), $("#add_offer_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_offer_close").click(function (){
    $("#edit_offer_sidebar input[name='image']").val('');
    $("#edit_offer_sidebar").slideDown(50), $("#edit_offer_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_offer_close").click(function (){
    $("#show_offer_sidebar").slideDown(50), $("#show_offer_sidebar").toggleClass("show_sidebar")
});

// Language
$(".add_language").click(function (){
    $(".invalid-div span").html('');
    $("#add_language_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_language_sidebar").slideDown(50), $("#add_language_sidebar").toggleClass("show_sidebar_create")
});

// Open Coupon
$(".add_coupon").click(function (){
    $(".invalid-div span").html('');
    $("#add_coupon_sidebar").slideDown(50), $("#add_coupon_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_coupon_close").click(function (){
    $("#edit_coupon_sidebar").slideDown(50), $("#edit_coupon_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_coupon_close").click(function (){
    $("#show_coupon_sidebar").slideDown(50), $("#show_coupon_sidebar").toggleClass("show_sidebar")
});

// open review
$(".show_reported_review_close").click(function (){
    $("#show_reported_review_sidebar").slideDown(50), $("#show_reported_review_sidebar").toggleClass("show_sidebar")
});

// Owner
// Users
$(".add_user").click(function (){
    $(".invalid-div span").html('');
    $("#add_user_sidebar").slideDown(50), $("#add_user_sidebar").toggleClass("show_sidebar_create")
});

// Services
$(".add_service").click(function (){
    $(".invalid-div span").html('');
    $("#add_service_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_service_sidebar").slideDown(50), $("#add_service_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_service_close").click(function (){
    $("#edit_service_sidebar input[name='image']").val('');
    $("#edit_service_sidebar").slideDown(50), $("#edit_service_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_service_close").click(function (){
    $("#show_service_sidebar").slideDown(50), $("#show_service_sidebar").toggleClass("show_sidebar")
});

// gallery
$(".add_gallery").click(function (){
    $(".invalid-div span").html('');
    $("#add_gallery_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_gallery_sidebar").slideDown(50), $("#add_gallery_sidebar").toggleClass("show_sidebar_create")
});

$(".show_gallery_close").click(function (){
    $("#show_gallery_sidebar").slideDown(50), $("#show_gallery_sidebar").toggleClass("show_sidebar")
});

// Review
$(".show_review_close").click(function (){
    $("#show_review_sidebar").slideDown(50), $("#show_review_sidebar").toggleClass("show_sidebar")
});

// appointment
$(".show_booking_close").click(function (){
    $("#show_booking_sidebar").slideDown(50), $("#show_booking_sidebar").toggleClass("show_sidebar")
});


function all_create(formID,url) {
    document.getElementById("create_btn").disabled = true;
    var formData = new FormData($('#'+formID)[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url:url+'/store',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preload").fadeIn(1000)
            $(".for-loader").fadeOut(1000)
        },
        success: function(result){
            document.getElementById("create_btn").disabled = true;
            window.location.reload();
        },
        error: function(err){
            document.getElementById("create_btn").disabled = false;
            $(".preload").fadeOut(1000)
            $(".for-loader").fadeIn(1000)
            console.log('err ',err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys( err.responseJSON.errors)) {
                $(".invalid-div ."+v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}

function all_edit(formID,url) { 
   
    id = $("#"+formID+" input[name='id']").val();
    var formData = new FormData($('#'+formID)[0]);
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': csrf
        },
        type:"POST",
        url:url+'/update/'+id,
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(result){
            window.location.reload();
        },
        error: function(err){
            console.log('err ',err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys( err.responseJSON.errors)) {
                $(".invalid-div ."+v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}
// 1234
function loyaltyModule(id){
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'module/edit/loyaltyModule/'+id,
        success: function(result){
            $(".invalid-div span").html('');

            $("#edit_loyaltyModule_sidebar input[name='id']").val(result.data.module.id);
            $("#edit_loyaltyModule_sidebar input[name='min_amount']").val(result.data.settings.min_amount);
            $("#edit_loyaltyModule_sidebar input[name='point']").val(result.data.settings.point);
            $("#edit_loyaltyModule_sidebar input[name='referral_point']").val(result.data.settings.referral_point);
            if(result.data.settings.is_point == 1)
                    $('#edit_loyaltyModule_sidebar input[name="is_point"]').prop('checked',true);
                else
                    $('#edit_loyaltyModule_sidebar input[name="is_point"]').prop('checked',false);

            $("#edit_loyaltyModule_sidebar").slideDown(50), $("#edit_loyaltyModule_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function(err){}
    });
}

function edit_cat(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'categories/edit/'+id,
        success: function(result){
            $(".invalid-div span").html('');
            $("#edit_cat_sidebar input[name='name']").val(result.data.name);
            $("#edit_cat_sidebar input[name='id']").val(result.data.cat_id);
            $('#edit_cat_form .cat_size').attr('src', base_url+'/storage/images/categories/'+result.data.image);
            $('#edit_cat_form .salon_size').attr('src', base_url+'/storage/images/categories/'+result.data.banner);

            $("#edit_cat_sidebar").slideDown(50), $("#edit_cat_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function(err){}
    });
}

function edit_banner(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'banner/edit/'+id,
        success: function(result){
            $(".invalid-div span").html('');

            $("#edit_banner_sidebar input[name='title']").val(result.data.title);
            $("#edit_banner_sidebar input[name='id']").val(result.data.id);
            $('#edit_banner_form .banner_size').attr('src', base_url+'/storage/images/banner/'+result.data.image);
        
            $("#edit_banner_sidebar").slideDown(50), $("#edit_banner_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function(err){}
    });
}

function edit_offer(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'offer/edit/'+id,
        success: function(result){
            $(".invalid-div span").html('');

            $("#edit_offer_sidebar input[name='title']").val(result.data.title);
            $("#edit_offer_sidebar input[name='discount']").val(result.data.discount);
            $("#edit_offer_sidebar input[name='id']").val(result.data.id);
            $('#edit_offer_form .offer_size').attr('src', base_url+'/storage/images/offer/'+result.data.image);
        
            $("#edit_offer_sidebar").slideDown(50), $("#edit_offer_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function(err){}
    });
}

function edit_coupon(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'coupon/edit/'+id,
        success: function(result){
            $(".invalid-div span").html('');
            console.log(result.data);
            $("#edit_coupon_sidebar input[name='title']").val(result.data.title);
            $("#edit_coupon_sidebar input[name='discount']").val(result.data.discount);
            $("#edit_coupon_sidebar input[name='max_use']").val(result.data.max_use);
            $("#edit_coupon_sidebar input[name='start_date']").val(result.data.start_date);
            $("#edit_coupon_sidebar input[name='end_date']").val(result.data.end_date);
            $("#edit_coupon_sidebar input[name='id']").val(result.data.coupon_id);
            $('#edit_coupon_form #'+result.data.type).prop('checked',true);
            $("#edit_coupon_sidebar textarea#description").html(result.data.desc);
            if (result.data.is_point_package == 1) {
                if(result.data.for_point == 1)
                    $('#edit_coupon_form input[name="for_point"]').prop('checked',true);
                else
                    $('#edit_coupon_form input[name="for_point"]').prop('checked',false);
                
                $("#edit_coupon_sidebar input[name='min_point']").val(result.data.min_point);
            }
            $("#edit_coupon_sidebar").slideDown(50), $("#edit_coupon_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function(err){}
    });
}

function edit_service(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'services/edit/'+id,
        success: function(result){
            $(".invalid-div span").html('');
            
            $("#edit_service_sidebar input[name='name']").val(result.data.service.name);
            $("#edit_service_sidebar input[name='price']").val(result.data.service.price);
            $("#edit_service_sidebar input[name='time']").val(result.data.service.time);
            $("#edit_service_sidebar input[name='id']").val(result.data.service.service_id);
            $("#edit_service_sidebar input[name='discount']").val(result.data.service.discount);
            
            $('#edit_service_form #'+result.data.service.gender).prop('checked',true);
            $('#edit_service_sidebar select[name="cat_id"] option').attr("selected",false);
            $('#edit_service_sidebar select[name="cat_id"] option[value='+result.data.service.cat_id+']').attr("selected",true);
            $('#edit_service_sidebar select[name="cat_id"] option[value='+result.data.service.cat_id+']').trigger('change');
            
            $('#edit_service_form .offer_size').attr('src', base_url+'/storage/images/services/'+result.data.service.image);
        
            $("#edit_service_sidebar").slideDown(50), $("#edit_service_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function(err){}
    });
}

function show_owner(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'salonowners/'+id,
        success: function(result){
            document.getElementById('owner_email').innerHTML = result.data.user.email;
            document.getElementById('owner_name').innerHTML = result.data.user.name;
            document.getElementById('salon_name').innerHTML = result.data.salon.name;
            document.getElementById('owner_phone').innerHTML = result.data.user.phone;
            $('#show_owner_sidebar .salon_size').attr('src', base_url+'/storage/images/salon logos/'+result.data.salon.image);
            $('#show_owner_sidebar .owner_img').attr('src', base_url+'/storage/images/users/'+result.data.user.image);
            $('#view_salon').attr('href', base_url+'/admin/salons/'+result.data.salon.salon_id);

            $("#show_owner_sidebar").slideDown(50), $("#show_owner_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function show_banner(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'banner/'+id,
        success: function(result){
            $('#show_banner_sidebar .salon_size').attr('src', base_url+'/storage/images/banner/'+result.data.banner.image);
            document.getElementById('banner_title').innerHTML = result.data.banner.title;

            $("#show_banner_sidebar").slideDown(50), $("#show_banner_sidebar").toggleClass("show_sidebar");
            $('#show_banner_sidebar .edit_banner_btn').attr('onClick', 'edit_banner('+result.data.banner.id+',"'+base_url+'")');
        },
        error: function(err){}
    });
}

function show_coupon(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'coupon/'+id,
        success: function(result){
            document.getElementById('coupon_code').innerHTML = result.data.coupon.code;
            document.getElementById('coupon_desc').innerHTML = result.data.coupon.desc;
            document.getElementById('coupon_max_use').innerHTML = result.data.coupon.max_use;
            document.getElementById('coupon_use_count').innerHTML = result.data.coupon.use_count;
            document.getElementById('coupon_type').innerHTML = result.data.coupon.type;
            document.getElementById('coupon_start_date').innerHTML = result.data.coupon.start_date;
            document.getElementById('coupon_end_date').innerHTML = result.data.coupon.end_date;
            if (result.data.coupon.type == "Percentage") {
                document.getElementById('coupon_discount').innerHTML = result.data.coupon.discount+'%';
            } else{
                document.getElementById('coupon_discount').innerHTML = result.data.symbol+result.data.coupon.discount;
            }
            $("#show_coupon_sidebar").slideDown(50), $("#show_coupon_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function show_offer(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'offer/'+id,
        success: function(result){
            $('#show_offer_sidebar .salon_size').attr('src', base_url+'/storage/images/offer/'+result.data.offer.image);
            document.getElementById('offer_title').innerHTML = result.data.offer.title;
            document.getElementById('offer_discount').innerHTML = result.data.offer.discount;

            $("#show_offer_sidebar").slideDown(50), $("#show_offer_sidebar").toggleClass("show_sidebar");
            $('#show_offer_sidebar .edit_offer_btn').attr('onClick', 'edit_offer('+result.data.offer.id+',"'+base_url+'")');
        },
        error: function(err){}
    });
}

function show_reported_review(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'review/'+id,
        success: function(result){
            $('#show_reported_review_sidebar .user_img').attr('src', base_url+'/storage/images/users/'+result.data.review.user.image);
            document.getElementById('user_name').innerHTML = result.data.review.user.name;
            document.getElementById('salon_name').innerHTML = result.data.review.salon.name;

            document.getElementById('msg').innerHTML = result.data.review.message;
            $('#show_reported_review_sidebar #rate').html('');

            for (i = 1; i <= 5; i++) {
                if (i<=result.data.review.rate) {
                    rate = 'activerate';
                } else {
                    rate ='';
                }
                $('#show_reported_review_sidebar #rate').append('<i class="fas fa-star '+rate+'"></i>');
            }
            $("#show_reported_review_sidebar").slideDown(50), $("#show_reported_review_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function approve_reported_review(url,id, base_url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                method: "GET",
                url: base_url+'/'+url+'/'+id,
                success: function (result) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    Swal.fire({
                        type: 'success',
                        title: 'Approved!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        }
    })      
}

function show_service(id,base_url) {
    $.ajax({
        headers: { 'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'services/'+id,
        success: function(result){
            $('#show_service_sidebar .salon_size').attr('src', base_url+'/storage/images/services/'+result.data.service.image);
            document.getElementById('service_name').innerHTML = result.data.service.name;
            document.getElementById('cat_name').innerHTML = result.data.service.category.name;
            document.getElementById('service_price').innerHTML = result.data.symbol +''+ result.data.service.price;
            document.getElementById('service_time').innerHTML = result.data.service.time+' Min';

            $("#show_service_sidebar").slideDown(50), $("#show_service_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function show_gallery(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'gallery/'+id,
        success: function(result){
            $('#show_gallery_sidebar .salon_size').attr('src', base_url+'/storage/images/gallery/'+result.data.gallery.image);
            $("#show_gallery_sidebar").slideDown(50), $("#show_gallery_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function show_review(id,base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:'review/'+id,
        success: function(result){
            $('#show_review_sidebar .user_img').attr('src', base_url+'/storage/images/users/'+result.data.review.user.image);
            document.getElementById('user_name').innerHTML = result.data.review.user.name;
            document.getElementById('salon_name').innerHTML = result.data.review.salon.name;

            document.getElementById('msg').innerHTML = result.data.review.message;
            $('#show_review_sidebar #rate').html('');
            for (i = 1; i <= 5; i++) {
                if (i<=result.data.review.rate) {
                    rate = 'activerate';
                }
                else {
                    rate ='';
                }
                $('#show_review_sidebar #rate').append('<i class="fas fa-star '+rate+'"></i>');
            }
            $("#show_review_sidebar").slideDown(50), $("#show_review_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function show_booking(id,base_url,page) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type:"GET",
        url:base_url+'/owner/'+page+'/'+id,
        success: function(result){
            document.getElementById('user_email').innerHTML = result.data.booking.user.email;
            document.getElementById('user_name').innerHTML = result.data.booking.user.name;
            document.getElementById('user_phone').innerHTML = result.data.booking.user.phone;
            $('#show_booking_sidebar .user_img').attr('src', base_url+'/storage/images/users/'+result.data.booking.user.image);

            document.getElementById('app_payment').innerHTML = result.data.symbol+''+result.data.booking.payment;
            document.getElementById('booking_id_main').innerHTML = result.data.booking.booking_id;
            document.getElementById('booking_at_show').innerHTML = result.data.booking.booking_at;
            document.getElementById('emp_name').innerHTML = result.data.booking.empDetails.name;
            document.getElementById('app_date').innerHTML = result.data.booking.date;
            document.getElementById('service_time').innerHTML = result.data.booking.start_time+' - '+result.data.booking.end_time;

            $('#show_booking_sidebar .view_invoice').attr('href', base_url+'/owner/booking/invoice/'+result.data.booking.id);

            var a = result.data.booking.services
            let arr = []
            var append = ""
            for (let i = 0; i < a.length; i++) {
                arr.push(result.data.booking.services[i].name)
                var temp = arr[i]
                append += temp+"<br>"
            }
            $('#services_all').html(append)
            $("#show_booking_sidebar").slideDown(50), $("#show_booking_sidebar").toggleClass("show_sidebar");
        },
        error: function(err){}
    });
}

function eventClicked(e) {
    $("#show_booking_sidebar").slideDown(50), $("#show_booking_sidebar").toggleClass("show_sidebar")
    $.ajax({
        url:'modal/getdata/'+ e.id,
        method: 'get',
        success: function(result) {
            document.getElementById('user_email').innerHTML = result.data.booking.user.email;
            document.getElementById('user_name').innerHTML = result.data.booking.user.name;
            document.getElementById('user_phone').innerHTML = result.data.booking.user.phone;
            
            document.getElementById('app_payment').innerHTML = result.data.symbol+''+result.data.booking.payment;
            document.getElementById('booking_id_main').innerHTML = result.data.booking.booking_id;
            document.getElementById('booking_at_show').innerHTML = result.data.booking.booking_at;
            document.getElementById('emp_name').innerHTML = result.data.booking.empDetails.name;
            document.getElementById('app_date').innerHTML = result.data.booking.date;
            document.getElementById('service_time').innerHTML = result.data.booking.start_time+' - '+result.data.booking.end_time;
            $('#show_booking_sidebar .view_invoice').attr('href', base_url+'/owner/booking/invoice/'+result.data.booking.id);
            
            $('.user_img').attr('src', base_url+'/storage/images/users/'+result.data.booking.user.image);
            var a = result.data.booking.services
            let arr = []
            var append = ""
            
            for (let i = 0; i < a.length; i++) {
                arr.push(result.data.booking.services[i].name)
                var temp = arr[i]
                append += temp+"<br>"
            }
            $('#services_all').html(append)
        },
        error: function(err) {}
    })
}

function deleteData(url,id, base_url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this record?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: "GET",
                url: base_url+'/'+url+'/delete/'+id,
                success: function (result) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    Swal.fire({
                        type: 'success',
                        title: 'Deleted!',
                        text: 'Record is deleted successfully.',
                        showConfirmButton: false,
                    })
                },
                error: function (err) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'This record is conntect with another data!'
                    })
                }
            });
        }
    })
}

// Admin user chart
$(document).ready(function() {
    if(curr_url == base_url+'/admin/dashboard')
    {
        initChart();
        $.ajax({
            url: 'adminusercharweekdata',
            method: 'get',
            success: function(data){
                updateChart(data);
            },
            error: function(err) {}
        })
    }
})

$('#adminYearUser').click(function() 
{
    $.ajax({
        url: 'adminuserchartdata',
        method: 'get',
        success: function(data){
            updateChart(data);
        },
        error: function(err) {}
    })
})

$('#adminMonthUser').click(function() 
{
    $.ajax({
        url: 'adminuserchartmonthdata',
        method: 'get',
        success: function(data){
            updateChart(data);
        },
        error: function(err) {}
    })
});

$('#adminWeekUser').click(function() 
{
    $.ajax({
        url: 'adminusercharweekdata',
        method: 'get',
        success: function(data){
            updateChart(data);
        },
        error: function(err) {}
    })
});

var userChart;
function initChart() {
    if(document.getElementById("users_chart"))
    {
        userChart = new Chart($('#users_chart'), {
            type: 'bar',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';
                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }
                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
        });
    }
};

function updateChart(data)
{
  userChart.data =  {
      labels: data[1],
      datasets: [{
          label: '',
          data: data[0]
      }]
  };
   userChart.update();
   userChart.render({
      duration: 800,
      lazy: false,
  });
}


// Admin Revenue chart
$(document).ready(function() {
    if(curr_url == base_url+'/admin/dashboard')
    {
        initChart1();
        $.ajax({
            url: 'adminrevenuecharweekdata',
            method: 'get',
            success: function(data){
                updateChart1(data);
            },
            error: function(err) {}
        })
    }
})

$('#adminYearRevenue').click(function() 
{
    $.ajax({
        url: 'adminrevenuechartdata',
        method: 'get',
        success: function(data){
            updateChart1(data);
        },
        error: function(err) {}
    })
})

$('#adminMonthRevenue').click(function() 
{
    $.ajax({
        url: 'adminrevenuechartmonthdata',
        method: 'get',
        success: function(data){
            updateChart1(data);
        },
        error: function(err) {}
    })
});

$('#adminWeekRevenue').click(function() 
{
    $.ajax({
        url: 'adminrevenuecharweekdata',
        method: 'get',
        success: function(data){
            updateChart1(data);
        },
        error: function(err) {}
    })
});

var revenueChart;
function initChart1() {
    if(document.getElementById("revenue_chart"))
    {
        revenueChart = new Chart($('#revenue_chart'), {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';
                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }
                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
        });
    }
};

function updateChart1(data) {
    // Variables
  revenueChart.data =  {
      labels: data[1],
      datasets: [{
          label: '',
          data: data[0]
      }]
  };
  revenueChart.update();
  revenueChart.render({
      duration: 800,
      lazy: false,
  });
}


// Admin Salon chart
$(document).ready(function() {
    if(curr_url == base_url+'/admin/dashboard')
    {
        $.ajax({
            url: 'adminsalondata',
            method: 'get',
            success: function(data){
                admin_salon_chart(data);
            },
            error: function(err) {}
        })
    }
})
function admin_salon_chart(data)
{ 
    var OrdersChart = (function() {
	var $chart = $('#chart-salon');
	// Init chart
	function initChart($chart) {
		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'bar',
			options: {
				scales: {
					yAxes: [{
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value
                                }
                            }
                        }
					}]
				},
				tooltips: {
					callbacks: {
						label: function(item, data) {
							var label = data.datasets[item.datasetIndex].label || '';
							var yLabel = item.yLabel;
							var content = '';
							if (data.datasets.length > 1) {
								content += '<span class="popover-body-label mr-auto">' + label + '</span>';
							}
							content += '<span class="popover-body-value">' + yLabel + '</span>';
							return content;
						}
					}
				}
			},
			data: {
				labels: data[1],
				datasets: [{
                    label: 'Salon',
                    borderWidth: 1,
					data: data[0]
				}]
			}
		});
		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}
	// Init chart
	if ($chart.length) {
		initChart($chart);
	}
    })();
}

// Admin Salon country chart
$(document).ready(function() {
    if(curr_url == base_url+'/admin/dashboard')
    {
        $.ajax({
            url: 'adminsaloncountrydata',
            method: 'get',
            success: function(data){
                admin_salon_country_chart(data);
            },
            error: function(err) {}
        })
    }
})
function admin_salon_country_chart(data)
{
    var OrdersChart = (function() {
	var $chart = $('#chart-salon-country');
	// Init chart
	function initChart($chart) {
		// Create chart
		var ordersChart = new Chart($chart, {
			type: 'pie',
			options: {
				scales: {
					yAxes: [{
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value
                                }
                            }
                        }
					}]
				},
				tooltips: {
					callbacks: {
						label: function(item, data) {
							var label = data.datasets[item.datasetIndex].label || '';
							var yLabel = item.yLabel;
							var content = '';
							if (data.datasets.length > 1) {
								content += '<span class="popover-body-label mr-auto">' + label + '</span>';
							}
							content += '<span class="popover-body-value">' + yLabel + '</span>';
							return content;
						}
					}
				}
			},
			data: {
				labels: data[1],
				datasets: [{
                    label: 'Salon',
                    borderWidth: 1,
                    data: data[0],
                    backgroundColor:data[2],
				}]
            },
            options: {
                responsive: !0,
                animation: {
                    animateScale: !0,
                    animateRotate: !0
                }
            }
		});
		// Save to jQuery object
		$chart.data('chart', ordersChart);
	}
	// Init chart
	if ($chart.length) {
		initChart($chart);
	}
    })();
}

// Owner Order chart
$(document).ready(function() {
    if(curr_url == base_url+'/owner/dashboard')
    {
        initChart2();
        $.ajax({
            url: 'ownerordercharweekdata',
            method: 'get',
            success: function(data){
            updateChart2(data);
            },
            error: function(err) {}
        })
    }
})

$('#ownerYearOrder').click(function() 
{
    $.ajax({
        url: 'ownerorderchartdata',
        method: 'get',
        success: function(data){
            updateChart2(data);
        },
        error: function(err) {}
    })
})

$('#ownerMonthOrder').click(function() 
{
    $.ajax({
        url: 'ownerorderchartmonthdata',
        method: 'get',
        success: function(data){
            updateChart2(data);
        },
        error: function(err) {}
    })
});

$('#ownerWeekOrder').click(function() 
{
    $.ajax({
        url: 'ownerordercharweekdata',
        method: 'get',
        success: function(data){
            updateChart2(data);
        },
        error: function(err) {}
    })
});

var ordersChart;
function initChart2() {
    if(document.getElementById("orders_chart"))
    {
        ordersChart = new Chart($('#orders_chart'), {
            type: 'bar',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';
                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }
                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
        });
    }
};

function updateChart2(data) {
    // Variables
    ordersChart.data =  {
      labels: data[1],
      datasets: [{
          label: '',
       
          data: data[0]
      }]
  };
  ordersChart.update();
  ordersChart.render({
    duration: 800,
    lazy: false,
  });
}

// Owner Revenue chart
$(document).ready(function() {
    if(curr_url == base_url+'/owner/dashboard')
    {
        initChart3();
        $.ajax({
            url: 'ownerrevenuecharweekdata',
            method: 'get',
            success: function(data){
                updateChart3(data);
            },
            error: function(err) {}
        })
    }
})

$('#ownerYearRevenue').click(function() 
{
    $.ajax({
        url: 'ownerrevenuechartdata',
        method: 'get',
        success: function(data){
            updateChart3(data);
        },
        error: function(err) {}
    })
})

$('#ownerMonthRevenue').click(function() 
{
    $.ajax({
        url: 'ownerrevenuechartmonthdata',
        method: 'get',
        success: function(data){
            updateChart3(data);
        },
        error: function(err) {}
    })
});

$('#ownerWeekRevenue').click(function() 
{
    $.ajax({
        url: 'ownerrevenuecharweekdata',
        method: 'get',
        success: function(data){
            updateChart3(data);
        },
        error: function(err) {}
    })
});

var revenueChartOwner;
function initChart3() {
    if(document.getElementById("revenue_owner_chart"))
    {
        revenueChartOwner = new Chart($('#revenue_owner_chart'), {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function(value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';
                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }
                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
        });
    }
};

function updateChart3(data) {
    // Variables
    revenueChartOwner.data =  {
      labels: data[1],
      datasets: [{
          label: '',
          data: data[0]
      }]
  };
  revenueChartOwner.update();
  revenueChartOwner.render({
      duration: 800,
      lazy: false,
  });
}
if (curr_url !=  base_url+'/owner/calendar') {
    $(function() {
        $(".preload").fadeOut(2000, function() {
            $(".for-loader").fadeIn(1000);
        });
    });
}