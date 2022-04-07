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
        // $sliders = Slider::get();
        // return view('admin.slider.middleIndex', compact('sliders'));
        return redirect(route('slides'));
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
        $file = $request->m_Slide;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs(
            'sliders', $filename
        );
        Slider::create([
            'slider_label' => $request->m_label,
            'slider_desc' => $request->m_desc,
            'slider_img' => $filename
        ]);
        return redirect(route('slides'))->with('status','Middle Slide created successfully');
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
        $mSlider = Slider::findOrFail($id);
        $file = $request->file('m_Slide');
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'sliders', $filename
            );
            if ($mSlider->slider_img) {
                Storage::delete('sliders/'.$mSlider->slider_img);
            }
        } else {
            $filename = $mSlider->slider_img;
        }
        $mSlider->update([
            'slider_label' => $request->m_label,
            'slider_desc' => $request->m_desc,
            'slider_img' => $filename
        ]);
        return redirect(route('slides'))->with('status','Middle Slide updated successfully');
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
