{{--Jquery--}}
<script src="{{ asset('/frontend/assets/jquery/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/my-custom.js') }}"></script>

{{--Font Awesome--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
<script src="{{ asset('/frontend/assets/bootstrap/js/bootstrap.bundle.js') }}"></script>

{{--Toast--}}
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/673a31b92480f5b4f59f613c/1ictl4foq';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>
<!--End of Tawk.to Script-->

<script>
    // Toaster
    function showSuccessToast(message) {
        Toastify({
            text: message,
            duration: 3000,
            gravity: "top", // top or bottom
            position: 'right', // left, center, or right
            backgroundColor: "#FD9325", // success color
            color: "#FFFFFF",
            stopOnFocus: true, // Prevents dismissing of toast on hover
            close: true, // Add a close button
        }).showToast();
    }

    function showErrorToast(message) {
        Toastify({
            text: message,
            duration: 3000,
            gravity: "top", // top or bottom
            position: 'right', // left, center, or right
            backgroundColor: "#FE0000", // error color
            color: "#FFFFFF",
            stopOnFocus: true, // Prevents dismissing of toast on hover
            close: true, // Add a close button
        }).showToast();
    }

</script>


