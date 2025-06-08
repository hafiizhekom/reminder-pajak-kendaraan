<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidatorValidator;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserEditPasswordRequest;
use App\Http\Requests\UserDeleteRequest;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
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
    public function index(User $user)
    {   
        $data = User::get();
        return view('user', ['data'=>$data, 'page'=>'User']);
    }

    public function create(UserCreateRequest $request)
    {
        $data = $request->validated();
        
        
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->superadmin = $data['superadmin'];
        $user->password = md5($data['password']);
        
        if($user->save()){
            return redirect('user');
        }
    }

    public function edit(UserEditRequest $request)
    {
        $data = $request->validated();
        
        
        $user = User::find($data['id']);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->superadmin = $data['superadmin'];
        
        if($user->save()){
            return redirect('user');
        }
    }

    public function editPassword(UserEditPasswordRequest $request)
    {
        $data = $request->validated();
        
        
        $user = User::find($data['id']);
        $user->password = md5($data['password']);
        
        if($user->save()){
            return redirect('user');
        }
    }

    public function destroy(UserDeleteRequest $request)
    {
        $data = $request->validated();
        
        
        $user = User::find($data['id']);
        
        if($user->delete()){
            return redirect('user');
        }
    }
}
