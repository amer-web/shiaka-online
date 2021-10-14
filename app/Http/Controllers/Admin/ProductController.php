<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Media;
use App\Models\product;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\productRequest;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $product;
    protected $category;

    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->with('translation', 'media')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->category->with('translation')->whereNotNull('parent_id')->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'data', 'images');
            $data = array_merge($data, $request->data);
            DB::beginTransaction();
            $product = $this->product->create($data);
            $this->upload_image($request, $product);
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'تم اضافة المنتج بنجاح');
        } catch (\Exception $ex) {
            return $ex;
            DB::rollback();
            return redirect()->route('admin.products.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->findOrFail($id);
        $categories = $this->category->with('translation')->whereNotNull('parent_id')->get();
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try {
            $product = $this->product->findOrFail($id);
            $data = $request->except('_token', 'data', 'images', 'featured', 'status');
            $data = array_merge($data, $request->data, ['status' => $request->input('status', 0), 'featured' => $request->input('featured', 0)]);
            DB::beginTransaction();
            $product->update($data);
            $this->upload_image($request, $product);
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'تم تعديل المنتج بنجاح');
        } catch (\Exception $ex) {
            return $ex;
            DB::rollback();
            return redirect()->route('admin.products.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);
        if ($product->media->count() > 0) {
            foreach ($product->media as $media) {
                $this->delete_image($media->id);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'تم حذف المنتج بنجاح');
    }

    public function upload_image($request, $product)
    {
        if ($request->images != null) {
            $i = 1;
            foreach ($request->images as $image) {
                $fileName = $product->slug . '-' . time() . '-' . $i . '.' . $image->getClientOriginalExtension();
                $path = public_path('images\products\\' . $product->id);
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $path_image = $path . '\\' . $fileName;
                $file_image = 'images/products/' . $product->id . '/' . $fileName;
                Image::make($image->getRealPath())->resize(488, 488, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path_image, 100);
                $product->media()->create([
                    'file_name' => $file_image,
                ]);
                $i++;
            }
        }
    }

    public function delete_image($id)
    {
        $media = Media::find($id);
        if (File::exists(public_path($media->file_name))) {
            unlink(public_path($media->file_name));
        }
        if (count(scandir(dirname(public_path($media->file_name)))) == 2) {
            rmdir(dirname(public_path($media->file_name)));
        }
        $media->delete();
        return true;
    }

}
