<?php

namespace App\Http\Controllers\dashboard;

use App\Exports\ProposalsExport;
use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProposalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $proposals = Proposal::get();
        if ($request->ajax()) {
            return view('dashboard.Proposal.table-data', compact('proposals'))->render();
        }
        return view('dashboard.Proposal.index', compact('proposals'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proposal = Proposal::find($id);
        if($proposal) {
            $proposal->delete();
        }
        return redirect()->route('admin.index')->with('success', __('lang.success'));
    }

    public function export()
    {
        return Excel::download(new ProposalsExport, 'Proposals.xlsx');
    }
}
