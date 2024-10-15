    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
        <title>:: CCI BROKER PANNEL</title>
        <link rel="icon" href="{{ asset('fav.jpg') }}" type="image/x-icon"> <!-- Favicon-->
        <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/plugin.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/morrisjs/morris.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="...">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zurb-material-icons@3.7.5/zurb-material-icons.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <link rel="stylesheet" href="{{ asset('assets/css/broker.css') }}">
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">

    </head>

    <style>
        .notification {
            width: 360px;
            padding: 15px;
            background-color: white;
            border-radius: 16px;
            position: fixed;
            bottom: 15px;
            left: 75%;
            transform: translateY(200%);
            animation: noti 2s infinite forwards alternate ease-in;

            &-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 15px;
            }

            &-title {
                font-size: 16px;
                font-weight: 500;
                text-transform: capitalize;
            }

            &-close {
                cursor: pointer;
                width: 30px;
                height: 30px;
                border-radius: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #F0F2F5;
                font-size: 14px;
            }

            &-container {
                display: flex;
                align-items: flex-start;
            }

            &-media {
                position: relative;
            }

            &-user-avatar {
                width: 60px;
                height: 60px;
                border-radius: 60px;
                object-fit: cover;
            }

            &-reaction {
                width: 30px;
                height: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 30px;
                color: white;
                background-image: linear-gradient(45deg, #0070E1, #14ABFE);
                font-size: 14px;
                position: absolute;
                bottom: 0;
                right: 0;
            }

            &-content {
                width: calc(100% - 60px);
                padding-left: 20px;
                line-height: 1.2;
            }

            &-text {
                margin-bottom: 5px;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
                padding-right: 50px;

            }

            &-timer {
                color: #1876F2;
                font-weight: 600;
                font-size: 14px;
            }

            &-status {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                width: 15px;
                height: 15px;
                background-color: #1876F2;
                border-radius: 50%;
            }
        }

        @keyframes noti {
            50% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(0);
            }
        }

        .alert {
            transition: opacity 0.5s ease-out;/ Smooth transition for opacity / opacity: 1;/ Ensure the element is fully visible initially /
        }

        .alert.fade-out {
            opacity: 0;/ Set the element to be fully transparent /
        }
        section.content {
        font-family: poppins;
        margin: 20px 0 20px 214px;
        margin-top: 40px;
    }
    
    </style>

    <body class="theme-blush" style="font-family: Poppins; !important">

        <!-- Page Loader -->
        <!-- <div class="page-loader-wrapper">
            <div class="loader">
                <div class="m-t-30"><img class="zmdi-hc-spin" src="https://dndlist.in/assets/img/cargo.png" width="48"
                        height="48" alt="Aero"></div>
                <p>Cargo Convoy INC CRM...</p>
            </div>
        </div> -->

        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>

        <!-- Main Search -->
        <div id="search">
            <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
            <form>
                <input type="search" value="" placeholder="Search..." />
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <button class="btn-menu ls-toggle-btn" id="menu-btn" onclick="toggleMenu()" type="button"><i
                    class="zmdi zmdi-menu"></i></button>
            <div class="user-info">
                <a href="{{ route('home') }}" class="text-center"><img src="{{ asset('images/only logo.png') }}" width="35%"
                        alt="Aero" /></a>
                <div class="detail text-center m-0">
                    <h4><a class="text-white" href="{{ route('profile') }}">{{ strtoupper($user->name) }}</a></h4>
                    <small>@if (Auth::guard('web')->check()) Broker @else Team Lead @endif</small>
                </div>
            </div>
            <div class="menu">
                <ul class="list" style="padding: 0 11px;    margin: 54px 0;">
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 0 ? 'active' : '' }}">
                        <a href="{{ url('/load') }}"><img src="{{ asset('assets/images/sidebar-icons/home-side.png') }}"
                                width="25"><span>Home</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 1 ? 'active' : '' }}">
                        <a href="{{ url('/profile') }}"><img src="{{asset('assets/images/sidebar-icons/profile-user.png')}}"
                                width="25"> <span>Profile</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 2 ? 'active' : '' }}">
                        <a href="{{ url('/customer') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/customer-service.png') }}"
                                width="25"><span>Customer</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 3 ? 'active' : '' }}">
                        <a href="{{ url('/carrier') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/frontal-truck.png') }}"
                                width="25"><span>Carrier</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 4 ? 'active' : '' }}">
                        <a href="{{ url('/shipper') }}"><img src="{{ asset('assets/images/sidebar-icons/loading.png') }}"
                                width="25"><span>Shipper</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 5 ? 'active' : '' }}">
                        <a href="{{ url('/consignee') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/package-box.png') }}"
                                width="25"><span>Consignee</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 6 ? 'active' : '' }}">
                        <a href="{{ url('/load') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/loaded-truck-side-view.png') }}"
                                width="25"><span>Load Creation</span></a>
                    </li>

                    @if (!Auth::guard('web')->check())
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 6 ? 'active' : '' }}">
                        <a href="{{ url('/agentportal') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/loaded-truck-side-view.png') }}"
                                width="25"><span>Agent Portal</span></a>
                    </li>
                    @endif

                    <!-- <li class="menu {{ isset($activeIndex) && $activeIndex == 7 ? 'active' : '' }}">
                        <a href="{{ url('/mc') }}">
                            <img src="{{ asset('assets/images/sidebar-icons/loaded-truck-side-view.png') }}" width="25">
                            <span>MC Check</span>
                        </a>
                    </li>

                    <li class="menu {{ isset($activeIndex) && $activeIndex == 8 ? 'active' : '' }}">
                        <a href="{{ url('/cpr') }}">
                            <img src="{{ asset('assets/images/sidebar-icons/loaded-truck-side-view.png') }}" width="25">
                            <span>CPR Check</span>
                        </a>
                    </li> -->

                    <!-- <li class="menu {{ isset($activeIndex) && $activeIndex == 7 ? 'active' : '' }}">
                        <a href="{{ url('/bol') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/loaded-truck-side-view.png') }}"
                                width="25"><span>BOL</span></a>
                    </li> -->
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 9 ? 'active' : '' }}">
                        <a href="{{ route('dashboardhome') }}"><img
                                src="{{ asset('assets/images/sidebar-icons/dashboard-control.png') }}"
                                width="25"><span>Dashboard</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 10 ? 'active' : '' }}">
                        <a href="https://dndlist.in" target="_blank"><img
                                src="{{ asset('assets/images/sidebar-icons/support-services.png') }}"
                                width="25"><span>DND</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 11 ? 'active' : '' }}">
                        <a href="#"><img src="{{ asset('assets/images/sidebar-icons/notification.png') }}"
                                width="25"><span>Notification</span></a>
                    </li>
                    <li class="menu {{ isset($activeIndex) && $activeIndex == 12 ? 'active' : '' }}">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="mega-menu" target="_blank"><img
                                src="{{ asset('assets/images/sidebar-icons/logout.png') }}"
                                width="25"><span>Logout</span></a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </aside>
        <div class="profile-notification">
            <ul class="d-flex">
                <li><a href="https://crmcargoconvoy.co/profile"><i class="fa fa-user"></i></a></li>
                <li>
                    <div class="btn-group show-on-hover">
                        <button type="button" class="btn dropdown-toggle p-0 m-0" data-toggle="dropdown"><i
                                class="fa fa-bell"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <div class="drop-title text-white text-center"><b>Notifications</b></div>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="notification-contnet">
                                        <h5>This is LTC coin</h5>
                                        <p class="mail-desc">Just a reminder that you have event</p>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>



        <!-- Main Content -->
        @yield('content')
        @php
        $invoice_status = App\Models\Load::get();
        @endphp
        <!-- 
        <div class="notification" id="notification">
            <div class="notification-header">
                <h3 class="notification-title">New notification</h3>
                <i class="fa fa-times notification-close"></i>
            </div>
            <div class="notification-container">
                <div class="notification-content">
                    <p class="notification-text">
                        <strong>evondev</strong>, <strong>Trần Anh Tuấn</strong> and 154 others react to your post in
                        <strong>Cộng đồng Frontend Việt Nam</strong>
                    </p>
                    <span class="notification-timer">a few seconds ago</span>
                </div>
                <span class="notification-status"></span>
            </div>
        </div> -->


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.10.1/dist/chart.min.js"></script>
        <script src="{{ asset('assets/bundles/jvectormap.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/sparkline.bundle.js') }}"></script>
        <script src="{{ asset('ssets/bundles/c3.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/pages/index.js') }}"></script>
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/vendorscripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/bundles/datatablescripts.bundle.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-datatable/buttons/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/js/pages/tables/jquery-datatable.js') }}"></script>
        <script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
        <script src="{{ asset('assets/js/pages/blog/blog.js') }}"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


        <!-- this script for Approval button chnage event when admin approve the case and its show another button using customer id  -->

        <!-- <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                adjustPageSize();
            });

            function adjustPageSize() {
                document.body.style.zoom = "85%";
            }
        </script> -->
        <script>
            $(document).ready(function () {
                $('#map').vectorMap({
                    map: 'us_aea_en',
                    backgroundColor: '#ffffff',
                    regionsSelectable: true,
                    regionStyle: {
                        selected: {
                            fill: '#73879C'
                        }
                    }
                });
            });
        </script>
        <script>
            function clearForm() {
                var form = document.getElementById("myForm");
                var elements = form.elements;

                for (var i = 0; i < elements.length; i++) {
                    var elementType = elements[i].type.toLowerCase();
                    switch (elementType) {
                        case "text":
                        case "select-one":
                            elements[i].value = "";
                            break;
                        case "checkbox":
                            elements[i].checked = false;
                            break;
                        default:
                            break;
                    }
                }
            }
        </script>
        <script>
            // Use JavaScript to hide options with class 'hiddenOption'
            var hiddenOptions = document.getElementsByClassName('hiddenOption');
            for (var i = 0; i < hiddenOptions.length; i++) {
                hiddenOptions[i].style.display = 'none';
            }
        </script>
        <script>
            function showInput() {
                var customeInput = document.getElementById('custome_input');
                var customeOption = document.getElementById('custome');

                // Check if the "Custom" option is selected
                if (customeOption.selected) {
                    customeInput.style.display = 'block';
                } else {
                    customeInput.style.display = 'none';
                }
            }
        </script>
        <script>
            $('#country').change(function () {
                var selectedValue = $("#country option:selected").text();
                if (selectedValue) {
                    $('#customer_billing_country').val(selectedValue);
                }
            });

            $('#state').change(function () {
                var selectedValue = $("#state option:selected").text();
                if (selectedValue) {
                    $('#customer_billing_state').val(selectedValue);

                }
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#state').prop('disabled', true).html(
                    '<option value="" disabled selected>Choose States</option>');

                $('#country').change(function () {
                    var countryId = $(this).val();
                    if (countryId) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('get.states.by.country') }}",
                            data: {
                                'country_id': countryId
                            },
                            success: function (data) {
                                data.sort(function (a, b) {
                                    return a.name.localeCompare(b.name);
                                });

                                $('#state').prop('disabled', false);

                                $('#state').empty();
                                $('#state').append(
                                    '<option value="" disabled>Select State</option>');
                                $.each(data, function (key, value) {
                                    $('#state').append('<option value="' + value.name +
                                        '">' + value.name + '</option>');
                                });
                            }
                        });
                    } else {
                        // Disable and show "Select State" if no country is selected
                        $('#state').prop('disabled', true).html(
                            '<option value="" disabled selected>Select State</option>');
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Your Laravel Blade variables
                var labels = {
                    !!json_encode($labels) !!
                };
                var datasets = {
                    !!json_encode($datasets) !!
                };

                // Get the canvas element and context
                var ctx = document.getElementById('user_chart').getContext('2d');

                // Create the Chart instance
                var userChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets,
                    },
                });
            });
        </script>

        <script>
            function clearForm() {
                var form = document.getElementById("myForm");
                var elements = form.elements;

                for (var i = 0; i < elements.length; i++) {
                    var elementType = elements[i].type.toLowerCase();
                    switch (elementType) {
                        case "text":
                        case "select-one":
                            elements[i].value = "";
                            break;
                        case "checkbox":
                            elements[i].checked = false;
                            break;
                        default:
                            break;
                    }
                }
            }
        </script>
        <script>
            // Use JavaScript to hide options with class 'hiddenOption'
            var hiddenOptions = document.getElementsByClassName('hiddenOption');
            for (var i = 0; i < hiddenOptions.length; i++) {
                hiddenOptions[i].style.display = 'none';
            }
        </script>
        <script>
            function showInput() {
                var customeInput = document.getElementById('custome_input');
                var customeOption = document.getElementById('custome');

                // Check if the "Custom" option is selected
                if (customeOption.selected) {
                    customeInput.style.display = 'block';
                } else {
                    customeInput.style.display = 'none';
                }
            }
        </script>

        <script>
            $(document).ready(function () {
                $('#same_as_physical').on('change', function () {
                    if ($(this).is(':checked')) {
                        copyFieldValue('#customer_address', '#customer_billing_address');
                        copyFieldValue('#customer_city', '#customer_billing_city');
                        copyFieldValue('#customer_zip', '#customer_billing_zip');
                        var selectedCntry = $("#country option:selected").text();
                        $('#customer_billing_country').val(selectedCntry);

                        var selectedState = $("#state option:selected").text();
                        $('#customer_billing_state').val(selectedState);


                        // Disable corresponding billing fields
                        $('[id^="customer_billing_"]').prop('disabled', true);
                    } else {
                        // Clear and enable corresponding billing fields
                        $('[id^="customer_billing_"]').val('').prop('disabled', false);
                    }
                });

                // Function to copy field value
                function copyFieldValue(sourceId, targetId) {
                    var sourceValue = $(sourceId).val();
                    // var sourceValue = $(sourceId).data('name');
                    $(targetId).val(sourceValue);
                }
            });
        </script>
        <script>
            function clearForm() {
                alert(elements);
                var form = document.getElementById("myForm");
                var elements = form.elements;
                for (var i = 0; i < elements.length; i++) {
                    var elementType = elements[i].type.toLowerCase();
                    switch (elementType) {
                        case "text":
                        case "select-one":
                            elements[i].value = "";
                            break;
                        case "checkbox":
                            elements[i].checked = false;
                            break;
                        default:
                            break;
                    }
                }
            }
        </script>
        <script>
            $(document).ready(function () {
                $('#openModalIcon').click(function () {
                    $('#otherChargesModal').modal('show');
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#shipper_other_charge').click(function () {
                    $('#shiperotherChargesModal').modal('show');
                });
            });
        </script>


        <!-- actial code  -->
        <script>
            $(document).ready(function () {
                function updateTotal() {
                    var total = 0;

                    $('[name="shipperchargeAmount[]"]').each(function (index, inputBox) {
                        var amount = parseFloat($(inputBox).val()) || 0;
                        total += amount;
                    });

                    var loadShipperRate = parseFloat($('#load_shipper_rate').val()) || 0;
                    total += loadShipperRate;

                    var loadFscRate = parseFloat($('#load_fsc_rate').val()) || 0;
                    total += (loadFscRate / 100) * loadShipperRate;

                    $('#shipper_load_final_rate').val(total.toFixed(2));
                }

                $(document).on('input', '[name="shipperchargeAmount[]"], #load_shipper_rate, #load_fsc_rate',
                    function () {
                        updateTotal();
                    });

                // $(document).on('click', '#addChargeBtn', function () {
                //     var newChargeRow = $('#chargeRowTemplate').clone().removeAttr('id').show();
                //     newChargeRow.find('[name="shipperchargeType[]"]').val('');
                //     newChargeRow.find('[name="shipperchargeAmount[]"]').val('');
                //     newChargeRow.appendTo('.container');

                //     updateTotal();
                // });

                // $(document).on('click', '.remove-charge', function () {
                //     $(this).closest('.row').remove();

                //     updateTotal();
                // });
            });
        </script>






        <script>
            $(document).ready(function () {

                // Function to remove input row
                $(document).on('click', '.closebtn', function () {
                    var removedAmount = parseFloat($(this).siblings('input[name="shipper_other_charge[]"]')
                        .val()) || 0;
                    var total = parseFloat($('#load_final_carrier_fee').val()) || 0;
                    total -= removedAmount;
                    $('#load_final_carrier_fee').val(total.toFixed(2));

                    $(this).parent().remove();
                    updateTotal();
                });

                // Function to calculate and update the total amount
                function updateTotal() {
                    var total = 0;

                    // Iterate through each charge input box
                    $('[name="inputBox2[]"], [name="shipper_other_charge[]"]').each(function (index, inputBox) {
                        var amount = parseFloat($(inputBox).val()) || 0;
                        total += amount;
                    });

                    // Add load_carrier_fee to the total
                    var loadCarrierFee = parseFloat($('#load_carrier_fee').val()) || 0;
                    total += loadCarrierFee;

                    // Get the billing FSC rate
                    var billingFSCRate = parseFloat($('#load_billing_fsc_rate').val()) || 0;

                    // Calculate the percentage of load_carrier_fee based on billing FSC rate
                    var fscAmount = (loadCarrierFee * billingFSCRate) / 100;

                    // Add the calculated FSC amount to the total
                    total += fscAmount;

                    // Set the sum in load_final_carrier_fee
                    $('#load_final_carrier_fee').val(total.toFixed(2));
                }

                // Handle input changes to update the total
                $(document).on('input',
                    '[name="inputBox2[]"], [name="shipper_other_charge[]"], #load_carrier_fee, #load_billing_fsc_rate',
                    function () {
                        updateTotal();
                    });
            });
        </script>


        <!-- <script>
        function cloneLoad(event) {
            event.preventDefault();
            var form = document.getElementById('myFormLoad');
            if (!form) {
                console.error('Form with id "myFormLoad" not found.');
                return;
            }
            var clonedForm = form.cloneNode(true);
            
            // Include CSRF token in the cloned form
            var tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = '{{ csrf_token() }}';
            clonedForm.appendChild(tokenInput);
            
            document.body.appendChild(clonedForm);
            clonedForm.submit();
        }
    </script> -->
        <script>
            function cloneLoad(event) {
                event.preventDefault();
                var form = document.getElementById('myFormLoad');
                if (!form) {
                    console.error('Form with id "myFormLoad" not found.');
                    return;
                }
                var clonedForm = form.cloneNode(true);
                var originalFormInputs = form.querySelectorAll('input, select, textarea');
                var clonedFormInputs = clonedForm.querySelectorAll('input, select, textarea');

                originalFormInputs.forEach(function (input, index) {
                    if (clonedFormInputs[index]) {
                        clonedFormInputs[index].value = input.value;
                    }
                });

                document.body.appendChild(clonedForm);
                clonedForm.submit();
            }
        </script>


        <!-- <script>
        $(document).ready(function () {
            if (!$.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable({
                    pageLength: 100,
                    // Enable date range filtering
                    columnDefs: [{
                        targets: [0, 1, 2], // Apply to columns where date filtering is needed
                        type: 'datetime',
                        render: function (data, type, row, meta) {
                            if (type === 'filter') {
                                return data.split(' ')[0]; // Display date only in filter input
                            }
                            return data; // Display full date in table
                        }
                    }]
                });
            }
        });
    </script> -->


        <!-- <script>
        $(document).ready(function () {
            var dataTable = $('#dataTable').DataTable({
                pageLength: 100,
                columnDefs: [{
                    targets: [0, 1, 2], 
                    type: 'datetime',
                    render: function (data, type, row, meta) {
                        if (type === 'filter') {
                            return data.split(' ')[0]; 
                        }
                        return data;
                    }
                }]
            });
        });
    </script> -->

        <script>
            $(document).ready(function () {
                var dataTable = $('#dataTable').DataTable({
                    pageLength: 100,
                    columnDefs: [{
                        targets: [0, 1, 2],
                        type: 'datetime',
                        render: function (data, type, row, meta) {
                            if (type === 'filter') {
                                return data.split(' ')[0];
                            }
                            return data;
                        }
                    }]
                });

                function applyDateRangeFilter() {
                    var start = $('#start').val();
                    var end = $('#end').val();

                    // Format the dates as YYYY-MM-DD for DataTables search
                    var formattedStart = start ? moment(start).format('YYYY-MM-DD') : '';
                    var formattedEnd = end ? moment(end).format('YYYY-MM-DD') : '';

                    // Apply date range filtering
                    dataTable.columns(0).search(formattedStart, true, false).draw();
                    dataTable.columns(1).search(formattedEnd, true, false).draw();
                }

                // Event listener for date inputs
                $('#start, #end').on('change', function () {
                    applyDateRangeFilter();
                });
            });
        </script>



        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggleButton = document.getElementById('#menu_toggel');
                const sidebar = document.querySelector('.sidebar');

                toggleButton.addEventListener('click', function () {
                    sidebar.classList.toggle('active');
                });
            });
        </script>




        <script>
            var tables = document.querySelectorAll('table');
            tables.forEach(function (table) {
                table.classList.add('table-responsive');
            });
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const menuItems = document.querySelectorAll('.list .menu');

                menuItems.forEach((menuItem, index) => {
                    menuItem.addEventListener('click', function () {
                        menuItems.forEach(item => {
                            item.classList.remove('active');
                        });
                        this.classList.add('active');
                        localStorage.setItem('activeIndex', index);
                    });
                });
                const activeIndex = localStorage.getItem('activeIndex');
                if (activeIndex !== null) {
                    menuItems[activeIndex].classList.add('active');
                }
            });
        </script>

        <script>
            function toggleBlur() {
                var dynamicCells = document.querySelectorAll('.dynamic-data');
                dynamicCells.forEach(function (cell) {
                    var blurValue = cell.style.filter === 'blur(5px)' ? 'none' : 'blur(5px)';
                    cell.style.filter = blurValue;
                });
            }

            document.getElementById('hideFormButton').addEventListener('click', function () {
                toggleBlur();
            });
        </script>

        <!-- <script>
            $(document).ready(function () {
                $('#customer_mc_ff').change(function () {
                    var selectedValue = $(this).val();
                    if (selectedValue === 'NA') {
                        $('#customer_mc_ff_input').hide();
                        $('#mc_ff_code').hide();
                    } else {
                        $('#customer_mc_ff_input').show();
                        $('#mc_ff_code').show();
                    }
                });
            });
        </script> -->

        <script>
            $(document).ready(function () {
                // Initial check
                if ($('#customer_mc_ff').val() === 'NA') {
                    $('#customer_mc_ff_input').hide();
                    $('#mc_ff_code').hide();
                } else {
                    $('#customer_mc_ff_input').show();
                    $('#mc_ff_code').show();
                }

                // Handle change event
                $('#customer_mc_ff').change(function () {
                    var selectedValue = $(this).val();
                    if (selectedValue === 'NA') {
                        $('#customer_mc_ff_input').hide();
                        $('#mc_ff_code').hide();
                    } else {
                        $('#customer_mc_ff_input').show();
                        $('#mc_ff_code').show();
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function () {
                $('#carrier_mc_ff_input , #carrier_zip', 'carrier_telephone').on('input', function (event) {
                    var inputValue = $(this).val();
                    $(this).val(inputValue.replace(/[^\d]/g, ''));
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                setTimeout(function () {
                    // Fade out success message
                    var successMessage = document.getElementById('successMessage');
                    if (successMessage) {
                        successMessage.classList.add('fade-out');
                        setTimeout(function () {
                            successMessage.style.display = 'none';
                        }, 500); // Match the transition duration
                    }

                    // Fade out error message
                    var errorMessage = document.getElementById('errorMessage');
                    if (errorMessage) {
                        errorMessage.classList.add('fade-out');
                        setTimeout(function () {
                            errorMessage.style.display = 'none';
                        }, 500); // Match the transition duration
                    }
                }, 2000); // 2000 milliseconds = 2 seconds
            });
        </script>
    </body>

    </html>