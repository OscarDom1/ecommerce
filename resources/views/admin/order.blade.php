<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')

    <style type="text/css">
        .title_deg{
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            padding-bottom: 40px;
        }

        .table_deg{
            border: 2px solid white;
            width: 100%;
            text-align: center;
            margin:auto;
            padding: auto;
        }

        tr, td, th{
            border: 2px solid white;

        }

        .tr {
            margin-top: 30px;
            background: orangered;
        }

        .img_size{
            height: 100px;
            width: 200px
        }

        .main_div{
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 25px;
        }

        .main_div input{
            height: 40px;
            border-radius: 30px;
        }
    </style>
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar')
      <!-- partial -->
      @include('admin.header')
     
         <!-- partial -->
         <div class="main-panel">
            <div class="content-wrapper">

            <h1 class="title_deg">All Orders</h1>

            <div class="main_div">
                <form action="{{ url('search') }}" method="get">

                    @csrf

                    <input style="color: black;" type="text" name="search" placeholder="Search For Item">

                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>
                
            <table class="table_deg">
                <tr class="tr">
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Email</th>
                    <th style="padding: 10px;">Address</th>
                    <th style="padding: 10px;">Phone</th>
                    <th style="padding: 10px;">Product Title</th>
                    <th style="padding: 10px;">Quantity</th>
                    <th style="padding: 10px;">Price</th>
                    <th style="padding: 10px;">Payment Status</th>
                    <th style="padding: 10px;">Delivery Status</th>
                    <th style="padding: 10px;">Image</th>
                    <th style="padding: 10px;">Delivered</th>
                    <th style="padding: 10px;">Print PDF</th>
                    <th style="padding: 10px;">Send Mail</th>
        
                </tr>

                @forelse ($order as $order)
                    
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                       <img class="img_size" src="/product/{{ $order->image }}" alt=""> 
                        </td>
                        <td>

                            @if($order->delivery_status == 'processing')

                                <a href="{{ url('delivered', $order->id) }}" onclick="return confirm('Are you sure the product has been delivered?')" class="btn btn-danger">Delivered</a>
                            @else
                            <button class="btn btn-success">Delivered</button>

                            @endif
                           
                        </td>
                        <td>
                            <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-light">PDF</a>
                        </td>
                        <td>
                            <a href="{{ url('send_email', $order->id) }}" class="btn btn-info">Mail</a>
                        </td>

                </tr>

                @empty
                <tr>
                    <td colspan="16">
                        No Data Found
                    </td>
                </tr>

                @endforelse
              
            </table>
            </div>
        </div>
      
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
  </body>
</html>
