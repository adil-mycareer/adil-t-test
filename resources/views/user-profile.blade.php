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
        <a href="{{ route('user.logout') }}">
            <p>User logout</p>
        </a>
        <div id="responseArea" class="alert alert-success"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Profile Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($user)
                    <tr id="row">
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img src="{{ Storage::url($user->image) }}" alt="Profile-img" width="50">
                        </td>
                        <td class="status">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <button class="btn btn-info action" role="button" value="1" data-user-id="{{ $user->id }}">Approve</button>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</body>

</html>
