<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CompanySettingController extends Controller
{
    public function index()
    {
        $company = session()->get('company');
        return view('user.company-setting.index', compact('company'));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'business_type' => 'required',
        ]);
        $data = Arr::except($request->all(), '_token');
        $currentCompany = session()->get('company');
        $currentCompany->update($data);
        Company::find($currentCompany->id)->update($data);
        return redirect()->back()->with('success', 'Company info updated successfully');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $data = Arr::except($request->all(), '_token');
        if ($request->status === "Dalam Negeri") {
            $data = Arr::add($data, 'country', 'Indonesia');
        }
        $currentCompany = session()->get('company');
        $currentCompany->update($data);
        Company::find($currentCompany->id)->update($data);
        return redirect()->back()->with('success', 'Company status updated successfully');
    }

    public function destroy()
    {
        $currentCompany = session()->get('company');
        $currentCompany->delete();
        return redirect()->route('list-company')->with('success', 'Company deleted successfully');
    }
}
