<?php

namespace App\Http\Controllers\Admin;

use App\Events\CreateLangEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguagesController extends Controller
{
    protected $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = $this->language->paginate(10);
        return view('admin.languages.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $data = $request->except('_token');
        $lang = $this->language->create($data);

        return redirect()->route('admin.languages.index')->with('success', 'تم أضافة اللغة بنجاح');

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
        $language = $this->language->findOrFail($id);
        return view('admin.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, $id)
    {
        $language = $this->language->findOrFail($id);
        $data = $request->except('_token', 'id', '_method');
        if (!$request->has('status'))
            $data = array_merge($data, ['status' => 0]);
        $language->update($data);
        return redirect()->route('admin.languages.index')->with('success', 'تم تحديث اللغة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
