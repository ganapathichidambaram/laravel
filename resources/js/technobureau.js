require('./bootstrap');
require('./bootstrap-select');

(function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
    if($('#layoutSidenav_nav').length == 0)
    {
        if(!detectMobile()) $("body").toggleClass("sb-sidenav-toggled");
        $("#sidebarToggle").remove();
    }
})(jQuery);
$(document).on('show.bs.modal','#confirmation-modal', function (event){
    $(this).find('#name').text($(event.relatedTarget).data('name'))
    $('#confirmationDelForm').attr('action', $(event.relatedTarget).data('attr'));
    $(this).scrollTop(0);
    
})

$(document).ready(function() {
    $('body').on('click', 'button', function(e) {
      if ($(this).hasClass('ajax-link')) {
          e.preventDefault();
          if ($(this).attr('href') == undefined) {
              $form = $(this).closest('form');;
              if (!$form.hasClass('form-signin')) {
                  var formData = $form.serialize();
                  $('.form-control').removeClass("is-invalid");
                  ajaxcall($form.attr('action'), $form.attr('method'), formData);
              }
          }
      }
});
$('body').on('click', 'a', function(e) {
    if ($(this).hasClass('ajax-link') && $(this).attr('href')) {
    if ( $(this).attr('href')) {
        e.preventDefault();
        /*  Sidebar on click ajax link Action START*/
        ajaxcall($(this).attr('href'));
    }
    }
});

    /*  Error START */
    $(document).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
        if (jqXHR.status == 500 || jqXHR.status == 404|| jqXHR.status == 405){
            $(".modal").modal('hide').on('hidden.bs.modal', function (event) {
                $('#content').html('<pre>'+jqXHR.responseText);
              });

        }
        else if (jqXHR.status == 422) {
            $(".btn").prop('disabled', false);
            var formData = {};
            var JsonArray = jsonCheck(jqXHR.responseText);
            $("#message").html(jqXHR.responseJSON.message);
            $("#message").addClass("alert-warning");
            $('#message').trigger('focus');
            $('.modal-body').scrollTop(0);
            let errors = jqXHR.responseJSON.errors;
            if(errors) Object.keys(errors).forEach(function (key) {
                $("#" + key).addClass("is-invalid");
                $("#" + key +"-error").html("<strong>"+errors[key][0]+"</strong>");
                if ($('#' + key).val().length >= 1) {
                            $('#' + key).removeClass('is-invalid');
                            }
            });
        } else if (jqXHR.status == 401) window.location.replace("/login");
        if (document.getElementById('datatable')) AjaxTable('#datatable');
        $(".btn").prop('disabled', false);

    });
    /****  Error  END **/

});
/*  Form Submit START*/
function ajaxcall(url, type, formData, history) {
    if (type == 'PUT')
        type = 'POST';
    else if (type == undefined)
        type = 'GET';
    if(url == undefined ) return;
    if (url && url.indexOf('#') == -1 && url.indexOf('javascript') == -1) {
        if (!history && url.slice(-5) !='refer') window.history.pushState({
            data: formData,
            path: url,
            type: type
        }, document.title, url);

        $.ajax({
            url: url,
            type: type,
            dataType: "json",
            data: formData,
            success: function(data) {
                AjaxLoad(data);
                return 1;
            },
            error: function(jqXHR, ajaxSettings, thrownError) {
                if (jqXHR.status == 500) $(".modal").modal('hide');

            }
        });
    } else if (url.indexOf('javascript') != -1)
        eval(url.substring(url.indexOf('javascript::') + 12));
}

function AjaxLoad(data) {

$('main').fadeOut(5, function() {
    $.each(data, function(key, value) {
        $('#' + key).html(value);
    });
    $("main").fadeIn(50);
});
}
 
/*  Form Submit START*/
function jsonCheck(JsonString) {
    try {
        var o = JSON.parse(JsonString);
        if (o && typeof o === "object" && o !== null) {
            return o;
        }
    } catch (e) {
        return false;
    }
}
  
$(window).bind('popstate',
    function(event) { /* if the event has our history data on it, load the page fragment with AJAX*/

        var state = event.originalEvent.state;
        if (state) {
            ajaxcall(state.path, state.type, state.data, 1);
        }
    });
function clear(name = null,tp = null)
{
    if(tp == null) {
        frm=document.getElementById(name);
        frm.reset();
        elem=frm.elements;
        var el = {};
        for(var i = 0; i < elem.length; i++){
            if(elem[i].name!="")el[elem[i].name]=elem[i].name //<-- Should return all input elements in that specific form.
        }
        $.each( el, function( value ) { clearRadioCheck(value);});
        $form = $(frm).closest('form');
        var formData = $form.serialize();
        ajaxcall($form.attr('action'), $form.attr('method'), formData);
    }
    if( tp == 'radio' || tp == 'checkbox') clearRadioCheck(name);
}
function clearRadioCheck(GroupName)
{
    var ele = document.getElementsByName(GroupName);
    for(var i=0;i<ele.length;i++)
    ele[i].checked = false;
}
  
function detectMobile()
{
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) return true;
    else return false;
}