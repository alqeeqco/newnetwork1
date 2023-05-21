<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.proposal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'city' => 'required|max:250',
                'fill_name' => 'required|max:250',
                'phone' => 'required|numeric',
                'employer' => 'required|max:250',
                'salary' => 'required|numeric|min:0',
                'job_duration' => 'required|max:250',
                'total_liabilities' => 'required|max:250',
                'agree_terms' => 'required',
            ],[
                'city.required' => __('lang.city_required'),
                'city.max' => __('lang.city_max'),
                'fill_name.required' => __('lang.name_required'),
                'fill_name.max' => __('lang.name_max'),
                'phone.required' => __('lang.phone_required'),
                'phone.numeric' => __('lang.phone_numeric'),
                'employer.required' => __('lang.employer_required'),
                'employer.max   ' => __('lang.employer_max'),
                'salary.required' => __('lang.salary_required'),
                'salary.max' => __('lang.salary_max'),
                'job_duration.required' => __('lang.job_duration_required'),
                'job_duration.max' => __('lang.job_duration_max'),
                'total_liabilities.required' => __('lang.total_liabilities_required'),
                'total_liabilities.max' => __('lang.total_liabilities_max'),
                'agree_terms.required' => __('lang.agree_terms_required'),
                'agree_terms.max' => __('lang.agree_terms_max'),
            ]
        );
        $data = $request->all();
        $data['agree_terms'] = $request->agree_terms == 'ON' ? 1 : 0;
        Proposal::create($data);
        toastr()->success(__('lang.proposal_done'));
        return redirect()->back();
    }
}
