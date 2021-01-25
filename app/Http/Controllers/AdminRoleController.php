<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use App\Role;
use App\Permission;
use DB;
use Log;

class AdminRoleController extends Controller
{
    private $role;
    private $permission;
    use DeleteModelTrait;
    public function __construct(Role $role, Permission $permission) {
        $this->role = $role;
        $this->permission   = $permission;
    }

    public function index() {
        $roles = $this->role->paginate(10);
        return view('admin.roles.index',compact('roles'));
    }

    public function create() {
        $permissionParents = $this->permission->where('parent_id',0)->get();
        return view('admin.roles.create',compact('permissionParents'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            //insert data to role table
            $dataInsert = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $role = $this->role->create($dataInsert);

            //insert data to permission_role table
            $role->permissions()->attach($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function edit($id) {
        $permissionParents = $this->permission->where('parent_id',0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions;

        return view('admin.roles.edit',compact('permissionParents','role','permissionChecked'));
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            //insert data to role table
            $dataUpdate = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $this->role->find($id)->update($dataUpdate);
            $role = $this->role->find($id);
            //insert data to permission_role table
            $role->permissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('roles.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($id,$this->role);
    }

}
