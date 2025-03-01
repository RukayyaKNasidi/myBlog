<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')
    <style type="text/css">
        .title_deg {
            font-size: 30px;
            color: white;
            padding: 70px;
            text-align: center;
        }
        .table_deg {
            border: 1px solid white;
            width: 100%; /* Make table full width */
            text-align: center;
            /* margin-left: 30px; Remove this line */
        }
        .th_deg {
            background-color: skyblue;
        }
        .img_deg {
            height: 100px;
            width: 150px;
            padding: 10px;
        }
        /* Add custom CSS to make page-content full width */
        
        .d-flex.align-items-stretch { /* Replace with the actual class of the outer container */
            min-height: 100vh; /* Make container full height */
            display: flex;
            flex-grow: 1; 
        }
    </style>
</head>
<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')
        <div class="page-content"> 
            @if(session()->has('message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 class="title_deg">All Post</h1>
            <table class="table_deg">
                <tr class="th_deg">
                    <th>Post Title</th>
                    <th>Description</th>
                    <th>Ppst by</th>
                    <th>Post Status</th>
                    <th>Usertype</th>
                    <th>Image</th>
                    <th>Delete</th>
                    <th>Edit</th>
                    <th>Status Accept</th>
                    <th>Status Reject</th>
                </tr>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->post_status }}</td>
                        <td>{{ $post->usertype }}</td>
                        <td><img class="img_deg" src="postimage/{{ $post->image }}"></td>
                        <td><a href="{{ url('delete_post') }}" class="btn btn-danger" onclick="confirmation(event)">Delete</a></td>
                        <td><a href="{{ url('edit_page', $post->id) }}" class="btn btn-success">Edit</a></td>
                        <td><a onclick="return confirm('are you sure you want to accept it')" href="{{url('accept_post', $post->id)}}" class="btn btn-outline-secodary">Accept</a></td>
                        <td><a onclick="return confirm('are you sure you want to reject it')" href="{{url('reject_post', $post->id)}}" class="btn btn-primary">Reject</a></td>
                    
                    
                    </tr>
                @endforeach
            </table>
        </div>
        @include('admin.footer')
        <script type="text/javascript">
            function confirmation(ev)
            {
                ev.preventDefault();
                var urlToRedirect=ev.currentTarget.getAttribute('href');
                swal({
                    title:"Are you Sure you want to delete this?",
                    text:"You won't be able to revert this delete",
                    icon:"warning",
                    button:true,
                    dangerMode: true,
                })
                .then((willCancel){
                    if(willCancel){
                        windows.location.href=urlToRedirect;
                    }
                })
            }
        </script>
    </div>
    <script src="admincss/vendor/jquery/jquery.min.js"></script>
    <script src="admincss/vendor/popper.js/umd/popper.min.js"></script>
    <script src="admincss/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admincss/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="admincss/vendor/chart.js/Chart.min.js"></script>
    <script src="admincss/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admincss/js/charts-home.js"></script>
    <script src="admincss/js/front.js"></script>
</body>
</html>