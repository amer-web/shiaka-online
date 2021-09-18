<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MySlugHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->where('parent_id', '<>', null)->orderBy('position', 'asc')->get()->toTree();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $categories = $this->category->get()->toTree();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->data;
            DB::beginTransaction();
            $data['status'] = $request->input('status', 0);
            $data['position'] = $request->input('position');
            $category = $this->category->create($data);
            $parent = $this->category->find($request->parent_id);
            $parent->appendNode($category);
            $this->upload_image($category);
            DB::commit();
            return redirect()->route('admin.categories.index')->with('success', 'تم اضافة القسم بنجاح');
        } catch (\Exception $ex) {
            return $ex;
            DB::rollback();
            return redirect()->route('admin.categories.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
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
    public function edit($id)
    {
        $editCategory = $this->category->findOrFail($id);
        if (!$editCategory->parent_id)
            return redirect()->route('admin.categories.index')->with('warning', 'لايمكن التعديل على هذا القسم');
        $categories = $this->category->where('id', '!=', $id)->whereNotDescendantOf($id)->get()->toTree();
        return view('admin.categories.edit', compact('editCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        try {
            $category = $this->category->findOrFail($id);
            $data = $request->data;
            DB::beginTransaction();
            
            $data['status'] = $request->input('status', 0);
            $data['position'] = $request->input('position');
            $category->update($data);
            $parent = $this->category->find($request->parent_id);
            $parent->appendNode($category);
            $this->upload_image($category);
            DB::commit();
            return redirect()->route('admin.categories.index')->with('success', trans('admin.success', ['name' => trans('admin.category')]));
        } catch (\Exception $ex) {
            return $ex;
            DB::rollback();
            return redirect()->route('admin.categories.index')->with('warning', 'هناك خطأ ما حاول فيما بعد');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function upload_image($category)
    {
        if (request()->file()) {
            foreach ($category->Filledimages as $name) {
                if ($category->{$name}) {
                    $deleteImage = public_path($category->{$name});
                    unlink($deleteImage);
                }
                $image = request()->file($name)->store('categories', 'images');
                $path = 'images/'  . $image;
                $category->{$name} = $path;
                $category->save();
            }
        }
    }
}
