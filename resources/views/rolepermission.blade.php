@extends('layouts.admin')

@section('content')
    
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Role Permission</button>
            </div>
        </div>
    </div>
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true" data-show-columns="true">
      <thead>
        <tr>
            <th data-sortable="true" data-formatter="autoNo">No</th>
            <th data-sortable="true" data-formatter="role">Role</th>
            <th data-sortable="true" data-formatter="module">Module</th>
            <th data-sortable="true" data-formatter="activity">Activity</th>
            <th data-formatter="actionColumn">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="addModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <form action="{{url('/user/role_permission/create')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Role Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control form-edit" name="role" placeholder="Role" required>
                                <option value="" selected disabled>Select Role</option>
                                @foreach($role as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control form-edit" name="module" placeholder="Module" required>
                                <option value="" selected disabled>Select Module</option>
                                <option value="user">User</option>
                                <option value="role">Role</option>
                                <option value="role_permission">Role Permission</option>
                                <option value="vehicle">Vehicle</option>
                                <option value="vehicle_brand">Vehicle Brand</option>
                                <option value="vehicle_type">Vehicle Type</option>
                                <option value="vehicle_area_code">Vehicle Area Code</option>
                                <option value="reminder">Reminder</option>
                                <option value="reminder_receiver_role">Reminder Receiver Role</option>
                                <option value="reminder_history">Reminder History</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control form-edit" name="activity" placeholder="Activity" required>
                                <option value="" selected disabled>Select Activity</option>
                                <option value="create">Create</option>
                                <option value="read">Read</option>
                                <option value="update">Update</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <form action="{{url('/user/role_permission/edit')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Role Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <select class="form-control form-edit" name="role" placeholder="Role" required>
                                <option value="" selected disabled>Select Role</option>
                                @foreach($role as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control form-edit" name="module" placeholder="Module" required>
                                <option value="" selected disabled>Select Module</option>
                                <option value="user">User</option>
                                <option value="role">Role</option>
                                <option value="role_permission">Role Permission</option>
                                <option value="vehicle">Vehicle</option>
                                <option value="vehicle_brand">Vehicle Brand</option>
                                <option value="vehicle_type">Vehicle Type</option>
                                <option value="vehicle_area_code">Vehicle Area Code</option>
                                <option value="reminder">Reminder</option>
                                <option value="reminder_receiver_role">Reminder Receiver Role</option>
                                <option value="reminder_history">Reminder History</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control form-edit" name="activity" placeholder="Activity" required>
                                <option value="" selected disabled>Select Activity</option>
                                <option value="create">Create</option>
                                <option value="read">Read</option>
                                <option value="update">Update</option>
                                <option value="delete">Delete</option>
                            </select>
                        </div>
                        <input class="form-edit" type="hidden" name="id">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <form action="{{url('/user/role_permission/delete')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete <span class="form-delete" name="name"></span> ?
                        <input class="form-delete" type="hidden" name="id">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    $('#table').bootstrapTable({
        data: <?=$data?>
    })

    function toUpper(str) {
        return str
            .toLowerCase()
            .split(' ')
            .map(function(word) {
                console.log("First capital letter: "+word[0]);
                console.log("remain letters: "+ word.substr(1));
                return word[0].toUpperCase() + word.substr(1);
            })
            .join(' ');
        }

    function autoNo(value, row, index) {
        return index+1;
    }

    function role(value, row, index) {
        return row.role.name;
    }

    function module(value, row, index) {
        return toUpper(row.module.replace('_', ' '));
    }

    function activity(value, row, index) {
        return toUpper(row.activity.replace('_', ' '));
    }



    function actionColumn(value, row, index) {
        var elemButton =  '<button class="edit btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="'+row.id+'" data-role="'+row.role.id+'" data-module="'+row.module+'" data-activity="'+row.activity+'">Edit</button> ';
        elemButton += '<button class="delete btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="'+row.id+'" data-name="'+row.name+'">Delete</button>';
        return elemButton;
    }

    $('.edit').click(function(){
        var element = $(this);
        $('.form-edit[name=role]').val(element.data('role'));
        $('.form-edit[name=module]').val(element.data('module'));
        $('.form-edit[name=activity]').val(element.data('activity'));
        $('.form-edit[name=id]').val(element.data('id'));
    });

    $('.delete').click(function(){
        var element =  $(this);
        $('.form-delete[name=name').html(element.data('name'));
        $('.form-delete[name=id]').val(element.data('id'));
    });
    </script>
@endsection
