<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>


    @if (App::getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/simplebar.css') }}">
        <!-- Fonts CSS -->
        <link
            href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/feather.css') }}">
        <!-- Date Range Picker CSS -->
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/app-light.css') }}" id="lightTheme">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('admin/rtl/css/app-dark.css') }}" id="darkTheme" disabled>
    @else
        <!-- Simple bar CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/simplebar.css') }}">
        <!-- Fonts CSS -->
        <link
            href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- Icons CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/feather.css') }}">
        <!-- Date Range Picker CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/daterangepicker.css') }}">
        <!-- App CSS -->
        <link rel="stylesheet" href="{{ asset('admin/css/app-light.css') }}" id="lightTheme">
        <link rel="stylesheet" href="{{ asset('admin/css/app-dark.css') }}" id="darkTheme" disabled>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endif

    @yield('css')
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        $(document).ready(function() {

            const translations = {
                ordered: "{{ __('notifiication.ordered') }}",
                review: "{{ __('notifiication.review') }}",
                contact: "{{__('notifiication.contact')}}",
            };

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('400e613895e0965e5d41', {
                cluster: 'eu'
            });


            var channel = pusher.subscribe('new_user_channel');
            channel.bind('App\\Events\\NewUserRegisteredEvent', function(data) {

                console.log(JSON.stringify(data));

                // let unreadCount = parseInt(document.querySelector('.dot').textContent);
                // document.querySelector('.dot').textContent = unreadCount + 1;




            });

            var channel = pusher.subscribe('review_channel');
            channel.bind('App\\Events\\NewCustomerReviewEvent', function(data) {
                console.log('review1');

                console.log(JSON.stringify(data));

                let unreadCount = parseInt(document.querySelector('.dot').textContent);
                document.querySelector('.dot').textContent = unreadCount + 1;

                const notification = data.review;

                var notificationHtml = `
                    <div class="list-group-item bg-light mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-box fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>
                                                        ${translations.review}</strong></small>
                                                <small class="badge badge-pill badge-light text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                            </div>
                                        </div>
                                    </div>
             `;

                // Check if the list exists
                if (notificationsList) {
                    // Append the new notification to the notification list
                    notificationsList.insertAdjacentHTML('afterbegin', notificationHtml);
                } else {
                    // If the list doesn't exist, create it and append to the container
                    const notificationContainer = document.querySelector(
                        '.list-group.list-group-flush.all-notifications');

                    if (notificationContainer) {
                        // Create a new notifications list wrapper
                        const newList = document.createElement('div');
                        newList.classList.add('list-group-item', 'notification-link');

                        // Add the notification HTML to the new list
                        newList.insertAdjacentHTML('afterbegin', notificationHtml);

                        // Append the new list to the container
                        notificationContainer.appendChild(newList);
                    } else {
                        console.error("Notification container not found in the DOM.");
                    }
                }


            });
            var channel = pusher.subscribe('order_channel');
            channel.bind('App\\Events\\NewOrderEvent', function(data) {

                console.log(JSON.stringify(data));

                let unreadCount = parseInt(document.querySelector('.dot').textContent);
                document.querySelector('.dot').textContent = unreadCount + 1;

                const notification = data.user;

                var notificationHtml = `
                <div class="list-group-item bg-light mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-box fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>${notification.name}
                                                        ${translations.ordered} </strong></small>
                                                <small class="badge badge-pill badge-light text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                            </div>
                                        </div>
                                    </div>
                                        `;

                // Select the notifications list
                var notificationsList = document.querySelector('.list-group-item.notification-link');

                // Check if the list exists
                if (notificationsList) {
                    // Append the new notification to the notification list
                    notificationsList.insertAdjacentHTML('afterbegin', notificationHtml);
                } else {
                    // If the list doesn't exist, create it and append to the container
                    const notificationContainer = document.querySelector(
                        '.list-group.list-group-flush.all-notifications');

                    if (notificationContainer) {
                        // Create a new notifications list wrapper
                        const newList = document.createElement('div');
                        newList.classList.add('list-group-item', 'notification-link');

                        // Add the notification HTML to the new list
                        newList.insertAdjacentHTML('afterbegin', notificationHtml);

                        // Append the new list to the container
                        notificationContainer.appendChild(newList);
                    } else {
                        console.error("Notification container not found in the DOM.");
                    }
                }




            });
            var channel = pusher.subscribe('contact_channel');
            channel.bind('App\\Events\\NewContactEvent', function(data) {
                console.log('recieved');


                console.log(JSON.stringify(data));

                let unreadCount = parseInt(document.querySelector('.dot').textContent);
                document.querySelector('.dot').textContent = unreadCount + 1;

                const notification = data;

                var notificationHtml = `
                <div class="list-group-item bg-light mb-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="fe fe-box fe-24"></span>
                                            </div>
                                            <div class="col">
                                                <small><strong>${data.name}
                                                        ${translations.contact} </strong></small>
                                                <small class="badge badge-pill badge-light text-muted">${new Date(notification.created_at).toLocaleString()}</small>
                                            </div>
                                        </div>
                                    </div>
                                        `;

                // Select the notifications list
                var notificationsList = document.querySelector('.list-group-item.notification-link');

                // Check if the list exists
                if (notificationsList) {
                    // Append the new notification to the notification list
                    notificationsList.insertAdjacentHTML('afterbegin', notificationHtml);
                } else {
                    // If the list doesn't exist, create it and append to the container
                    const notificationContainer = document.querySelector(
                        '.list-group.list-group-flush.all-notifications');

                    if (notificationContainer) {
                        // Create a new notifications list wrapper
                        const newList = document.createElement('div');
                        newList.classList.add('list-group-item', 'notification-link');

                        // Add the notification HTML to the new list
                        newList.insertAdjacentHTML('afterbegin', notificationHtml);

                        // Append the new list to the container
                        notificationContainer.appendChild(newList);
                    } else {
                        console.error("Notification container not found in the DOM.");
                    }
                }




            });

        });
    </script>


</head>

<body class="vertical  light {{ app()->getLocale() == 'ar' ? 'rtl' : '' }} ">
