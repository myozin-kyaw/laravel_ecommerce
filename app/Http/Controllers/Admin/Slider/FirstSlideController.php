<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FirstSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect(route('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create.firstSlide');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->f_Slide;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs(
            'sliders', $filename
        );
        Slider::create([
            'slider_label' => $request->f_label,
            'slider_desc' => $request->f_desc,
            'slider_img' => $filename
        ]);
        return redirect(route('slides'))->with('status','First Slide created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route('slides'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fSlider = Slider::findOrFail($id);
        return view('admin.slider.update.firstSlide', compact('fSlider'));
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
        $fSlider = Slider::findOrFail($id);
        $file = $request->file('f_Slide');
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'sliders', $filename
            );
            if ($fSlider->slider_img) {
                Storage::delete('sliders/'.$fSlider->slider_img);
            }
        } else {
            $filename = $fSlider->slider_img;
        }
        $fSlider->update([
            'slider_label' => $request->f_label,
            'slider_desc' => $request->f_desc,
            'slider_img' => $filename
        ]);
        return redirect(route('slides'))->with('status','First Slide updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect(route('slides'));
    }
}
