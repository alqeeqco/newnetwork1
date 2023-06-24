<?php

namespace App\Exports;

use App\Models\Proposal;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProposalsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $proposals = Proposal::select(
            'id',
            'city',
            'fill_name',
            'phone',
            'employer',
            'salary',
            'job_duration',
            'total_liabilities',
            'agree_terms',
            'email',
            'created_at',
        )->orderBy('id', 'desc')->get();

        $data = [];

        foreach ($proposals as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['fill_name'] = $value->fill_name;
            $data[$key]['phone'] = $value->phone;
            $data[$key]['email'] = $value->email;
            $data[$key]['city'] = $value->city;
            $data[$key]['employer'] = $value->employer;
            $data[$key]['salary'] = $value->salary;
            // $data[$key]['job_duration'] = $value->job_duration;
            $data[$key]['total_liabilities'] = $value->total_liabilities;
            $data[$key]['agree_terms'] = $value->agree_terms;
            $data[$key]['created_at'] = Carbon::parse($value->created_at)->format('Y/m/d H:i:s');
        }

        array_unshift($data, [
            'id' => '#',
            'fill_name' => 'الأٍسم بالكامل',
            'phone' => 'رقم الهاتف',
            'email' => 'البريد الإلكتروني',
            'city' => 'المدينة',
            'employer' => 'الوظيفة',
            'salary' => 'الرتب',
            'total_liabilities' => 'الألتزامات الشهرية',
            'agree_terms' => 'الموافقة ع شروط الأستخدام',
            'created_at' => 'تاريخ الإنشاء',
        ]);
        $data = collect($data);
        return $data;
    }
}
