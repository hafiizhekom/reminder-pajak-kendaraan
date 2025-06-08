<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatorValidator;
use App\Http\Requests\ReminderCreateRequest;
use App\Http\Requests\ReminderEditRequest;
use App\Http\Requests\ReminderDeleteRequest;

class ReminderController extends Controller
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
        $data = Reminder::get();

        return view('reminder', ['data'=>$data->toJson(), 'page'=>'Reminder']);
    }

    public function create(ReminderCreateRequest $request)
    {
        $data = $request->validated();
        
        
        $reminder = new Reminder();
        $reminder->before_deadline = $data['before_deadline'];
        if($reminder->save()){
            return redirect('reminder');
        }
    }

    public function edit(ReminderEditRequest $request)
    {
        $data = $request->validated();
        
        
        $reminder = Reminder::find($data['id']);
        $reminder->before_deadline = $data['before_deadline'];
        if($reminder->save()){
            return redirect('reminder');
        }
    }

    public function destroy(ReminderDeleteRequest $request)
    {
        $data = $request->validated();
        
        
        $reminder = Reminder::find($data['id']);
        
        if($reminder->delete()){
            return redirect('reminder');
        }
    }
}
