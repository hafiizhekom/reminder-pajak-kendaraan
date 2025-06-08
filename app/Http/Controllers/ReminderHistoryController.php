<?php

namespace App\Http\Controllers;

use App\Models\ReminderHistory;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatorValidator;
use App\Http\Requests\ReminderCreateRequest;
use App\Http\Requests\ReminderEditRequest;
use App\Http\Requests\ReminderDeleteRequest;

class ReminderHistoryController extends Controller
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
        $data = ReminderHistory::orderBy('id', 'DESC')->with('user')->with('vehicle')->get();
        
        return view('reminderhistory', ['data'=>$data->toJson(), 'page'=>'Reminder History']);
    }

}
