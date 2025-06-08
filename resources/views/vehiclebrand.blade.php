@extends('layouts.admin')

@section('content')
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Vehicle Brand</button>
            </div>
        </div>
    </div>
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true" data-show-columns="true">
      <thead>
        <tr>
            <th data-sortable="true" data-formatter="autoNo">No</th>
            <th data-sortable="true" data-field="name">Nama</th>
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
            
                <form action="{{url('/vehicle/brand/create')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vehicle Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="text" name="name" placeholder="Name" required/>
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
            
                <form action="{{url('/vehicle/brand/edit')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Vehicle Brand</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control form-edit" type="text" name="name" placeholder="Name" required/>
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
            
                <form action="{{url('/vehicle/brand/delete')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Vehicle Brand</h5>
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

    function autoNo(value, row, index) {
        return index+1;
    }

    function actionColumn(value, row, index) {
        var elemButton =  '<button class="edit btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="'+row.id+'" data-name="'+row.name+'" data-email="'+row.email+'" data-phone="'+row.phone+'">Edit</button> ';
        elemButton += '<button class="delete btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="'+row.id+'" data-name="'+row.name+'">Delete</button>';
        return elemButton;
    }

    $('.edit').click(function(){
        var element = $(this);
        $('.form-edit[name=name]').val(element.data('name'));
        $('.form-edit[name=id]').val(element.data('id'));
    });

    $('.delete').click(function(){
        var element =  $(this);
        $('.form-delete[name=name').html(element.data('name'));
        $('.form-delete[name=id]').val(element.data('id'));
    });
    </script>
@endsection
