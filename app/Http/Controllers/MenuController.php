<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components\Recusive;
use App\Components\MenuRecusive;
use App\Menu;

class MenuController extends Controller
{

    public function __construct(Menu $menu) {
        $this->menu = $menu;
    }

    public function index(){
        $menu = $this->menu->paginate(5);
        return view('admin.menus.index',compact('menu'));
    }

    public function create() {

        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        $htmlOptions = $recusive->MenuRecusiveAdd();
        return view('admin.menus.add',compact('htmlOptions'));
    }

    public function store(Request $request) {
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('menus.index');
    }

    public function edit($id) {
        $menu = $this->menu->find($id);
        $data = $this->menu->all();
        $recusive = new MenuRecusive($data);
        $htmlOptions = $recusive->MenuRecusiveEdit(0,'',$menu->parent_id);
        return view('admin.menus.edit',compact('htmlOptions','menu'));
    }

    public function update($id, Request $request) {
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('menus.index');
    } 

    public function delete($id) {     
        try {
            $this->menu->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);
        } catch (\Exception $e) {
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }
    }
}
