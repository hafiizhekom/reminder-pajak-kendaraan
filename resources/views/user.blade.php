@extends('layouts.admin')

@section('content')
    
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add User</button>
                
            </div>
        </div>
    </div>
    
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true" data-show-columns="true">
      <thead>
        <tr>
            <th data-sortable="true" data-formatter="autoNo">No</th>
            <th data-sortable="true" data-field="name">Name</th>
            <th data-sortable="true" data-field="email">Email</th>
            <th data-sortable="true" data-field="phone">Phone</th>
            <th data-sortable="true" data-formatter="superadmin">Super Admin</th>
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
            
                <form action="{{url('/user/create')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Nama Lengkap" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" pattern="\d*" name="phone" placeholder="Nomor Handphone" required/>
                        </div>
                        <div class="form-group">
                            <label>Super Admin: </label><br>
                            <input type="radio" name="superadmin" value="1" required/> Yes<br>
                            <input type="radio" name="superadmin" value="0" required/> No<br>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="password" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" name="repassword" placeholder="Password Again" required/>
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
            
                <form action="{{url('/user/edit')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control form-edit" type="text" name="name" placeholder="Nama Lengkap" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-edit" type="email" name="email" placeholder="Email" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-edit" type="number" name="phone" placeholder="Nomor Handphone" required/>
                        </div>
                        <div class="form-group">
                            <label>Super Admin: </label><br>
                            <input type="radio" class="form-edit" name="superadmin" value="1" required/> Yes<br>
                            <input type="radio" class="form-edit" name="superadmin" value="0" required/> No<br>
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
            
                <form action="{{url('/user/delete')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Delete User</h5>
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
    
    <div id="editPasswordModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <form action="{{url('/user/edit/password')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-edit form-control" type="password" name="password" placeholder="Password" required/>
                        </div>
                        <div class="form-group">
                            <input class="form-edit form-control" type="password" name="repassword" placeholder="Password Again" required/>
                        </div>
                    </div>
                    <input class="form-edit" type="hidden" name="id">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
    $('#table').bootstrapTable({
        data: <?=$data?>
    })

    function autoNo(value, row, index) {
        return index+1;
    }

    function superadmin(value, row, index) {
        if(row.superadmin){
            return "<i class='fa fa-check'></i>";
        }else{
            return "<i class='fa fa-times'></i>";
        }
    }

    function actionColumn(value, row, index) {
        var elemButton =  '<button class="btn-table edit btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="'+row.id+'" data-name="'+row.name+'" data-email="'+row.email+'" data-phone="'+row.phone+'" data-superadmin="'+row.superadmin+'">Edit</button> ';
        elemButton += '<button class="btn-table edit-password btn btn-secondary" data-toggle="modal" data-target="#editPasswordModal" data-id="'+row.id+'">Change Password</button> ';
        elemButton += '<button class="btn-table delete btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="'+row.id+'" data-name="'+row.name+'">Delete</button>';
        return elemButton;
    }

    $('.edit').click(function(){
        var element = $(this);
        $('.form-edit[name=name]').val(element.data('name'));
        $('.form-edit[name=email]').val(element.data('email'));
        $('.form-edit[name=phone]').val(element.data('phone'));
        if(element.data('superadmin')){
            $('.form-edit[name=superadmin][value=1]').prop("checked", true);
        }else{
            $('.form-edit[name=superadmin][value=0]').prop("checked", true);
        }
        $('.form-edit[name=id]').val(element.data('id'));
    });

    $('.edit-password').click(function(){
        var element = $(this);
        $('.form-edit[name=id]').val(element.data('id'));
    });

    $('.delete').click(function(){
        var element =  $(this);
        $('.form-delete[name=name').html(element.data('name'));
        $('.form-delete[name=id]').val(element.data('id'));
    });
    </script>
@endsection
