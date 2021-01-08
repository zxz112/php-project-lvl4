<?php

namespace App\ExcelGenerate;

use App\Excel;

class ExcelGenerate
{
    public function __construct($idExcel)
    {
        $this->idExcel = $idExcel;
    }

    public function getData() {
        $excel = Excel::get($this->idExcel);
        $peoples = $excel->people;
        $groupPerson = [];
        foreach($peoples as $person) {
            $groupPerson[$person->group->id] = [
                'personId' => $person->id,
                'personName' => $person->name,
                'groupId' => $person->group->id,
            ];
        }

    }

}
