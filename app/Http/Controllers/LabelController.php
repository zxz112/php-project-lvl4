<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\LabelValidation;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labels = Label::paginate();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize(Label::class);
        $label = new Label();
        return view('label.create', compact('label'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LabelValidation $request)
    {
        $this->authorize(Label::class);
        $data = $request->validated();
        $label = new Label();
        $label->fill($data);
        $label->save();
        flash(__('label has been added'))->success();
        return redirect()
            ->route('labels.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        $this->authorize(Label::class);
        return view('label.edit', compact('label'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(LabelValidation $request, Label $label)
    {
        $this->authorize(Label::class);
        $data = $request->validated();
        $label->fill($data);
        $label->save();
        flash(__('success edit'))->success();
        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        $this->authorize(Label::class);
        $label->delete();
        flash(__('success delete'))->success();
        return redirect()->route('labels.index');
    }
}
