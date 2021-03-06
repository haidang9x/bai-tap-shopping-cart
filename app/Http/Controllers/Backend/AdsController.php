<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;
use Illuminate\Validation\Rule;

class AdsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$ads=Config::where('type','=','2')->orderby('created_at','desc')->get();
// dd('a');
        return view('backend.config.ads.index', compact('ads'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.config.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $value = trim($request->value, asset('/uploads/'));

        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:configs|max:100',
            'slug' => 'required|unique:configs|max:100',
            'value' => 'required|unique:configs',
        ], [
            'name.required' =>'Tên ads không được bỏ trống',
            'name.unique' =>'Tên ads đã tồn tại',
            'name.max' =>'Tên ads không vượt quá 100 kí tự',
            'slug.required' =>'Slug không được bỏ trống',
            'slug.unique' =>'Slug đã tồn tại',
            'slug.max' =>'Slug không vượt quá 100 kí tự',
            'value.required' => 'Hình ảnh không được bỏ trống',
            'value.unique' => 'Hình ảnh đã tồn tại',
        ]);

        Config::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'value' => $value,
            'type' => $request->type,
            'status' => $request->status,
        ]);
        return redirect()->route('ads.index')->with('success', 'Thêm mới thành công');
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
        $ads = Config::find($id);
        return view('backend.config.ads.edit', compact('ads'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ads = Config::find($id);
        if ($request->value == '') {
            $value = $ads->value;
        } else {
            $value = trim($request->value, asset('/uploads/'));
        }
        $request->validate([
            'name' => ['required','max:100',Rule::unique('configs')->ignore($id)],
            'slug' => ['required','max:100',Rule::unique('configs')->ignore($id)],
            'value' => 'unique:configs',
        ],[
            'name.required' =>'Tên ads không được bỏ trống',
            'name.unique' =>'Tên ads đã tồn tại',
            'name.max' =>'Tên ads không vượt quá 100 kí tự',
            'slug.required' =>'Slug không được bỏ trống',
            'slug.unique' =>'Slug đã tồn tại',
            'slug.max' =>'Slug không vượt quá 100 kí tự',
            'value.unique' => 'Hình ảnh đã tồn tại',
        ]);
        $ads->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'value' => $value,
            'type' => $request->type,
            'status' => $request->status,
        ]);
        return redirect()->route('ads.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = Config::find($id);
        $ads->delete();
        return redirect()->route('ads.index')->with('success', 'Xóa thành công');
    }
}
