<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Traits\DeleteModelTrait;
use DB;
use Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    use DeleteModelTrait;
    public function __construct(User $user, Role $role) {
        $this->user = $user;
        $this->role = $role;
    }

    public function index() {
        $users = $this->user->latest()->paginate(10);
        return view('admin.users.index',compact('users'));
    }

    public function create() {
        $roles = $this->role->all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            //insert data to user table
            $dataInsert = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];
            $user = $this->user->create($dataInsert);

            //insert data to role_user table
            $user->role()->attach($request->role_id);
            DB::commit();

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function edit($id) {
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $roleOfUser = $user->role;
        return view('admin.users.edit',compact('user','roles','roleOfUser'));
    }

    public function update($id, Request $request) {
        try {
            DB::beginTransaction();
            //insert data to user table
            $dataUpdate = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ];
            $this->user->find($id)->update($dataUpdate);
            $user = $this->user->find($id);
            //insert data to role_user table
            $user->role()->sync($request->role_id);
            DB::commit();

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($id,$this->user);
    }
}
