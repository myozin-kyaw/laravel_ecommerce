<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LastSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.lastIndex', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create.lastSlide');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $file = $request->hasFile('l_Slide');
        if ($file) {
            $newFile = $request->file('l_Slide');
            $file_path = $newFile->store('sliders');
            $slider->slider_img = $file_path;
        }
        $slider->slider_label = $request->l_label;
        $slider->slider_desc = $request->l_desc;
        $slider->save();
        return redirect('/slide')->with('status','Last Slide created successfully');
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
        $lSlider = Slider::skip(2)->take(1)->first();
        return view('admin.slider.update.lastSlide', compact('lSlider'));
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
        $slider = Slider::findOrFail($id);
        $file = $request->hasFile('l_Slide');
        if ($file) {
            $path = '/Storage/'.$slider->slider_img;
            if (file_exists($path)) {
                Storage::delete('/Storage/'.$slider->slider_img);
            }
            $newFile = $request->file('l_Slide');
            $file_path = $newFile->store('sliders');
            $slider->slider_img = $file_path;
        }
        $slider->slider_label = $request->l_label;
        $slider->slider_desc = $request->l_desc;
        $slider->save();
        return redirect('/slide')->with('status','Last Slide updated successfully');
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
}
