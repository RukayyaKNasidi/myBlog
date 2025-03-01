<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.homecss')
    <style>
        .post_deg {
            padding: 30px;
            text-align: center;
            background-color: black;
        }
        .title_deg {
            font-size: 30px;
            font-weight: bold;
            padding: 15px;
            color: blue;
        }
        .des_deg {
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
        }
        .img_deg {
            height: 200px;
            width: 300px;
            padding: 30px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="header_section">
        @include('home.header')

        @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get('message') }}
        </div>
        @endif

        @foreach($data as $data)
        <div>
            <h1 class="title_deg">Update Post</h1>
            <form action="{{ url('update_post_data', $data->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="post_deg">
                    <h4 class="title_deg">{{ $data->title }}</h4>
                    <p class="des_deg">{{ $data->description }}</p>
                    <img class="img_deg" src="/postimage/{{ $data->image }}">

                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $data->id }})">Delete</button>
                    <a href="{{ url('post_update_page', $data->id) }}" class="btn btn-primary">Update</a>
                </div>
            </form>
        </div>
        @endforeach
    </div>

    @include('home.footer')

    
</body>
</html>