@extends('layouts.admin')

@section('content')
    <div id="toolbar">
        
    </div>
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true" data-show-columns="true">
      <thead>
        <tr>
            <th data-sortable="true" data-formatter="autoNo">No</th>
            <th data-sortable="true" data-field="phone">Phone</th>
            <th data-sortable="true" data-field="message">Message</th>
            <th data-sortable="true" data-field="created_at">Date</th>
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


    <script>
    $('#table').bootstrapTable({
        data: <?=$data?>
    })

    function autoNo(value, row, index) {
        return index+1;
    }

    function type(value, row, index){
        if(row.type=="tax"){
            return "Tax";
        }else if(row.type=="stnk"){
            return "STNK"
        }
    }

    function vehicle(value, row, index){
        return row.vehicle.vehicle_area_code.code+ " "+row.vehicle.number+" "+row.vehicle.code;
    }


    </script>
@endsection
