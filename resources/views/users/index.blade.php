@extends('adminlte::page')

@section('title', 'DataTables Example')

@section('content_header')
    <h1>Users</h1>

@stop

@section('content')

    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Data Table</h3> --}}
            <a data-url="{{ route('users.create') }}" class="btn btn-primary float-right openFormModal"  data-formcode="user_form">Create New Item</a>
        </div>
        <div class="card-body">
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div>
        @include('modal')
    </div>
@stop

@section('js')
  <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        $(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}", // Adjust route to your own controller route
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@stop
