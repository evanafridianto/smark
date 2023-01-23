<!-- BEGIN PLUGINS JS -->
<script src="{{ asset('admin/vendor/particles.js/particles.js') }}"></script>
<!-- BEGIN THEME JS -->
<script src="{{ asset('admin/javascript/theme.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-116692175-1"></script>
<script src="{{ asset('admin/vendor/loader/waitMe.js') }}"></script>

<script>
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

    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-116692175-1');
</script>
