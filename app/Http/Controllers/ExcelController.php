<?php

namespace App\Http\Controllers;

use App\Excel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excel = Excel::get();
        return view('excel.index', compact('excel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $excel = new \App\Excel();
        $people = \App\People::get()->pluck('name', 'id');
        return view('excel.create', compact('excel', 'people'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $excel = new \App\Excel();
        $people = $request['people'];
        $excel->save();
        $excel->people()->sync($people);
        flash(__('task has been added'))->success();
        return redirect()->route('tasks.index');
    }

    public function generate(Request $request)
    {
        $people = $request['people'];
        $excel = new Excel();
        $excel->save();
        $excel->people()->sync($people);

        $persons = \App\People::find($people);
        $groupPerson = [];
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        foreach($persons as $person) {
            $groupPerson[$person->group->id][] = [
                'personId' => $person->id,
                'personName' => $person->name,
                'groupId' => $person->group->id,
            ];
        }
        $arrCells = [
            1 => 'E',
            2 => 'A',
            3 => 'C',
            4 => 'D',
            5 => 'B',
            6 => 'F'
        ];
        $file1 = '../public/hello world.xlsx';
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file1);
        $worksheet = $spreadsheet->getActiveSheet();
        foreach($groupPerson as $key => $value) {
            foreach ($value as $k => $val) {
                $i =  $k + 1;
                $worksheet->setCellValue($arrCells[$key] . $i , $val['personName']);
            }
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello.xls');

//        $writer = new Xlsx($spreadsheet);
//        $writer->save($file1);
        return redirect()->route('tasks.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function show(Excel $excel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function edit(Excel $excel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Excel $excel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Excel  $excel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Excel $excel)
    {
        //
    }
}
