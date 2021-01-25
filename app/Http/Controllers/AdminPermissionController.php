<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class AdminPermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission){
        $this->permission = $permission;
    }
    public function create() {
        return view('admin.permission.create');
    }

    public function store(Request $request) {
        foreach (config('permissions.table_module') as $item) {
            if ($item[0] === $request->module_parent) {
                $display_name_parent = $item[1];
            }
        }

        $dataInsert = [
            'name' => $request->module_parent,
            'display_name' => $display_name_parent,
            'parent_id' => 0,
            'key_code' => ' '
        ];
        $permissions = $this->permission->create($dataInsert);

        
        foreach ($request->module_children as $item) {
            foreach (config('permissions.module_children') as $value) {
                if ($value[0] === $item) {
                    $display_name_children = $value[1].' '.$display_name_parent;
                }
            }
            $this->permission->create([
                'name' => $item.' '.$request->module_parent,
                'display_name' =>  $display_name_children,
                'parent_id' => $permissions->id,
                'key_code' => $item.'_'.$request->module_parent
            ]);
        }
    }
}
