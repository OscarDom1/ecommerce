<!DOCTYPE html>
<html>
   
<!-- Mirrored from themewagon.github.io/famms/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 21:51:29 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
  
      <div class="col-sm-6 col-md-4 col-lg-4" style="margin:auto; width:50%; padding:30px">
        {{-- <div class="box"> --}}
           <div class="img-box" style="padding: 20px" >
              <img height="400px", width="350px" src="/product/{{ $product->image }}" alt="">
           </div>
           <div class="detail-box">
              <h5 style="font-size: 15px">
                {{ $product->title }}
              </h5>
              @if ($product->discount_price!=null)

              <h6 style="color: red">
                discount price<br>
                ${{ $product->discount_price }}
              </h6>
                 
              <h6 style="text-decoration: line-through; color:green">
                price<br>
                ${{ $product->price }}
              </h6>

              @else
              <h6 style="color: green">
                price<br>
                ${{ $product->price }}
              </h6>

              @endif

              <h6>Category: <span style="font-weight: bold">{{ $product->category }}</span></h6>
              <h6>Product Information: <span style="font-weight: bold">{{ $product->description }}</span></h6>
              <h6>Available Quantity: <span style="font-weight: bold">{{ $product->quantity }}</span></h6>
              
              <form action="{{ url('/add_cart', $product->id) }}" method="POST">

                @csrf
                <div class="row">
                   <div class="col-md-4">
                      <input type="number" name="quantity" value="1" min="1" style="width: 60px" class="rounded-lg">
                   </div>
                      <div class="col-md-4">
                         <input type="submit" value="Add To Cart" style="width: 170px" class="rounded-lg">
                      </div>
                
                </div>
                
              </form>
           </div>
        </div>
     </div>
      
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer')
     
      <!-- footer end -->
      <div class="cpy_">
        <p class="mx-auto">© 2023 All Rights Reserved By Oscardom1<br>
        
        </p>
     </div>
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