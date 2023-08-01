<!DOCTYPE html>
<html>

<!-- Mirrored from themewagon.github.io/famms/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 21:51:29 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <!-- Basic -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">


    <style type="text/css">
        .center_div {
            margin: auto;
            width: 70%;
            padding: 30px;
            text-align: center;
            margin-top: 70px
        }

        table,
        th,
        td {

            border: 2px solid black;
        }

        .th_deg {
            padding: 15px;
            background-color: orange;
            font-size: 20px;
            font-weight: bold;

        }
    </style>
</head>

<body>
    <!-- header section strats -->
    @include('home.header')

    @if (session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif

        <div class="center_div">
            <table>
                <tr>
                    <th class="th_deg">Product Title</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Payment Status</th>
                    <th class="th_deg">Delivery Status</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Cancel Order</th>
                </tr>
                @foreach ($order as $order)
                    <tr>
                        <td>{{ $order->product_title }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>${{ $order->price }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>

                            <img height="100" width="180" src="product/{{ $order->image }}" alt="">

                        </td>

                        <td>

                            @if ($order->delivery_status == 'processing')
                                <a onclick="return confirm('Ae you sure to cancel this order?')" class="btn btn-danger"
                                    href="{{ url('cancel_order', $order->id) }}">Cancel</a>
                            @else
                                <p class="btn btn-secondary">Cancel</p>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>
        <!-- end header section -->
        <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
</body>

<!-- Mirrored from themewagon.github.io/famms/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 21:51:46 GMT -->

</html>
