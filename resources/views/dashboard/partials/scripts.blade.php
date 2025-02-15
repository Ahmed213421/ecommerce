<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/js/popper.min.js')}}"></script>
<script src="{{asset('admin/js/moment.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset('admin/js/simplebar.min.js')}}"></script>
<script src='{{asset('admin/js/daterangepicker.js')}}'></script>
<script src='{{asset('admin/js/jquery.stickOnScroll.js')}}'></script>
<script src="{{asset('admin/js/tinycolor-min.js')}}"></script>
<script src="{{asset('admin/js/config.js')}}"></script>
<script src="{{asset('admin/js/apps.js')}}"></script>
<script src="{{asset('admin/js/config.js')}}"></script>
<script src='{{asset('admin/js/jquery.dataTables.min.js')}}'></script>
<script src='{{asset('admin/js/dataTables.bootstrap4.min.js')}}'></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
<script>
    $(document).ready(function () {
        $('.notification-link').click(function (e) {
            e.preventDefault();

            var notificationId = $(this).data('id'); // Get notification ID
            var notificationItem = $(this);


            $.ajax({
                url: '{{ route("admin.notifications.markAllRead") }}', // Correct route
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'), // CSRF token
                    id: notificationId
                },
                success: function (response) {
                    if (response.success) {
                        notificationItem.find('.list-group-item').removeClass('bg-light').addClass('bg-transparent');
                        window.location.href = notificationItem.attr('href');
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseJSON?.message || "Unknown error");
                    alert('Error: ' + (xhr.responseJSON?.message || "Something went wrong"));
                }
            });
        });
    });

    $('#clearAll').click(function() {
            $.ajax({
                url: '{{ route('admin.notifications.clear') }}',
                type: 'GET',
                data: {
                    _token:  $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.success) {
                        
                        $('.dot').text(0);
                        var notificationsList = document.querySelector('.list-group');
                        notificationsList.innerHTML = ''; // Clear the UI
                    }
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong, please try again!');
                }
            });
        });
</script>



@yield('js')
</body>

</html>
