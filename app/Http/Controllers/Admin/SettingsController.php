<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FacilityDetail;
use App\Models\ProviderDetail;
use App\Models\PayerDetail;
use App\Models\CptCode;
use App\Models\DiagnosisCode;


class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('roles:admin');
    // }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function administration()
    {
        return view('admin.settings.administration');
    }
    public function dxicdSetup()
    {
        $cpt = CptCode::where('status', '=', '1')->orderBy('id', 'desc')->get();
        $diagnosis = DiagnosisCode::where('status', '=', '1')->orderBy('id', 'desc')->get();
        return view('admin.settings.dxicd-setup', compact('cpt', 'diagnosis'));
    }
    public function interfaceSetup()
    {
        return view('admin.settings.interface-setup');
    }
    public function payerSetup()
    {
        $payers = PayerDetail::where('status', '=', '1')->orderBy('id', 'desc')->get();
        return view('admin.settings.payer-setup', compact('payers'));
    }
    public function practiceReferences()
    {
        return view('admin.settings.practice-references');
    }
    public function practiceSetup()
    {
        $facilities = FacilityDetail::where('is_deleted', '=', '0')->orderBy('id', 'desc')->get();
        // dd($facilities);
        return view('admin.settings.practice-setup', compact('facilities'));
    }
    public function createPracticeSetup()
    {
        return view('admin.settings.create-practice-setup');
    }
    public function createProvider()
    {
        return view('admin.settings.create-provider');
    }
    public function practiceStore(Request $request)
    {
        $input = $request->all();
        $uid = Auth::user()->id;
        $saveFacility = new FacilityDetail;
        $saveFacility->group_name = $input['group_name'];
        $saveFacility->group_npi = $input['group_npi'];
        $saveFacility->group_taxid = $input['group_taxid'];
        $saveFacility->group_ptan = $input['group_ptan'];
        $saveFacility->group_phone = $input['group_phone'];
        $saveFacility->group_fax = $input['group_fax'];
        $saveFacility->address1 = $input['address1'];
        $saveFacility->address2 = $input['address2'];
        $saveFacility->city = $input['city'];
        $saveFacility->state = $input['state'];
        $saveFacility->postcode = $input['postcode'];
        $saveFacility->active = '1';
        $saveFacility->created_by = $uid;
        $saveFacility->is_deleted = '0';
        $saveFacility->save();
        // return view('admin.settings.practice-setup')
        return redirect()->route('settings.practice-setup')->with('success', 'Prctice saved successfully!');;
    }
    public function providerStore(Request $request)
    {
        $input = $request->all();
        // dd($request->setup_options);
        $uid = Auth::user()->id;
        $saveProvider = new ProviderDetail;
        $saveProvider->provider_first_name = $input['provider_first_name'];
        $saveProvider->provider_last_name = $input['provider_last_name'];
        $saveProvider->caqh_id = $input['caqh_id'];
        $saveProvider->status = $input['status'];
        $saveProvider->role = $input['role'];
        $saveProvider->speciality = $input['speciality'];
        $saveProvider->degree = $input['degree'];
        $saveProvider->individual_npi = $input['individual_npi'];
        $saveProvider->setup_options = $request->setup_options;
        $saveProvider->created_by = $uid;
        $saveProvider->is_deleted = '0';
        $saveProvider->save();
        return redirect()->route('settings.provider-setup')->with('success', 'Provider saved successfully!');
    }
    public function printSetup()
    {
        return view('admin.settings.print-setup');
    }
    public function providerSetup()
    {
        $providers = ProviderDetail::where('is_deleted', '=', '0')->orderBy('id', 'desc')->get();
        return view('admin.settings.provider-setup', compact('providers'));
    }
    public function statementSetup()
    {
        return view('admin.settings.statement-setup');
    }
    public function userSetup()
    {
        return view('admin.settings.user-setup');
    }
}
