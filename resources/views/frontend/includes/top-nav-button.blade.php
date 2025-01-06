@push('styles')
    <style>
        /* Back to Top Button Styling */
        #button {
            display: inline-block;
            background-color: var(--red);
            width: 60px;
            height: 60px;
            text-align: center;
            border-radius: 50%;
            position: fixed;
            bottom: 160px;
            right: 25px;
            transition: background-color 0.3s, opacity 0.5s, visibility 0.5s;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
            text-decoration: none;
        }
        #button::after {
            content: "\f077"; /* FontAwesome arrow-up */
            font-family: FontAwesome;
            font-weight: normal;
            font-style: normal;
            font-size: 1.5em;
            line-height: 60px;
            color: #fff;
            text-decoration: none;
        }
        #button:hover {
            cursor: pointer;
            background-color: #333;
            text-decoration: none;
        }
        #button:active {
            background-color: #555;
            text-decoration: none;
        }
        #button.show {
            opacity: 1;
            visibility: visible;
            text-decoration: none;
        }


        /*Whatsapp Button Styling */
        #whatsapp {
            display: inline-block;
            background-color: var(--red);
            width: 60px;
            height: 60px;
            text-align: center;
            border-radius: 50%;
            position: fixed;
            bottom: 90px;
            right: 25px;
            transition: background-color 0.3s, opacity 0.5s, visibility 0.5s;
            z-index: 1000;
        }
        #whatsapp img{
            margin-top: 14px;
        }
        #whatsapp:hover {
            cursor: pointer;
            background-color: #333;
        }
        #whatsapp:active {
            background-color: #555;
        }
    </style>
@endpush

<!-- Back to Top Button -->
<a id="button"></a>

<a id="whatsapp" href="https://api.whatsapp.com/send?phone=01607022072" target="_blank" >
    <img src="{{ asset('frontend/images/icons/whatsapp_white.svg') }}" />
</a>

@push('scripts')
    <script>
        $(document).ready(function () {
            var btn = $('#button');

            // Show button when scrolling down
            $(window).on('scroll', function () {
                if ($(window).scrollTop() > 300) {
                    btn.addClass('show');
                } else {
                    btn.removeClass('show');
                }
            });

            // Smooth scroll to top on button click
            btn.on('click', function (e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 300); // Adjusted duration to 300ms for smoother effect
            });
        });
    </script>
@endpush
