@extends('layouts.admin')

@section('content')
    <div id="toolbar">
        <div class="form-inline" role="form">
            <div class="form-group">
                <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Vehicle</button>
            </div>
        </div>
    </div>
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true" data-show-columns="true">
      <thead>
        <tr>
            <th data-sortable="true" data-formatter="autoNo">No</th>
            <th data-sortable="true" data-formatter="vehicle">Vehicle</th>
            <th data-sortable="true" data-field="tax_validity_period">Tax Validity Period</th>
            <th data-sortable="true" data-field="stnk_validity_period">STNK Validity Period</th>
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
            
                <form action="{{url('/vehicle/create')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vehicle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="text"  name="area_code" placeholder="Area Code" maxlength="2" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="text" pattern="\d*" name="number" placeholder="Number" maxlength="4" required/>
                        </div>
                       
                        <div class="form-group">
                            <input class="form-control" type="text" name="code" placeholder="Code" maxlength="3" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="date" name="tax_validity_period" placeholder="Tax Validity Period" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control" type="date" name="stnk_validity_period" placeholder="STNK Validity Period" required/>
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
            
                <form action="{{url('/vehicle/edit')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Vehicle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input class="form-control form-edit" type="text"  name="area_code" placeholder="Area Code" maxlength="2" required/>
                        </div>
                        
                        <div class="form-group">
                            <input class="form-control form-edit" type="text" pattern="\d*" name="number" placeholder="Number" maxlength="4" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control form-edit" type="text" name="code" placeholder="Code" maxlength="3" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control form-edit" type="date" name="tax_validity_period" placeholder="Tax Validity Period" required/>
                        </div>

                        <div class="form-group">
                            <input class="form-control form-edit" type="date" name="stnk_validity_period" placeholder="STNK Validity Period" required/>
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
            
                <form action="{{url('/vehicle/delete')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Vechile</h5>
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

    <div id="renewModalTax" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <form action="{{url('/vehicle/renew/tax')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Renew Tax</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Current Tax Validity Period: </label><span class="current-renew-tax"></span><br>
                        <label>Next Tax Validity Period: </label><span class="next-renew-tax"></span>
                        <input class="form-edit-tax" type="hidden" name="id">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger" value="Yes">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="renewModalSTNK" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            
                <form action="{{url('/vehicle/renew/stnk')}}" method="POST">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Renew STNK</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>Current STNK Validity Period: </label><span class="current-renew-stnk"></span><br>
                        <label>Next STNK Validity Period: </label><span class="next-renew-stnk"></span>
                        <input class="form-edit-stnk" type="hidden" name="id">
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

    function vehicle(value, row, index) {
        return row.area_code+" "+row.number+" "+row.code;
    }

    function actionColumn(value, row, index) {
        var elemButton =  '<button class="btn-table edit btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="'+row.id+'" data-areacode = "'+row.area_code+'" data-number="'+row.number+'" data-code="'+row.code+'" data-type="'+row.type+'" data-brand="'+row.brand+'" data-tax="'+row.tax_validity_period+'" data-stnk="'+row.stnk_validity_period+'">Edit</button> ';
        elemButton += '<button class="btn-table renew-tax btn btn-success" data-toggle="modal" data-target="#renewModalTax" data-id="'+row.id+'" data-tax="'+row.tax_validity_period+'">Renew Tax</button> ';
        elemButton += '<button class="btn-table renew-stnk btn btn-info" data-toggle="modal" data-target="#renewModalSTNK" data-id="'+row.id+'" data-stnk="'+row.stnk_validity_period+'">Renew STNK</button> ';
        elemButton += '<button class="btn-table delete btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="'+row.id+'" data-name="'+row.area_code+' '+row.number+' '+row.code+'">Delete</button> ';
        
        return elemButton;
    }

    $('.edit').click(function(){
        var element = $(this);
        $('.form-edit[name=id]').val(element.data('id'));
        $('.form-edit[name=area_code]').val(element.data('areacode'));
        $('.form-edit[name=number]').val(element.data('number'));
        $('.form-edit[name=code]').val(element.data('code'));
        $('.form-edit[name=tax_validity_period]').val(element.data('tax'));
        $('.form-edit[name=stnk_validity_period]').val(element.data('stnk'));
        
    });

    $('.renew-tax').click(function(){
        var element = $(this);
        $('.current-renew-tax').html(element.data('tax'));
        $('.form-edit-tax[name=id]').val(element.data('id'));

        var date = new Date(element.data('tax')); 
        date.setFullYear(date.getFullYear() + 1);
        var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 ))
                    .toISOString()
                    .split("T")[0];
        $('.next-renew-tax').html(dateString);
        
    });

    $('.renew-stnk').click(function(){
        var element = $(this);
        $('.current-renew-stnk').html(element.data('stnk'));
        $('.form-edit-stnk[name=id]').val(element.data('id'));

        var date = new Date(element.data('stnk')); 
        date.setFullYear(date.getFullYear() + 5);
        var dateString = new Date(date.getTime() - (date.getTimezoneOffset() * 60000 ))
                    .toISOString()
                    .split("T")[0];
        $('.next-renew-stnk').html(dateString);
        
    });

    $('.delete').click(function(){
        var element =  $(this);
        $('.form-delete[name=name').html(element.data('name'));
        $('.form-delete[name=id]').val(element.data('id'));
    });
    </script>
@endsection
