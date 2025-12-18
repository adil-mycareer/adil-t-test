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
        <a href="{{ route('admin.logout') }}">
            <p>Admin logout</p>
        </a>
        <div id="responseArea" class="alert alert-success"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Profile Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->isNotEmpty())
                    @foreach ($users as $key => $user)
                        <tr id="row_{{$user}}">
                            <td> {{ $key + 1 }} </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <img src="{{ Storage::url($user->image) }}" alt="Profile-img" width="50">
                            </td>
                            <td class="status">{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <button class="btn btn-info action" role="button" value="1" data-user-id="{{ $user->id }}">Approve</button>
                                <button class="btn btn-danger action" role="button" value="0" data-user-id="{{ $user->id }}">Reject</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

</body>

<script>
    $(document).ready(function() {
        $('#responseArea').hide();

        $('.action').click(function(e) {
            e.preventDefault(); // Prevent default form submission if inside a form
            let userId = $(this).attr('data-user-id');
            let row = $(this).closest('tr');
            $.ajax({
                url: "{{ route('admin.userApprove') }}", // Use Laravel's route() helper
                method: 'POST',
                dataType: 'json', // Expecting a JSON response
                data: {
                    value: $(this).val(),
                    user_id: userId,
                    _token: '{{ csrf_token() }}' // Optional if using global setup in Step 2
                },
                success: function(response) {
                    console.log(response.message);
                    row.find('.status').text(response.status_label)

                    $('#responseArea').html('<p>' + response.message + '</p>').show().fadeOut(3000).delay();
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
    });
</script>

</html>
