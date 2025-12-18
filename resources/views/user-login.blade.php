<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,
                   initial-scale=1,
                   shrink-to-fit=no" />
    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <title>Adil Test | User Login</title>
</head>

<body>
    <h1 class="text-success text-center">
        User Login
    </h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form id="registrationForm" action="{{ route('UserLogin') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">
                                    Email
                                </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
                            </div>
                            <div class="form-group">
                                <label for="password">
                                    Password
                                </label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                            </div>
                            <button class="btn btn-danger">
                                Login
                            </button>
                        </form>
                        <p class="mt-3">
                            Not registered?
                            <a href="{{ route('user.registerForm') }}">Create an account</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
