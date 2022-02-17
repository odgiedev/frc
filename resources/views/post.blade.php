<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>post</title>
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet" type="text/css">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <span class="h1 text-success"><a href="/{{$post->path}}" style="color:#c300ff;">/{{$post->path}}</a> - {{$post->board}}</span>
            </div>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger my-2">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="row">
            <div class="offset-3 col-6 border border-success p-3 my-3">
                <form action="/posts/reply/{{$post->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h3 class="text-center text-white">[ Reply ]</h3>
                    <label for="description" class="form-label text-white">Description:</label>
                    <input type="text" class="form-control bg-dark text-white" name="description" required>
                    <input type="file" name="img" class="form-control bg-dark text-white my-3" required>
                    <button type="submit" class="btn btn-outline-light">Submit</button>
                </form>
            </div>
        </div>
        <div class="card my-3">
            <div class="row bg-dark border border-3 border-success">
                <div class="col-4 d-flex justify-content-center">
                    <img src="../../images/{{$post->img}}" class="img-fluid p-0 border border-success" style="max-height:270px">
                </div>
                <div class="col-8">
                    <div class="card-body text-white">
                        <p class="card-text">{{$post->description}}</p>
                        <hr>
                        <p class="card-text"><small class="text-muted">{{$post->created_at}} | {{$post->username}}</small></p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="text-white">
        <hr class="text-white">
        <hr class="text-white">
        
        @foreach ($replies as $reply)
        <div class="card mx-auto my-4" style="max-width:1000px;">
            <div class="row bg-dark border border-3 border-success">
                <div class="col-4">
                    <img src="../../images/{{$reply->img}}" class="img-fluid p-0" style="max-height:210px;min-height:210px">
                </div>
                <div class="col-8">
                    <div class="card-body text-white">
                        <p class="card-text">{{ $reply->description }}</p>
                        <hr>
                        <p class="card-text"><small class="text-muted">{{$post->created_at}} | {{$post->username}}</small></p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="text-white">
        @endforeach
    </div>
    
    <div class="d-flex justify-content-center">
        {!! $replies->links() !!}
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>