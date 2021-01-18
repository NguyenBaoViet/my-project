<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\ProductImage;
use App\Tag;
use App\ProductTag;
use App\Components\Recusive;
use Illuminate\Support\Facades\Storage;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use App\Http\Requests\ProductAddRequest;
use DB;
use Log;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, 
                                Product $product, 
                                ProductImage $productImage,
                                Tag $tag,
                                ProductTag $productTag)
    {

        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    public function index() {
        $products = $this->product->latest()->paginate(5);
        return view('admin.products.index',compact('products'));
    }

    public function create() {
        $htmlOptionsCategory = $this->getCategory('');
        $htmlOptionsTags = $this->getTag();
        $product = $this->product->all();
        return view('admin.products.create',compact('htmlOptionsCategory','product','htmlOptionsTags'));
    }

    public function getCategory($parentId) {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOptions = $recusive->categoryRecusive(0,'',$parentId);
        return $htmlOptions;
    }

    public function getTag() {
        $data = $this->tag->all();
        $recusive = new Recusive($data);
        $htmlOptions = $recusive->getTags();
        return $htmlOptions;
    }

    public function store(ProductAddRequest $request) {
        try {
            DB::beginTransaction();
            //Insert data to products table
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path','product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $product = $this->product->create($dataProductCreate);

            //Insert data to product_images table
            $file = $request->image_path;
            if ($request->hasFile('image_path')) {
                foreach($file as $fileItem) {
                    $dataProductImageCreate = $this->storageTraitUploadMultiple($fileItem,'product');
                    $product->productImage()->create([
                        'image_path' => $dataProductImageCreate['file_path'],
                        'image_name' => $dataProductImageCreate['file_name']
                    ]);
                }
            }

            //Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagId);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function edit($id) {
        $products = $this->product->find($id);
        $htmlOptions = $this->getCategory($products->category_id);
        return view('admin.products.edit',compact('htmlOptions','products'));
    }

    public function update($id, Request $request) {
        try {
            DB::beginTransaction();
            //Insert data to products table
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path','product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);

            //Insert data to product_images table
            $file = $request->image_path;
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id',$id)->delete();
                foreach($file as $fileItem) {
                    $dataProductImageCreate = $this->storageTraitUploadMultiple($fileItem,'product');
                    $product->productImage()->create([
                        'image_path' => $dataProductImageCreate['file_path'],
                        'image_name' => $dataProductImageCreate['file_name']
                    ]);
                }
            }

            //Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagId[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagId);
            DB::commit();
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Message: '. $e->getMessage()  .' ---Line: '. $e->getLine(). ' ---File: '.$e->getFile());
        }
    }

    public function delete($id){
        return $this->deleteModelTrait($id, $this->product);
    }
}