@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <br>

    <div class="container">
        <center>
            <h1>User List</h1>
        </center>
        <br>
        <table id="example" class="table" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($user as $usr)
                    <tr>
                        <td>{{ $usr->name }}</td>
                        <td>
                            @if (is_null($usr->email_verified_at))
                                Not Verified
                            @else
                                Verified
                            @endif
                        </td>

                        <td>
                            <center>
                                @if ($usr->role == 1)
                                    <button class="btn btn-success">Admin</button>
                                @else
                                    <button class="btn btn-info">User</button>
                                @endif
                            </center>
                        </td>
                        <td>{{ $usr->email }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection


@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endsection
