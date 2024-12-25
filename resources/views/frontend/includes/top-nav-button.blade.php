@push('styles')
    <style>
        /* Back to Top Button Styling */
        #button {
            display: inline-block;
            background-color: #FF9800;
            width: 50px;
            height: 50px;
            text-align: center;
            border-radius: 50%;
            position: fixed;
            bottom: 30px;
            right: 30px;
            transition: background-color 0.3s, opacity 0.5s, visibility 0.5s;
            opacity: 0;
            visibility: hidden;
            z-index: 1000;
        }
        #button::after {
            content: "\f077"; /* FontAwesome arrow-up */
            font-family: FontAwesome;
            font-weight: normal;
            font-style: normal;
            font-size: 1.5em;
            line-height: 50px;
            color: #fff;
        }
        #button:hover {
            cursor: pointer;
            background-color: #333;
        }
        #button:active {
            background-color: #555;
        }
        #button.show {
            opacity: 1;
            visibility: visible;
        }
    </style>
@endpush

<!-- Back to Top Button -->
<a id="button"></a>

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
