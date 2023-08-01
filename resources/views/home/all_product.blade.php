<!DOCTYPE html>
<html>

<!-- Mirrored from themewagon.github.io/famms/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Jul 2023 21:51:29 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

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
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')

    
        <!-- end header section -->

    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product_view')

    <!-- end product section -->

    {{-- Comment and reply system starts here --}}

    <div style="text-align: center; padding-bottom: 30px;">
        <h1 style="font-size: 30px; text-align: center; padding-top: 20px; padding-bottom: 20px; ">Comments</h1>

        <form action="{{ url('add_comment') }}" method="POST">

            @csrf

            <textarea style="height: 150px; width: 600px" name="comment" placeholder="Comment something here"></textarea><br>

            <input type="submit" class="btn btn-primary" value="Comment">

        </form>

    </div>

    <div style="padding-left: 20%">
        <h1 style="font-size: 20px">All Comments</h1>


        @foreach ($comment as $comment)
            <div>
                <b>{{ $comment->name }}</b>
                <p>{{ $comment->comment }}</p>

                <a style="
            color:blue" href="javascript::void(0);" onclick="reply(this)"
                    data-Commentid="{{ $comment->id }}">Reply</a>

                      @if (Auth::check() && Auth::id() === $comment->user_id)
            <form action="{{ route('delete_comment', ['id' => $comment->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif

                @foreach ($reply as $rep)
                    @if ($rep->comment_id==$comment->id)
                        <div style="padding-left: 3%; padding-bottom: 10px;">

                            <b>{{ $rep->name }}</b>
                            <p>{{ $rep->reply }}</p>
                            <a style="
                            color:blue" href="javascript::void(0);" onclick="reply(this)"
                                    data-Commentid="{{ $comment->id }}">Reply</a>
                        </div>
                    @endif
                @endforeach

            </div>
        @endforeach

        {{-- //reply textbox --}}
        <div style="display:none;" class="replyDiv">

            <form action="{{ url('add_reply') }}" method="POST">


                @csrf

                <input type="text" id="commentId" name="commentId" hidden>
                <textarea style="height: 100px; width: 500px;" placeholder="write something here" name="reply"></textarea>

                <br>

                <button type="submit" class="btn btn-warning">Reply</button>
                <a href="javascript::void(0);" class="btn" onclick="reply_close(this)">close</a>

            </form>


        </div>
    </div>






    {{-- Comment and reply system ends here --}}



    <!-- end client section -->
  

    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2023 All Rights Reserved By Oscardom1<br>

        </p>
    </div>

    {{-- javscript for comment section --}}

    <script type="text/javascript">
        function reply(caller) {

            document.getElementById('commentId').value = $(caller).attr('data-Commentid');

            $('.replyDiv').insertAfter($(caller));

            $('.replyDiv').show();


        }

        function reply_close(caller) {

            $('.replyDiv').hide();


        }
    </script>

<script>
   document.addEventListener("DOMContentLoaded", function(event) { 
       var scrollpos = localStorage.getItem('scrollpos');
       if (scrollpos) window.scrollTo(0, scrollpos);
   });

   window.onbeforeunload = function(e) {
       localStorage.setItem('scrollpos', window.scrollY);
   };
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

</html>
