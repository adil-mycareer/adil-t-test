<!DOCTYPE html>
<html lang="en">

<head>
    <title>Adil Test | Admin Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Admin Dashboard</h2>
        <p>Here you can approve or reject users.</p>
        <a href="{{ route('admin.logout') }}"><p>Admin logout</p></a>
        <table class="table">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>User Name</td>
                    <td>Doe</td>
                    <td>
                        <a href="#" class="btn btn-info" role="button">Approve</a>
                        <a href="#" class="btn btn-danger" role="button">Reject</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>
