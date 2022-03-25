<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MiddleSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.middleIndex', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create.middleSlide');
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
        $file = $request->hasFile('m_Slide');
        if ($file) {
            $newFile = $request->file('m_Slide');
            $file_path = $newFile->store('sliders');
            $slider->slider_img = $file_path;
        }
        $slider->slider_label = $request->m_label;
        $slider->slider_desc = $request->m_desc;
        $slider->save();
        return redirect('/slide')->with('status','Middle Slide created successfully');
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
        $mSlider = Slider::skip(1)->take(1)->first();
        return view('admin.slider.update.middleSlide', compact('mSlider'));
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
        $file = $request->hasFile('m_Slide');
        if ($file) {
            $path = '/Storage/'.$slider->slider_img;
            if (file_exists($path)) {
                Storage::delete('/Storage/'.$slider->slider_img);
            }
            $newFile = $request->file('m_Slide');
            $file_path = $newFile->store('sliders');
            $slider->slider_img = $file_path;
        }
        $slider->slider_label = $request->m_label;
        $slider->slider_desc = $request->m_desc;
        $slider->save();
        return redirect('/slide')->with('status','Middle Slide updated successfully');
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
