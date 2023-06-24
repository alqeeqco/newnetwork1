<?php

namespace App\Exports;

use App\Models\Appointment;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class AppointmentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $appointments = Appointment::select(
            'id',
            'branch',
            'call_date',
            'phone_nmuber',
            'created_at',
        )->orderBy('id', 'desc')->get();

        $data = [];

        foreach ($appointments as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['branch'] = $value->branch;
            $data[$key]['call_date'] = $value->call_date;
            $data[$key]['phone_nmuber'] = $value->phone_nmuber;
            $data[$key]['created_at'] = Carbon::parse($value->created_at)->format('Y/m/d H:i:s');
        }

        array_unshift($data, [
            'id' => '#',
            'branch' => 'الفرع',
            'call_date' => 'وقت الأتصال',
            'phone_nmuber' => 'رقم الهاتف',
            'created_at' => 'تاريخ الإنشاء',
        ]);
        $data = collect($data);
        return $data;
    }
}
