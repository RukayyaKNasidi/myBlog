<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
       <style type="text/css">
        .div_deg 
        {
            text-align: center;

        }
        .title_deg
        {
            font-size: 30px;
            font-weight: bold;
            padding: 30px;
            color: white;
        }
        label 
        {
            display:inline-block;
            width:200px;
            color:white;
            font-size:18px;
            font-weight: bold;
        }
        .field_deg
        {
            padding: 25px;
        }
        </style>


        @include('home.homecss')
    
    </head>
   <body>
   <div class="header_section">
            @include('sweetalert::alert')
     
            @include('home.header')
    </div>

      <div class="div_deg">
        <h3 class="title_deg">Add Post</h3>

        <form action="{{url('user_post')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="field_deg">
                <label>Title</label>
                <input type="text" name="title">
            </div>

            <div class="field_deg">
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>

            <div class="field_deg">
                <label>Add Image</label>
                <input type="file" name="image">
            </div>

            <div class="field_deg">
                <input class="btn btn-outline-secondary" type="submit" value="Add Post">
            </div>
        </form>

      </div>
      
      
      <!-- choose section end -->
      <!-- footer section start -->

        @include('home.footer')

      <!-- footer section end -->
          
   </body>
</html>