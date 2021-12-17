function showNotif(status, message) {
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    toastr[status](message);
  };
$('.features').owlCarousel({
    loop: false,
    margin: 10,
    nav: false,
    dots: true,
    responsive: {
        0: {
            items: 1
        }
    }
});
