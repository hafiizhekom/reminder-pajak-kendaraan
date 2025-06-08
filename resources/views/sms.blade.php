@extends('layouts.admin')

@section('content')
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <form action="{{url('sms/manual')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Receiver:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="receiver">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pesan:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="message"></textarea> 
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Kirim">
                </form>
            </div>

            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
@endsection

