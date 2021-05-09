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
    if(!detectMobile() && $('#layoutSidenav_nav').length == 0)
    $("body").toggleClass("sb-sidenav-toggled");
})(jQuery);
$(document).on('show.bs.modal','#confirmation-modal', function (event){
    $(this).find('#name').text($(event.relatedTarget).data('name'))
    $('#confirmationDelForm').attr('action', $(event.relatedTarget).data('attr'));
    $(this).scrollTop(0);
})
function detectMobile()
{
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) return true;
    else return false;
}