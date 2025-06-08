<?php

namespace App\Http\Controllers;

use App\Models\SmsHistory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatorValidator;
use App\Http\Requests\ReminderCreateRequest;
use App\Http\Requests\ReminderEditRequest;
use App\Http\Requests\ReminderDeleteRequest;

class SmsHistoryController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data = SmsHistory::orderBy('id', 'DESC')->get();
        
        return view('smshistory', ['data'=>$data->toJson(), 'page'=>'Outbox']);
    }

}
