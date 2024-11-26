{{--Jquery--}}
<script src="{{ asset('/frontend/assets/jquery/jquery-3.7.1.js') }}"></script>
<script src="{{ asset('/frontend/assets/js/my-custom.js') }}"></script>
{{--Font Awesome--}}
<script src="https://kit.fontawesome.com/02fcb6127e.js" crossorigin="anonymous"></script>
<script src="{{ asset('/frontend/assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
{{--Jquery Slider--}}
<script src="{{ asset('/frontend/assets/jquery/Carousel/slick/slick.js') }}"></script>
<script src="{{ asset('/frontend/assets/jquery/Carousel/slick/slick.min.js') }}"></script>

{{--Toast--}}
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

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
