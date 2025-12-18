<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adil Test | User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>User Dashboard</h2>

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
        <a href="{{ route('user.logout') }}">
            <p>User logout</p>
        </a>
        @if ($user)
            <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $user->email }}">
                </div>

                <div class="form-group">
                    <img src="{{ Storage::url($user->image) }}" alt="profile-img" width="100">
                </div>

                <div class="form-group">
                    <label for="profile-image">Profile Image:</label>
                    <input type="file" class="form-control" id="profile-image" name="profile_image">
                </div>

                <button type="submit" class="btn btn-info">Update Profile</button>
            </form>

            <hr>

            <form action="{{ route('user.changePassword.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="pwd">Current Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
                <div class="form-group">
                    <label for="pwd">New Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                </div>
                <div class="form-group">
                    <label for="conf-pwd">Confirm Password:</label>
                    <input type="password" class="form-control" id="conf-pwd" placeholder="Confirm password" name="confirm_password">
                </div>
                <button type="submit" class="btn btn-info">Change Password</button>
            </form>
        @endif
    </div>

</body>

</html>
