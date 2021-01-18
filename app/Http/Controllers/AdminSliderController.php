<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SliderRequest;
use App\Slider;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Log;

class AdminSliderController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $slider;
    public function __construct(Slider $slider) {
        $this->slider = $slider;
    }

    public function index() {
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.sliders.index',compact('sliders'));
    }

    public function create() {
        return view('admin.sliders.create');   
    }

    public function store(SliderRequest $request) {
        try {
            $dataInsert = [
                'name' => $request->name,
                'description' => $request->description
            ];
    
            $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
            $dataInsert['iamge_path'] = $dataImageSlider['file_path'];
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
    
            $this->slider->create($dataInsert);
            return redirect()->route('sliders.index');
        } catch(\Exception $e) {
            Log::error('Error: ' . $e->getMessage() .'----line: '.$e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function edit($id) {
        $slider = $this->slider->find($id);
        return view('admin.sliders.edit',compact('slider'));
    }

    public function update(Request $request, $id) {
        try {
            $dataUpdate = [
                'name' => $request->name,
                'description' => $request->description
            ];
    
            if ($request->hasfile('image_path')) {
                $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
                $dataUpdate['iamge_path'] = $dataImageSlider['file_path'];
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
            } else {
                $dataUpdate['iamge_path'] = $selected_image_path;
                $dataUpdate['image_name'] = $selected_image_name;
            }

            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route('sliders.index');
        } catch(\Exception $e) {
            Log::error('Error: ' . $e->getMessage() .'----line: '.$e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function delete($id) {
        return $this->deleteModelTrait($id, $this->slider);
    }
}
