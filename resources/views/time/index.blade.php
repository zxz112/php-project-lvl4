@extends('layouts.calendar')
@section('content')
    <div class="container">
        <div class="calendar">
            <? $dayNow =  strtotime(date('d.m.Y')) ?>
            @foreach ($period as $day)
                <div class="calendar__date <?if (strtotime($day['date']) == $dayNow) { echo 'calendar__now'; } ?>
                <? if ($day['success']) { echo 'success'; }?>
                <? if ($day['completed']) { echo 'completed'; }?>
                <? if (!$day['completed']) { echo 'no_complete'; }?>">
                    <div class="date">
                        {{$day['date']}}
                    </div>
                    <div class="day-name">
                        {{$day['dayName']}}
                    </div>
                    @if (strtotime($day['date']) == $dayNow && $day['completed'] == false)
                        <form id="submit_day" enctype="multipart/form-data" action="/tms/addday" method="POST">
                            @csrf
                            <div class="check_time">
                                <div class="calendar__time">
                                    <div class="calendar__time_label"> English time </div><input class="calendar__input" name="english" type="text">
                                </div>
                                <div class="calendar__time">
                                    <div class="calendar__time_label"> Learning time</div> <input class="calendar__input" name="learning" type="text">
                                </div>
                            </div>
                            <div class="calendar__gym">
                                Gym <input name="gym" type="checkbox">
                            </div>
                            <input type="hidden" value="{{$day['date']}}" name="date">
                            <div class="calendar__submit">
                                <button>Отправить</button>
                            </div>
                        </form>
                    @elseif($day['completed'] == true)
                        <div class="check_time">
                            <div class="calendar__time">
                                <div class="calendar__time_label"> English time </div><input class="calendar__input" name="en_time" type="text" value="{{$day['english']}}" disabled>
                            </div>
                            <div class="calendar__time">
                                <div class="calendar__time_label"> Learning time</div> <input class="calendar__input" name="learn_time" type="text" value="{{$day['learning']}}" disabled>
                            </div>
                        </div>
                        <div class="calendar__gym">
                            Gym <input name="gym" type="checkbox" <? if ($day['gym'] == 'on') { echo 'checked'; } ?> disabled>
                        </div>
                    @else

                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <script src="{{ asset('js/calendar.js') }}"></script>
@endsection
