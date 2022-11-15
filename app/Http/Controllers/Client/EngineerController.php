<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Engineer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EngineerController extends Controller
{
    public function index()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $engineers = $company->engineers;
        return view('client.engineers.index', compact('company', 'company_id', 'engineers'));
    }

    public function create()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        return view('client.engineers.create', compact('company_id', 'company'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $engineer = Engineer::create($data);
        return redirect()->route('client.engineers.index')
            ->with('success', 'تم اضافة مهندس الصيانة بنجاح');
    }

    public function edit($id)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $engineer = Engineer::findOrFail($id);
        return view('client.engineers.edit', compact('engineer', 'company_id', 'company'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $engineer = Engineer::findOrFail($id);
        $client_id = Auth::user()->id;
        $input['client_id'] = $client_id;
        $engineer->update($input);
        return redirect()->route('client.engineers.index')
            ->with('success', 'تم تعديل بيانات مهندس الصيانة بنجاح');
    }
    public function destroy(Request $request)
    {
        Engineer::findOrFail($request->engineerid)->delete();
        return redirect()->route('client.engineers.index')
            ->with('success', 'تم حذف مهندس الصيانة بنجاح');
    }
}
