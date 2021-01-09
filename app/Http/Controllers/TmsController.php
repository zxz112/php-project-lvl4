<?php

namespace App\Http\Controllers;

use App\Tms;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use function Matrix\trace;

class TmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = [
            'Понедельник',
            'Вторник',
            'Среда',
            'Четверг',
            'Пятница',
            'Суббота',
            'Воскресенье',
            ];
        $dates = CarbonPeriod::create('2021-01-01', '2021-02-11');
        $completedDays = Tms::get();
        $period = [];
        foreach ($dates as $day) {
            foreach ($completedDays as $complete) {
                if ($complete['date'] == $day->format('d.m.Y')) {
                    $period[$day->format('Y-m-d')] = [
                        'date' => $day->format('d.m.Y'),
                        'english' => $complete->english,
                        'learning' => $complete->learning,
                        'gym' => $complete->gym,
                        'completed' => true,
                        'dayName' => $days[$day->dayOfWeekIso - 1]
                    ];
                    if ($complete->english >= 1 && $complete->learning >= 1) {
                        $period[$day->format('Y-m-d')]['success'] = true;
                    } else {
                        $period[$day->format('Y-m-d')]['success'] = false;
                    }
                }
            }
            if (!array_key_exists($day->format('Y-m-d'), $period)) {
                $period[$day->format('Y-m-d')] = [
                    'date' => $day->format('d.m.Y'),
                    'english' => '',
                    'learning' => '',
                    'gym' => '',
                    'completed' => false,
                    'success' => false,
                    'dayName' => $days[$day->dayOfWeekIso - 1]
                ];
            }
        }
        return view('time.index', compact('period'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        print_r($request);
    }

    public function addday()
    {
        $tms = new \App\Tms();
        unset($_REQUEST['_token']);
        print_r($_REQUEST);
        if (!array_key_exists('gym', $_REQUEST)) {
            $_REQUEST['gym'] = 'off';
        }
        $tms->fill($_REQUEST);
        $tms->save();
        return redirect()->route('tms.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Tms  $tms
     * @return \Illuminate\Http\Response
     */
    public function show(Tms $tms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tms  $tms
     * @return \Illuminate\Http\Response
     */
    public function edit(Tms $tms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tms  $tms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tms $tms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tms  $tms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tms $tms)
    {
        //
    }
}
