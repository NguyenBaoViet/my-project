<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Log;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category) {
        $this->category = $category;
    }
    public function create() {

        $htmlOptions = $this->getCategory('');
        return view('admin.category.add',compact('htmlOptions'));
    }

    public function index() {
        $categories = $this->category->paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function store(CategoryRequest $request) {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);

        return redirect()->route('category.index');
    }

    public function getCategory($parentId) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOptions = $recusive->categoryRecusive(0,'',$parentId);
        return $htmlOptions;
    }

    public function edit($id) {

        $category = $this->category->find($id);
        $htmlOptions = $this->getCategory($category->parent_id);
        
        return view('admin.category.edit',compact('category','htmlOptions'));
    }
    
    public function update($id, Request $request) {
        $this->category->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name)
        ]);
        return redirect()->route('category.index');
    }
    
    public function delete($id) {
        try {
            $this->category->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Success'
            ],200);
        } catch (\Exception $e) {
            Log::error('Message: '. $e->getMessage() .' ---Line: '. $e->getLine().'---File: '.$e->getFile());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }
    }
}
