<!DOCTYPE html>
<html>

<!-- Mirrored from themewagon.github.io/famms/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 21:51:29 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<style type="text/css">
    .center {
        margin: auto;
        width: 100%;
        text-align: center;
        padding: 50px;
        margin-top: 50px;
    }

    table,
    th,
    td {
        border: 2px solid gray;
        margin: auto;
    }

    .th_dg {
        font-size: 30px;
        padding: 10px;
        background: orange;
    }

    .img_deg {
        height: 150px;
        width: 200px;
    }

    .total_deg {
        font-size: 20px;
        padding: 40px;
    }
</style>

<body>

    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        @if (session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
        @endif

        <div class="center">
            <table>
                <tr>
                    <th class="th_dg">Product title</th>
                    <th class="th_dg">Product quantity</th>
                    <th class="th_dg">Price ($)</th>
                    <th class="th_dg">Image</th>
                    <th class="th_dg">Action</th>
                </tr>
                <?php $totalprice = 0; ?>

                @foreach ($cart as $cart)
                    <tr>
                        <td>{{ $cart->product_title }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>${{ $cart->price }}</td>
                        <td><img class="img_deg" src="/product/{{ $cart->image }}" alt=""></td>
                        <td><a href="{{ url('remove_cart', $cart->id) }}" class="btn btn-danger"
                                onclick="confirmation(event)">Remove item</a></td>
                    </tr>
                    <?php $totalprice = $totalprice + $cart->price; ?>
                @endforeach


            </table>

            <div>
                <h1 class="total_deg">Total price : ${{ $totalprice }}</h1>
            </div>


            <div>
                <h1 style="font-size: 25px; padding-bottom: 15px">Proceed to Order</h1>

                <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
                <a href="{{ url('stripe', $totalprice) }}" class="btn btn-primary">Pay with Card</a>
            </div>
        </div>


        <!-- footer start -->


        <!-- footer end -->
        <div class="cpy_">
            <p class="mx-auto">© 2023 All Rights Reserved By Oscardom1<br>

            </p>
        </div>

        <script>
            function confirmation(ev){
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                console.log(urlToRedirect);
                swal({
                    title: "Are you sure to remove this product",
                    text: "You will not be able to revert this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if(willCancel){
                        window.location.href = urlToRedirect;
                    }
                });
            }

        </script>
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
