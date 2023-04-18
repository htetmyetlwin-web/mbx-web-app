<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create')->with([
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
        $user->password = Hash::make($request->password);
    	$user->save();

        if($user->save()){
            $request->session()->flash('success', $user->name . ' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }
        // for role_user table
        // $role_user = new Role();
        // $role->role_id = $request->role;
        // $role->user_id = $user->id;
        // $role->save();

        return redirect()->route('users.index');

      
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::denies('edit.users')){
            return redirect(route('users.index'));
        }
        $roles = Role::all();

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        if($user->save()){
            $request->session()->flash('success', $user->name . ' has been updated');
        }else{
            $request->session()->flash('error', 'There was an error updating the user');
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete.users')){
            return redirect(route('users.index'));
        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('users.index');
    }



    public function profile(){
        return view('profile.index');
    }


    public function postProfile(Request $request){
        // dd($request->all());
        $user = auth()->user();
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id

        ]);

        $user->update($request->all());

        return redirect()->back()->with('success', 'Profile Successfully Updated.');    }

}
