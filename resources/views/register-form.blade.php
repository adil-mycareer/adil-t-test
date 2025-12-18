<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adil Test | User Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2>User Register</h2>
        <form action="{{ route('user.registerStore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
            </div>
            <div class="form-group">
                <label for="conf-pwd">Confirm Password:</label>
                <input type="password" class="form-control" id="conf-pwd" placeholder="Confirm password" name="confirm_password">
            </div>

            <div class="form-group">
                <label for="profile-image">Profile Image:</label>
                <input type="file" class="form-control" id="profile-image" name="profile_image">
            </div>

            <div class="form-group">
                <label for="">Captcha:</label>
                <input type="text" class="form-control" id="" name="captcha">
            </div>

            <button type="submit" class="btn btn-info">Submit</button>
        </form>
        <p class="mt-3">
            Are you admin?
            <a href="{{ route('admin.login.show') }}">Admin Login</a>
        </p>
        <p class="mt-3">
            User login?
            <a href="{{ route('UserLogin.show') }}">User Login</a>
        </p>
    </div>

</body>

</html>
