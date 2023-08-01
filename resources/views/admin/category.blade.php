<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style>
        .div_center {
            text-align: center;
            padding-top: 40px
        }

        .h2_font {
            font-size: 40px;
            font-weight: bold;
            padding-bottom: 40px;

        }

        .input_color {
            color: black;
            border-radius: 20px;
        }

        .center, table, th, td {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid gray;
            padding: 20px;
        }

        .tr {
            margin-top: 30px;
            background: orangered;
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

                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{ session()->get('message') }}
                    </div>
                @endif

                <div class="div_center">
                    <h2 class="h2_font">Add Category</h2>
                    <form action="{{ url('/add_category') }}" method="POST">

                        @csrf

                        <input type="text" class="input_color rounded-md" name="category"
                            placeholder="Write category name">

                        <input type="submit" class="btn btn-danger" name="submit" value="Add Category">
                    </form>
                </div>

                <table class="center">
                    <tr class="tr">
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>

                    @foreach ($data as $data)
                        <tr>
                            <td>{{ $data->category_name }}</td>
                            <td>
                                <a onclick="return confirm('Are sure to delete this')" class="btn btn-danger" href="{{ url('delete_category', $data->id) }}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        @include('admin.script')

</body>

</html>
