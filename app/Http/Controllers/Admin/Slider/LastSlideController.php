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
        // $sliders = Slider::get();
        // return view('admin.slider.lastIndex', compact('sliders'));
        return redirect(route('slides'));
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
        $file = $request->l_Slide;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs(
            'sliders', $filename
        );
        Slider::create([
            'slider_label' => $request->l_label,
            'slider_desc' => $request->l_desc,
            'slider_img' => $filename
        ]);
        return redirect(route('slides'))->with('status','Last Slide created successfully');
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
        $lSlider = Slider::findOrFail($id);
        $file = $request->file('l_Slide');
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs(
                'sliders', $filename
            );
            if ($lSlider->slider_img) {
                Storage::delete('sliders/'.$lSlider->slider_img);
            }
        } else {
            $filename = $lSlider->slider_img;
        }
        $lSlider->update([
            'slider_label' => $request->l_label,
            'slider_desc' => $request->l_desc,
            'slider_img' => $filename
        ]);
        return redirect(route('slides'))->with('status','Last Slide updated successfully');
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
