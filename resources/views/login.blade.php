<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login Page</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        .login-box{
            border: solid 1px;
            width: 500px;
            padding: 10px;
            box-sizing: border-box;
        }
    </style>
    </head>
<body>
    <div class="vh-100 d-flex justify-content-center align-content-center">
        <div class="login-box">
            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
            <form action="" method="POST">
                @csrf
                <div class="form-outline form-white mb-4">
                    <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" required />
                    <label class="form-label" for="typeEmailX">Email</label>
                </div>
                <div class="form-outline form-white mb-4">
                    <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password" required />
                    <label class="form-label" for="typePasswordX">Password</label>
                </div>
                <button class="btn btn-primary btn-lg px-5" type="submit">Login</button>
            </form>
            <br><br><br>
            {{-- <button class="btn btn-success btn-sm px-5" type="submit"> <a  class="nav-link" href="/residents">kembali</a>
            </button> --}}

            @if (Session::has('status'))
            <div class="alert alert-danger">
                {{Session::get('message')}}
            </div>
            @endif
        </div>
    </div>








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
