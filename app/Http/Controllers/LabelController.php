<?php

namespace App\Http\Controllers;

use App\Label;
use Illuminate\Http\Request;
use Auth;

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
        if (Auth::check()) {
            $label = new Label();
            return view('label.create', compact('label'));
        }
        flash('need auth')->error();
        return redirect()
            ->route('labels.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $data = $this->validate($request, ['name' => 'required|unique:labels']);
            $label = new Label();
            $label->fill($data);
            $label->save();
            flash('label has been added')->success();
            return redirect()
                ->route('labels.index');
        }
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
        if (Auth::check()) {
            return view('label.edit', compact('label'));
        }
        flash('failed edit')->error();
        return redirect()->route('labels.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        if (Auth::check()) {
            $data = $this->validate($request, ['name' => 'required|unique:labels']);
            $label->fill($data);
            $label->save();
            flash('success edit')->success();
            return redirect()->route('labels.index');
        }
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
        if (Auth::check()) {
            $label->delete();
            flash('succes delete')->success();
        }
        return redirect()->route('labels.index');
    }
}
