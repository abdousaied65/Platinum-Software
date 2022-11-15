<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\BankBuyCash;
use App\Models\BankCash;
use App\Models\BuyBill;
use App\Models\BuyBillReturn;
use App\Models\BuyCash;
use App\Models\Cash;
use App\Models\Company;
use App\Models\Expense;
use App\Models\ExtraSettings;
use App\Models\Gift;
use App\Models\PosOpen;
use App\Models\Quotation;
use App\Models\SaleBill;
use App\Models\SaleBillReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DailyController extends Controller
{
    public function get_daily()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $clients = $company->clients;
        $products = $company->products;
        return view('client.daily.daily', compact('company', 'company_id', 'products', 'clients'));
    }

    public function post_daily(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $clients = $company->clients;
        $products = $company->products;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $gifts = Gift::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $quotations = Quotation::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $saleBills = SaleBill::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $posBills = PosOpen::where('company_id', $company_id)
            ->where('status','done')
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $cashs = Cash::where('company_id', $company_id)
            ->where('amount','>',0)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $borrows = Cash::where('company_id', $company_id)
            ->where('amount','<',0)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $bankcashs = BankCash::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $returns = SaleBillReturn::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $buyBills = BuyBill::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $buyCashs = BuyCash::where('company_id', $company_id)
            ->where('amount','>',0)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $buyBorrows = BuyCash::where('company_id', $company_id)
            ->where('amount','<',0)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $bankbuyCashs = BankBuyCash::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $buyReturns = BuyBillReturn::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();
        $expenses = Expense::where('company_id', $company_id)
            ->whereBetween('created_at', [$from_date, $to_date])->get();

        return view('client.daily.daily',
            compact('company', 'company_id', 'currency', 'products', 'clients', 'gifts',
                'quotations','posBills', 'saleBills', 'cashs','bankcashs','borrows','buyBorrows'
                , 'returns', 'buyBills', 'buyCashs','bankbuyCashs', 'buyReturns', 'expenses'
                , 'from_date', 'to_date'));
    }
}
