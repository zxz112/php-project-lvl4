<?php

namespace App\Http\Controllers;

use App\GroupPeople;
use Illuminate\Http\Request;

class GroupPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = GroupPeople::paginate();
        return view('groupPeople.index', compact('group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new GroupPeople();

        return view('groupPeople.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required'
        ]);
        $group = new GroupPeople();
        $group->fill($data);
        $group->save();
        return redirect()
            ->route('groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GroupPeople  $groupPeople
     * @return \Illuminate\Http\Response
     */
    public function show(GroupPeople $groupPeople)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GroupPeople  $groupPeople
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupPeople $groupPeople)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GroupPeople  $groupPeople
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupPeople $groupPeople)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GroupPeople  $groupPeople
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $groupPeople = GroupPeople::find($id);
        if ($groupPeople) {
            $groupPeople->delete();
        }
        flash(__('success delete'))->success();
        return redirect()->route('groups.index');
    }
}
