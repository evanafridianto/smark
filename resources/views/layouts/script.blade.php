<!-- BEGIN PLUGINS JS -->
<script src="{{ asset('admin/vendor/pace-progress/pace.min.js') }}"></script>
<script src="{{ asset('admin/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
<script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script> <!-- END PLUGINS JS -->
<!-- BEGIN THEME JS -->
<script src="{{ asset('admin/javascript/theme.js') }}"></script>
<script src="{{ asset('admin/vendor/loader/waitMe.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116692175-1');
    $("input, select").bind("keyup change", function() {
        $(this).next(".text-danger").empty();
    });



    // loader
    $(window).bind("beforeunload", function() {
        $('body').waitMe({
            effect: 'ios',
            text: 'Please wait...',
            bg: "rgba(255, 255, 255, 0.7)",
            color: "#9AA8A8",
        });
    });
</script>
