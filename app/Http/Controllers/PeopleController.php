<?php

namespace App\Http\Controllers;

use App\People;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PeopleController extends Controller
{
    public function index()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        $people = People::get();
        $groups = \App\GroupPeople::get()->pluck('name', 'id');
        return view('people.index', compact('people', 'groups'));
    }

    public function create()
    {
        $people = new People();
        $groups = \App\GroupPeople::get()->pluck('name', 'id');
        return view('people.create', compact('people', 'groups'));
    }

    public function createXml()
    {
        $people = People::get();
        $groups = \App\GroupPeople::get()->pluck('name', 'id');
        $groupsPeople = [];
        foreach ($people as $person) {
            $groupsPeople[$person->group->name][] = $person;
        }
        return view('people.xml', compact('groupsPeople'));
    }

    public function store(Request $request)
    {

        $data = $this->validate($request, [
            'name' => 'required',
            'group_people_id' => 'required',
        ]);
        $people = new People();
        $people->fill($data);
        $people->save();
        return redirect()
            ->route('people.index');
    }

    public function destroy($id)
    {
        $people = People::find($id);
        if ($people) {
            $people->delete();
        }
        flash(__('success delete'))->success();
        return redirect()->route('people.index');
    }
}
