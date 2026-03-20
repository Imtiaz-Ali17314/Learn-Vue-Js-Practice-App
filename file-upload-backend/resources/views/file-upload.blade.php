<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-2">File Upload</h1>
            </div>
        </div>
        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <input type="file" name="photo" accept="image/*">
                    @error('photo')
                       <div class="alert alert-danger my-1"> {{$message}}</div>
                    @enderror
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-success btn-sm">
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                @if (session('status'))
                   <div class="alert alert-success"> {{session('status')}}</div>
                @endif
            </div>
            @foreach ($users as $user)
               <div class="col-2 mt-5">
                    <img class="img-fluid img-thumbnail me-2" src="{{asset('/storage/'. $user->file_name)}}" alt="">
                    <div class="d-flex justify-content-center align-item-center">
                        <form action="{{route('user.destroy' , $user->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-3">Delete</button>
                        </form>

                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning btn-sm ">Update</a>
                    </div>
                   
                </div> 
            @endforeach
            
        </div>
    </div>
</body>
</html>