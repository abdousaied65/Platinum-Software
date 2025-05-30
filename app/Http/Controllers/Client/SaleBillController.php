<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\sendingSaleBill;
use App\Models\Bank;
use App\Models\BankCash;
use App\Models\Branch;
use App\Models\Client;
use App\Models\OuterClient;
use App\Models\ProductSerial;
use App\Models\ProductUnit;
use App\Models\SaleBillReturn;
use App\Models\Cash;
use App\Models\Company;
use App\Models\ExtraSettings;
use App\Models\Product;
use App\Models\Safe;
use App\Models\SaleBill;
use App\Models\SaleBillElement;
use App\Models\SaleBillExtra;
use App\Models\SaleSerial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SaleBillController extends Controller
{
    public function add_serials(Request $request)
    {
        $product_unit_id = $request->product_unit_id;
        $element_id = $request->element_id;
        $element = SaleBillElement::FindOrFail($element_id);
        $sale_bill = $element->SaleBill;
        $sale_bill_id = $sale_bill->id;
        $quantity = $request->quantity;
        $serials = $element->serials;
        $old_serials = array();
        foreach ($serials as $serial) {
            array_push($old_serials, $serial->serial_number);
        }
        echo '<form id="myForm" method="POST" action="/client/save-serials-sales" target="_blank">';
        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        echo '<input type="hidden" name = "product_unit_id" value="' . $product_unit_id . '" /> ';
        echo '<input type="hidden" name = "sale_element_id" value="' . $element_id . '" /> ';
        echo '<input type="hidden" name = "sale_bill_id" value="' . $sale_bill_id . '" /> ';
        echo '<input type="hidden" name = "quantity" value="' . $quantity . '"  /> ';
        if ($serials->isEmpty()) {
            for ($i = 0; $i < $quantity; $i++) {
                $counter = $i + 1;
                echo '
            <div class="form-group pull-right col-lg-3 col-xs-6">
                <label for="serials"> رقم السيريال # ' . $counter . ' </label>
                <input required type="text" class="form-control text-left serial" dir="ltr" name="serials[]" />
            </div>';
            }
        } else {
            for ($i = 0; $i < $quantity; $i++) {
                $counter = $i + 1;
                if (empty($old_serials[$i])) {
                    echo '
                    <div class="form-group pull-right col-lg-3 col-xs-6">
                        <label for="serials"> رقم السيريال # ' . $counter . ' </label>
                        <input required type="text" class="form-control text-left serial" dir="ltr" name="serials[]" />
                    </div>';
                } else {
                    echo '
                    <div class="form-group pull-right col-lg-3 col-xs-6">
                        <label for="serials"> رقم السيريال # ' . $counter . ' </label>
                        <input required type="text" class="form-control text-left serial" value="' . $old_serials[$i] . '" dir="ltr" name="serials[]" />
                    </div>';
                }
            }
        }
        echo "<div class='clearfix'></div>";
        echo "<div class='col-lg-12'>";
        echo '<button id="save_serials" type="submit" class="btn btn-success">
		        <i class="fa fa-save"></i> حفظ </button></div>';
        echo '</form>';
        echo "<script>
        $('.serial').keypress(function(e){
            if (e.which == 13) return false;
            if (e.which == 13) e.preventDefault();
        });
        $('#myForm').on('submit', function () {
            $('#modaldemo100').modal('toggle');
        });
        </script>";
    }

    public function save_serials(Request $request)
    {
        $serials = $request->serials;
        $quantity = $request->quantity;
        $company_id = Auth::user()->company_id;
        $client_id = Auth::user()->id;
        $product_unit_id = $request->product_unit_id;
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $product_id = $product_unit->product->id;
        $sale_bill_id = $request->sale_bill_id;
        $sale_element_id = $request->sale_element_id;
        $sale_element = SaleBillElement::FindOrFail($sale_element_id);
        $old_serials = $sale_element->serials;
        if (!$old_serials->isEmpty()) {
            foreach ($old_serials as $old_serial) {
                $old_serial->delete();
            }
        }
        for ($i = 0; $i < $quantity; $i++) {
            $sale_serial = SaleSerial::create([
                'company_id' => $company_id,
                'client_id' => $client_id,
                'product_unit_id' => $product_unit_id,
                'sale_bill_id' => $sale_bill_id,
                'sale_element_id' => $sale_element_id,
                'serial_number' => $serials[$i],
            ]);
            $product_serial = ProductSerial::where('company_id', $company_id)
                ->where('client_id', $client_id)
                ->where('product_id', $product_id)
                ->where('product_unit_id', $product_unit_id)
                ->where('serial_number', $serials[$i])
                ->first();
            $product_serial->delete();
        }
        echo "<script>window.close();</script>";
    }

    public function index()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        $outer_clients = $company->outerClients;
        $products = $company->products;
        return view('client.sale_bills.index', compact('company', 'products', 'company_id', 'outer_clients', 'sale_bills'));
    }

    public function create()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $categories = $company->categories;
        $user = Client::FindOrFail($client_id);
        if (!empty($user->branch_id)) {
            $branch = Branch::FindOrFail($user->branch_id);
            $stores = $branch->stores;
            $all_products = Product::where('company_id', $company_id)
                ->whereIn('store_id', $stores)
                ->get();
        } else {
            $stores = $company->stores;
            $all_products = $company->products;
        }
        $units = $company->units;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $outer_clients = OuterClient::where('company_id', $company_id)->get();
        $check = SaleBill::all();
        if ($check->isEmpty()) {
            $pre_bill = 1;
        } else {
            $old_pre_bill = SaleBill::max('sale_bill_number');
            $pre_bill = ++$old_pre_bill;
        }
        $check = Cash::all();
        if ($check->isEmpty()) {
            $pre_cash = 1;
        } else {
            $old_cash = Cash::max('cash_number');
            $pre_cash = ++$old_cash;
        }
        $safes = $company->safes;
        $banks = $company->banks;

        $user = Auth::user();
        $type_name = $user->company->subscription->type->type_name;
        if ($type_name == "تجربة") {
            $bills_count = "غير محدود";
        } else {
            $bills_count = $user->company->subscription->type->package->bills_count;
        }
        $company_bills_count = $company->sale_bills->count();
        if ($bills_count == "غير محدود") {
            $step = SaleBill::where('company_id', $company_id)
                ->where('client_id', $client_id)
                ->where('status', 'open')
                ->first();
            if (!empty($step)) {
                $open_sale_bill = $step;
                $sale_bill_cash = Cash::where('bill_id', $step->sale_bill_number)
                    ->get();
                $sale_bill_bank_cash = BankCash::where('bill_id', $step->sale_bill_number)
                    ->get();
                return view('client.sale_bills.create',
                    compact('company', 'sale_bill_cash', 'units', 'sale_bill_bank_cash', 'open_sale_bill', 'pre_cash', 'stores', 'safes', 'banks', 'outer_clients', 'categories', 'extra_settings'
                        , 'company_id', 'all_products', 'pre_bill'));
            } else {
                $open_sale_bill = "";
                return view('client.sale_bills.create',
                    compact('company', 'open_sale_bill', 'units', 'pre_cash', 'stores', 'safes', 'banks', 'outer_clients', 'categories', 'extra_settings'
                        , 'company_id', 'all_products', 'pre_bill'));

            }
        } else {
            if ($bills_count > $company_bills_count) {
                $step = SaleBill::where('company_id', $company_id)
                    ->where('client_id', $client_id)
                    ->where('status', 'open')
                    ->first();
                if (!empty($step)) {
                    $open_sale_bill = $step;
                    $sale_bill_cash = Cash::where('bill_id', $step->sale_bill_number)
                        ->get();
                    $sale_bill_bank_cash = BankCash::where('bill_id', $step->sale_bill_number)
                        ->get();
                    return view('client.sale_bills.create',
                        compact('company', 'sale_bill_cash', 'units', 'sale_bill_bank_cash', 'open_sale_bill', 'pre_cash', 'stores', 'safes', 'banks', 'outer_clients', 'categories', 'extra_settings'
                            , 'company_id', 'all_products', 'pre_bill'));
                } else {
                    $open_sale_bill = "";
                    return view('client.sale_bills.create',
                        compact('company', 'open_sale_bill', 'units', 'pre_cash', 'stores', 'safes', 'banks', 'outer_clients', 'categories', 'extra_settings'
                            , 'company_id', 'all_products', 'pre_bill'));

                }
            } else {
                return redirect()->route('client.home')->with('error', 'باقتك الحالية لا تسمح بالمزيد من فواتير المبيعات');
            }
        }
    }

    public function store_cash_outer_clients(Request $request)
    {
        $this->validate($request, [
            'cash_number' => 'required',
//            'outer_client_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $data = $request->all();
        $company_id = $data['company_id'];
        $data['client_id'] = Auth::user()->id;
        $amount = $data['amount'];
        $bill_id = $request->bill_id;
        $sale_bill = SaleBill::where('sale_bill_number', $bill_id)->first();
        $outer_client_id = $data['outer_client_id'];
        if (!empty($sale_bill->outer_client_id)) {
            $outer_client = OuterClient::FindOrFail($outer_client_id);
            $balance_before = $outer_client->prev_balance;
            $balance_after = $balance_before - $amount;
            $data['balance_before'] = $balance_before;
            $data['balance_after'] = $balance_after;
        } else {
            $data['balance_before'] = 0;
            $data['balance_after'] = 0;
        }

        $payment_method = $data['payment_method'];
        if ($payment_method == "cash") {
            $check = Cash::where('bill_id', $request->bill_id)
                ->where('company_id', $company_id)
                ->where('client_id', $data['client_id'])
                ->where('outer_client_id', $outer_client_id)
                ->first();
            if (empty($check)) {
                $cash = Cash::create($data);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'غير مسموح لك .. تم الدفع من قبل'
                ]);
            }
        } else {
            $check = BankCash::where('bill_id', $request->bill_id)
                ->where('company_id', $company_id)
                ->where('client_id', $data['client_id'])
                ->where('outer_client_id', $outer_client_id)
                ->first();
            if (empty($check)) {
                $cash = BankCash::create($data);
            } else {
                return response()->json([
                    'status' => true,
                    'msg' => 'غير مسموح لك .. تم الدفع من قبل'
                ]);
            }
        }
        if ($cash) {
            if ($payment_method == "cash") {
                $pay_method = 'دفع نقدى كاش ';
            } elseif ($payment_method == "bank") {
                $pay_method = 'دفع بنكى شبكة ';
            }
            $button = '<button type="button" payment_method="' . $payment_method . '" cash_id="' . $cash->id . '"
                class="btn btn-danger delete_pay pull-left"> حذف </button> ';
            $clear = '<div class="clearfix"></div>';

            return response()->json([
                'status' => true,
                'msg' => ' تم تسجيل الدفع بنجاح ' . " ( " . $pay_method . " ) " . " المبلغ : " . $amount . $button . $clear,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'هناك خطأ فى تسجيل الدفع النقدى حاول مرة اخرى',
            ]);
        }
    }

    public function pay_delete(Request $request)
    {
        $payment_method = $request->payment_method;
        $cash_id = $request->cash_id;
        if ($payment_method == "cash") {
            $cash = Cash::FindOrFail($cash_id);
            $cash->delete();
        } elseif ($payment_method == "bank") {
            $cash = BankCash::FindOrFail($cash_id);
            $cash->delete();
        }
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $data['client_id'] = Auth::user()->id;
        $data['status'] = 'open';
        $SaleBill = SaleBill::where('sale_bill_number', $data['sale_bill_number'])->first();
        if (empty($SaleBill)) {
            $SaleBill = SaleBill::create($data);
        } else {
            $SaleBill->update($data);
        }
        $data['sale_bill_id'] = $SaleBill->id;
        $data['company_id'] = $company->id;
        $product_unit_id = $request->product_unit_id;
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $check = SaleBillElement::where('sale_bill_id', $SaleBill->id)
            ->where('product_id', $request->product_id)
            ->where('product_unit_id', $product_unit->id)
            ->where('company_id', $company->id)
            ->first();
        if (empty($check)) {
            $sale_bill_element = SaleBillElement::create($data);
        } else {
            $old_quantity = $check->quantity;
            $new_quantity = $old_quantity + $request->quantity;
            $product_price = $request->product_price;
            $new_quantity_price = $new_quantity * $product_price;
            $sale_bill_element = $check->update([
                'product_price' => $product_price,
                'quantity' => $new_quantity,
                'product_unit_id' => $product_unit_id,
                'quantity_price' => $new_quantity_price,
            ]);
        }

        if ($SaleBill && $sale_bill_element) {
            $all_elements = SaleBillElement::where('sale_bill_id', $SaleBill->id)->get();
            return response()->json([
                'status' => true,
                'msg' => 'تمت الاضافة الى الفاتورة بنجاح',
                'all_elements' => $all_elements,
            ]);
        } else {
            $all_elements = SaleBillElement::where('sale_bill_id', $SaleBill->id)->get();
            return response()->json([
                'status' => false,
                'msg' => 'هناك خطأ فى عملية الاضافة',
                'all_elements' => $all_elements,
            ]);
        }
    }

    public function saveAll(Request $request)
    {
        $data = $request->all();
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $sale_bill = SaleBill::where('sale_bill_number', $request->sale_bill_number)->first();
        $elements = $sale_bill->elements;
        foreach ($elements as $element) {
            $product = Product::FindOrFail($element->product_id);
            $product_unit = $element->unit;
            $old_product_balance = $product_unit->first_balance;
            $new_product_balance = $old_product_balance - $element->quantity;
            $product_unit->update([
                'first_balance' => $new_product_balance
            ]);
        }
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);
        $previous_extra = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
            ->where('action', 'extra')->first();
        if (!empty($previous_extra)) {
            $previous_extra_type = $previous_extra->action_type;
            $previous_extra_value = $previous_extra->value;
            if ($previous_extra_type == "percent") {
                $previous_extra_value = $previous_extra_value / 100 * $total;
            }
            $after_discount = $total + $previous_extra_value;
        }
        $previous_discount = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
            ->where('action', 'discount')->first();
        if (!empty($previous_discount)) {
            $previous_discount_type = $previous_discount->action_type;
            $previous_discount_value = $previous_discount->value;
            if ($previous_discount_type == "percent") {
                $previous_discount_value = $previous_discount_value / 100 * $total;
            }
            $after_discount = $total - $previous_discount_value;

        }
        if (!empty($previous_extra) && !empty($previous_discount)) {
            $after_discount = $total - $previous_discount_value + $previous_extra_value;
        } else {
            $after_discount = $total;
        }
        if (isset($after_discount) && $after_discount != 0) {
            $percentage = ($tax_value_added / 100) * $after_discount;
            $after_total_all = $after_discount + $percentage;
        } else {
            $percentage = ($tax_value_added / 100) * $total;
            $after_total_all = $total + $percentage;
        }
        $cash = Cash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($cash)) {
            $amount = $cash->amount;
            $rest = $after_total_all - $amount;
            if (!empty($sale_bill->outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($sale_bill->outer_client_id);
                $balance_before = $outer_client->prev_balance;
                $balance_after = $balance_before + $rest;
                $outer_client->update([
                    'prev_balance' => $balance_after
                ]);
            }

            $safe_id = $cash->safe_id;
            $safe = Safe::FindOrFail($safe_id);
            $safe_balance_before = $safe->balance;
            $safe_balance_after = $safe_balance_before + $amount;
            $safe->update([
                'balance' => $safe_balance_after
            ]);
            $sale_bill->update([
                'status' => 'done',
                'paid' => $amount,
                'rest' => $rest,
            ]);
        }
        $bank_cash = BankCash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($bank_cash)) {
            $amount = $bank_cash->amount;
            $rest = $after_total_all - $amount;
            if (!empty($sale_bill->outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($sale_bill->outer_client_id);
                $balance_before = $outer_client->prev_balance;
                $balance_after = $balance_before + $rest;
                $outer_client->update([
                    'prev_balance' => $balance_after
                ]);
            }
            $bank_id = $bank_cash->bank_id;
            $bank = Bank::FindOrFail($bank_id);
            $bank_balance_before = $bank->bank_balance;
            $bank_balance_after = $bank_balance_before + $amount;
            $bank->update([
                'bank_balance' => $bank_balance_after
            ]);
            $sale_bill->update([
                'status' => 'done',
                'paid' => $amount,
                'rest' => $rest,
            ]);
        }

        if (empty($bank_cash) && empty($cash)) {
            $rest = $after_total_all;
            if (!empty($sale_bill->outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($sale_bill->outer_client_id);
                $balance_before = $outer_client->prev_balance;
                $balance_after = $balance_before + $rest;
                $outer_client->update([
                    'prev_balance' => $balance_after
                ]);
            }
            $sale_bill->update([
                'status' => 'done',
                'paid' => '0',
                'rest' => $rest,
            ]);
        }
    }

    public function send($id)
    {
        $sale_bill = SaleBill::where('sale_bill_number', $id)->first();
        $url = 'https://' . request()->getHttpHost() . '/sale-bills/print/' . $id;
        $data = array(
            'body' => 'بيانات الفاتورة ',
            'url' => $url,
            'subject' => 'مرفق مع هذه الرسالة بيانات تفصيلية للفاتورة ',
        );
        Mail::to($sale_bill->outerClient->client_email)->send(new sendingSaleBill($data));
        return redirect()->route('client.sale_bills.index')
            ->with('success', 'تم ارسال فاتورة البيع الى بريد العميل بنجاح');
    }

    public function show($id)
    {
        dd($id);
    }

    public function destroy(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $sale_bill_number = $request->sale_bill_number;
        $sale_bill = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        $sale_bill->elements()->delete();
        $sale_bill->extras()->delete();
        $cash = Cash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($cash)) {
            $cash->delete();
        }
        $cash = BankCash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($cash)) {
            $cash->delete();
        }
        $sale_bill->delete();
        return redirect()->route('client.sale_bills.create')
            ->with('success', 'تم حذف الفاتورة  بنجاح');
    }

    public function delete_bill(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $bill_id = $request->billid;
        $sale_bill = SaleBill::FindOrFail($bill_id);
        $elements = $sale_bill->elements;
        $extras = $sale_bill->extras;
        $final_total = $sale_bill->final_total;
        $paid = $sale_bill->paid;
        $rest = $sale_bill->rest;

        foreach ($elements as $element) {
            $quantity = $element->quantity;
            $product_id = $element->product_id;
            $product = Product::FindOrFail($product_id);
            $product_unit = $element->unit;
            $prev_balance = $product_unit->first_balance;
            $curr_balance = $prev_balance + $quantity;
            $product_unit->update([
                'first_balance' => $curr_balance
            ]);
        }

        $sale_bill->elements()->delete();
        $sale_bill->extras()->delete();
        $cash = Cash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($cash)) {
            $safe_id = $cash->safe_id;
            $safe = Safe::FindOrFail($safe_id);
            $safe_balance_before = $safe->balance;
            $safe_balance_after = $safe_balance_before - $cash->amount;
            $safe->update([
                'balance' => $safe_balance_after
            ]);

            $cash->delete();
        }
        $bank_cash = BankCash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($bank_cash)) {
            $bank_id = $bank_cash->bank_id;
            $bank = Bank::FindOrFail($bank_id);
            $bank_balance_before = $bank->bank_balance;
            $bank_balance_after = $bank_balance_before - $bank_cash->amount;
            $bank->update([
                'bank_balance' => $bank_balance_after
            ]);
            $bank_cash->delete();
        }
        if (!empty($sale_bill->outer_client_id)) {
            $outer_client = OuterClient::FindOrFail($sale_bill->outer_client_id);
            $balance_before = $outer_client->prev_balance;
            $balance_after = $balance_before - $rest;
            $outer_client->update([
                'prev_balance' => $balance_after
            ]);
        }

        $sale_bill->delete();
        return redirect()->route('client.sale_bills.index')
            ->with('success', 'تم حذف الفاتورة  بنجاح');
    }

    public function edit_element(Request $request)
    {
        $element = SaleBillElement::FindOrFail($request->element_id);
        $product_id = $element->product_id;
        $product_price = $element->product_price;
        $quantity = $element->quantity;
        $quantity_price = $element->quantity_price;
        $product_unit_id = $element->product_unit_id;
        return response()->json([
            'product_id' => $product_id,
            'product_price' => $product_price,
            'quantity' => $quantity,
            'quantity_price' => $quantity_price,
            'product_unit_id' => $product_unit_id,
        ]);
    }

    public function edit($id)
    {
        $company_id = Auth::user()->company_id;
        $bill_id = $id;
        $sale_bill = SaleBill::FindOrFail($bill_id);
        $elements = $sale_bill->elements;
        $extras = $sale_bill->extras;
        $final_total = $sale_bill->final_total;
        $paid = $sale_bill->paid;
        $rest = $sale_bill->rest;
        foreach ($elements as $element) {
            $quantity = $element->quantity;
            $product_id = $element->product_id;
            $product = Product::FindOrFail($product_id);
            $product_unit = $element->unit;
            $prev_balance = $product_unit->first_balance;
            $curr_balance = $prev_balance + $quantity;
            $product_unit->update([
                'first_balance' => $curr_balance
            ]);
        }
        $cash = Cash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($cash)) {
            $safe_id = $cash->safe_id;
            $safe = Safe::FindOrFail($safe_id);
            $safe_balance_before = $safe->balance;
            $safe_balance_after = $safe_balance_before - $cash->amount;
            $safe->update([
                'balance' => $safe_balance_after
            ]);
        }
        $bank_cash = BankCash::where('bill_id', $sale_bill->sale_bill_number)
            ->where('company_id', $company_id)
            ->where('client_id', $sale_bill->client_id)
            ->where('outer_client_id', $sale_bill->outer_client_id)
            ->first();
        if (!empty($bank_cash)) {
            $bank_id = $bank_cash->bank_id;
            $bank = Bank::FindOrFail($bank_id);
            $bank_balance_before = $bank->bank_balance;
            $bank_balance_after = $bank_balance_before - $bank_cash->amount;
            $bank->update([
                'bank_balance' => $bank_balance_after
            ]);
        }
        if (!empty($sale_bill->outer_client_id)) {
            $outer_client = OuterClient::FindOrFail($sale_bill->outer_client_id);
            $balance_before = $outer_client->prev_balance;
            $balance_after = $balance_before - $rest;
            $outer_client->update([
                'prev_balance' => $balance_after
            ]);
        }

        $sale_bill->update([
            'status' => 'open'
        ]);
        return redirect()->route('client.sale_bills.create');
    }

    public function filter_code(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = $company->products;
        $sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        $outer_clients = $company->outerClients;

        $product_id = $request->code_universal;
        $product_k = Product::FindOrFail($product_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $sale_bill_elements = SaleBillElement::where('product_id', $product_k->id)->get();
        $arr = array();
        foreach ($sale_bill_elements as $sale_bill_element) {
            $sale_bill = $sale_bill_element->SaleBill;
            $sale_bill_id = $sale_bill->id;
            array_push($arr, $sale_bill_id);
        }
        $my_array = array_unique($arr);
        $product_sale_bills = SaleBill::whereIn('id', $my_array)->get();
        return view('client.sale_bills.index', compact('currency', 'product_k', 'products', 'product_sale_bills', 'sale_bills', 'outer_clients', 'company'));
    }

    public function filter_product(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = $company->products;
        $sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        $outer_clients = $company->outerClients;

        $product_id = $request->product_name;
        $product_k = Product::FindOrFail($product_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $sale_bill_elements = SaleBillElement::where('product_id', $product_k->id)->get();
        $arr = array();
        foreach ($sale_bill_elements as $sale_bill_element) {
            $sale_bill = $sale_bill_element->SaleBill;
            $sale_bill_id = $sale_bill->id;
            array_push($arr, $sale_bill_id);
        }
        $my_array = array_unique($arr);
        $product_sale_bills = SaleBill::whereIn('id', $my_array)->get();
        return view('client.sale_bills.index', compact('currency', 'product_k', 'products', 'product_sale_bills', 'sale_bills', 'outer_clients', 'company'));
    }

    public function filter_all(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = $company->products;
        $sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        $outer_clients = $company->outerClients;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $all_sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        return view('client.sale_bills.index', compact('currency', 'products', 'all_sale_bills', 'sale_bills', 'outer_clients', 'company'));
    }

    public function filter_outer_client(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);

        $products = $company->products;
        $sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        $outer_clients = $company->outerClients;

        $outer_client_id = $request->outer_client_id;
        $outer_client_k = OuterClient::FindOrFail($outer_client_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $outer_client_sale_bills = SaleBill::where('outer_client_id', $outer_client_k->id)->get();

        return view('client.sale_bills.index', compact('currency', 'products', 'outer_client_k', 'outer_client_sale_bills', 'sale_bills', 'outer_clients', 'company'));
    }

    public function filter_key(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);

        $products = $company->products;
        $sale_bills = SaleBill::where('company_id', $company_id)->where('status', 'done')->get();
        $outer_clients = $company->outerClients;

        $sale_bill_id = $request->sale_bill_id;
        $sale_bill_number = $request->sale_bill_number;

        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        if (!empty($sale_bill_id)) {
            $sale_bill_k = SaleBill::FindOrFail($sale_bill_id);
        } else {
            $sale_bill_k = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        }
        if (!empty($sale_bill_k)) {
            $cash = Cash::where('bill_id', $sale_bill_k->sale_bill_number)
                ->where('company_id', $company_id)
                ->where('client_id', $sale_bill_k->client_id)
                ->where('outer_client_id', $sale_bill_k->outer_client_id)
                ->first();

            $elements = $sale_bill_k->elements;
            $extras = $sale_bill_k->extras;
            foreach ($extras as $key) {
                if ($key->action == "discount") {
                    if ($key->action_type == "pound") {
                        $sale_bill_discount_value = $key->value;
                        $sale_bill_discount_type = "pound";
                    } else {
                        $sale_bill_discount_value = $key->value;
                        $sale_bill_discount_type = "percent";
                    }
                } else {
                    if ($key->action_type == "pound") {
                        $sale_bill_extra_value = $key->value;
                        $sale_bill_extra_type = "pound";
                    } else {
                        $sale_bill_extra_value = $key->value;
                        $sale_bill_extra_type = "percent";
                    }
                }
            }
            if ($extras->isEmpty()) {
                $sale_bill_discount_value = 0;
                $sale_bill_extra_value = 0;
                $sale_bill_discount_type = "pound";
                $sale_bill_extra_type = "pound";
            }
            $tax_value_added = $company->tax_value_added;
            $sum = array();
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);

            $previous_extra = SaleBillExtra::where('sale_bill_id', $sale_bill_k->id)
                ->where('action', 'extra')->first();
            if (!empty($previous_extra)) {
                $previous_extra_type = $previous_extra->action_type;
                $previous_extra_value = $previous_extra->value;
                if ($previous_extra_type == "percent") {
                    $previous_extra_value = $previous_extra_value / 100 * $total;
                }
                $after_discount = $total + $previous_extra_value;
            }


            $previous_discount = SaleBillExtra::where('sale_bill_id', $sale_bill_k->id)
                ->where('action', 'discount')->first();
            if (!empty($previous_discount)) {
                $previous_discount_type = $previous_discount->action_type;
                $previous_discount_value = $previous_discount->value;
                if ($previous_discount_type == "percent") {
                    $previous_discount_value = $previous_discount_value / 100 * $total;
                }
                $after_discount = $total - $previous_discount_value;

            }
            if (!empty($previous_extra) && !empty($previous_discount)) {
                $after_discount = $total - $previous_discount_value + $previous_extra_value;
            } else {
                $after_discount = $total;
            }

            if (isset($after_discount) && $after_discount != 0) {
                $percentage = ($tax_value_added / 100) * $after_discount;
                $after_total_all = $after_discount + $percentage;
            } else {
                $percentage = ($tax_value_added / 100) * $total;
                $after_total_all = $total + $percentage;
            }
            return view('client.sale_bills.index',
                compact('currency', 'after_discount', 'after_total_all', 'sale_bill_k', 'sale_bills', 'outer_clients'
                    , 'elements', 'extras', 'products', 'cash', 'company', 'sale_bill_discount_value', 'sale_bill_discount_type', 'sale_bill_extra_value', 'sale_bill_extra_type'));
        } else {
            return redirect()->route('client.sale_bills.index')->with('error', 'لا يوجد فاتورة بهذا الرقم');
        }
    }

    public function get_product_units(Request $request)
    {
        $product_id = $request->product_id;
        $product_units = ProductUnit::where('product_id', $product_id)
            ->where('first_balance', '>', 0)->get();
        foreach ($product_units as $product_unit) {
            if ($product_unit->type == "نعم") {
                echo "<option selected value='" . $product_unit->id . "'>" . $product_unit->unit->unit_name . "</option>";
            } else {
                echo "<option value='" . $product_unit->id . "'>" . $product_unit->unit->unit_name . "</option>";
            }
        }
    }

    public function get_edit_product_units(Request $request)
    {
        $product_id = $request->product_id;
        $product_units = ProductUnit::where('product_id', $product_id)
            ->where('first_balance', '>', 0)->get();
        foreach ($product_units as $product_unit) {
            echo "<option value='" . $product_unit->id . "'>" . $product_unit->unit->unit_name . "</option>";
        }
    }


    public function get_product_price(Request $request)
    {
        $product_id = $request->product_id;
        $product_unit = ProductUnit::where('product_id', $product_id)
            ->where('first_balance', '>', 0)
            ->where('type', 'نعم')
            ->first();
        $wholesale_price = $product_unit->wholesale_price;
        $sector_price = $product_unit->sector_price;
        $first_balance = $product_unit->first_balance;

        $sale_bill = SaleBill::where('sale_bill_number', $request->sale_bill_number)->first();
        if (!empty($sale_bill)) {
            $company_id = $sale_bill->company_id;
            $elements = SaleBillElement::where('sale_bill_id', $sale_bill->id)
                ->where('product_id', $product_id)
                ->where('company_id', $company_id)
                ->get();
            if (!$elements->isempty()) {
                $sum = 0;
                foreach ($elements as $element) {
                    $sum += $element->quantity;
                }
                $first_balance = $first_balance - $sum;
            }
        }
        return response()->json([
            'wholesale_price' => $wholesale_price,
            'sector_price' => $sector_price,
            'first_balance' => $first_balance,
        ]);
    }

    public function change_product_price(Request $request)
    {
        $product_unit_id = $request->product_unit_id;
        $product_unit = ProductUnit::FindorFail($product_unit_id);
        $wholesale_price = $product_unit->wholesale_price;
        $sector_price = $product_unit->sector_price;
        return response()->json([
            'wholesale_price' => $wholesale_price,
            'sector_price' => $sector_price,
        ]);
    }

    public function change_product_unit(Request $request)
    {
        $product_unit_id = $request->product_unit_id;
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $product_id = $product_unit->product_id;
        $wholesale_price = $product_unit->wholesale_price;
        $purchasing_price = $product_unit->purchasing_price;
        $sector_price = $product_unit->sector_price;
        $first_balance = $product_unit->first_balance;

        $sale_bill = SaleBill::where('sale_bill_number', $request->sale_bill_number)->first();
        if (!empty($sale_bill)) {
            $company_id = $sale_bill->company_id;
            $elements = SaleBillElement::where('sale_bill_id', $sale_bill->id)
                ->where('product_id', $product_id)
                ->where('company_id', $company_id)
                ->get();
            if (!$elements->isempty()) {
                $sum = 0;
                foreach ($elements as $element) {
                    $sum += $element->quantity;
                }
                $first_balance = $first_balance - $sum;
            }
        }
        return response()->json([
            'wholesale_price' => $wholesale_price,
            'purchasing_price' => $purchasing_price,
            'sector_price' => $sector_price,
            'first_balance' => $first_balance,
        ]);
    }


    public function get_edit_product_price(Request $request)
    {
        $product_id = $request->product_id;
        $product_unit_id = $request->product_unit_id;
        $product = Product::FindOrFail($product_id);
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $first_balance = $product_unit->first_balance;
        return response()->json([
            'first_balance' => $first_balance,
        ]);
    }

    public function get_outer_client_details(Request $request)
    {
        $outer_client_id = $request->outer_client_id;
        $outer_client = OuterClient::FindOrFail($outer_client_id);
        $category = $outer_client->client_category;
        $balance_before = $outer_client->prev_balance;
        $outer_client_national = $outer_client->client_national;
        if ($outer_client->phones->isEmpty()) {
            $client_phone = "";
        } else {
            $client_phone = $outer_client->phones[0]->client_phone;
        }
        if ($outer_client->addresses->isEmpty()) {
            $client_address = "";
        } else {
            $client_address = $outer_client->addresses[0]->client_address;
        }
        return response()->json([
            'category' => $category,
            'balance_before' => $balance_before,
            'client_national' => $outer_client_national,
            'tax_number' => $outer_client->tax_number,
            'shop_name' => $outer_client->shop_name,
            'client_phone' => $client_phone,
            'client_address' => $client_address,
        ]);
    }

    public function delete_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = SaleBillElement::FindOrFail($element_id);
        $element->delete();
    }

    public function update_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = SaleBillElement::FindOrFail($element_id);
        $element->update([
            'product_unit_id' => $request->product_unit_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'quantity_price' => $request->quantity_price,
            'product_price' => $request->product_price,
        ]);
    }

    public function get_sale_bill_elements(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bill_number = $request->sale_bill_number;
        $sale_bill = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        $elements = SaleBillElement::where('sale_bill_id', $sale_bill->id)->get();
        $extras = SaleBillExtra::where('sale_bill_id', $sale_bill->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            echo '<h6 class="alert alert-sm alert-danger text-center">
                <i class="fa fa-info-circle"></i>
            بيانات عناصر الفاتورة  رقم
                ' . $sale_bill_number . '
            </h6>';
            $i = 0;
            echo "<table class='table table-condensed table-striped table-bordered'>";
            echo "<thead>";
            echo "<th>  # </th>";
            echo "<th> اسم المنتج </th>";
            echo "<th> سعر الوحدة </th>";
            echo "<th> الكمية </th>";
            echo "<th>  الاجمالى </th>";
            echo "<th>  سيريالات </th>";
            echo "<th class='no-print'>  تحكم </th>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
                echo "<tr>";
                echo "<td>" . ++$i . "</td>";
                echo "<td>" . $element->product->product_name . "</td>";
                echo "<td>" . $element->product_price . "</td>";
                echo "<td>" . $element->quantity . " " . $element->unit->unit->unit_name . "</td>";
                echo "<td>" . $element->quantity_price . "</td>";
                echo "<td><a
                            element_id = '" . $element->id . "' product_unit_id = '" . $element->product_unit_id . "'
                            quantity = '" . $element->quantity . "' style='font-size: 20px!important;'
                            class='btn btn-sm btn-info add_serials' data-toggle='modal' href='#modaldemo100'><i class='fa fa-barcode'></i></a></td>";
                echo "<td class='no-print'>
                    <button type='button' sale_bill_number='" . $element->SaleBill->sale_bill_number . "' element_id='" . $element->id . "' class='btn btn-sm btn-info edit_element'>
                                <i class='fa fa-pencil'></i> تعديل
                            </button>
                    <button type='button' sale_bill_number='" . $element->SaleBill->sale_bill_number . "' element_id='" . $element->id . "' class='btn btn-sm btn-danger remove_element'>
                        <i class='fa fa-trash'></i> حذف
                    </button>
                </td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            $total = array_sum($sum);
            $percentage = ($tax_value_added / 100) * $total;
            $after_total = $total + $percentage;
            echo "
            <div class='clearfix'></div>
            <div class='alert alert-dark alert-sm text-center'>
                <div class='pull-right col-lg-6 '>
                     اجمالى الفاتورة
                    " . $total . " " . $currency . "
                </div>
                <div class='pull-left col-lg-6 '>
                    اجمالى الفاتورة  بعد القيمة المضافة
                    " . $after_total . " " . $currency . "
                </div>
                <div class='clearfix'></div>
            </div>";

        }

        echo "
        <script>
            $('.remove_element').on('click',function(){
                let element_id = $(this).attr('element_id');
                let sale_bill_number = $(this).attr('sale_bill_number');

                let discount_type = $('#discount_type').val();
                let discount_value = $('#discount_value').val();

                let extra_type = $('#extra_type').val();
                let extra_value = $('#extra_value').val();

                $.post('/client/sale-bills/element/delete',
                {'_token': '" . csrf_token() . "', element_id: element_id},
                function (data) {
                    $.post('/client/sale-bills/elements',
                        {'_token': '" . csrf_token() . "', sale_bill_number: sale_bill_number},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                    });
                $.post('/client/sale-bills/discount',
                    {'_token': '" . csrf_token() . "',sale_bill_number:sale_bill_number, discount_type: discount_type, discount_value: discount_value},
                    function (data) {
                        $('.after_totals').html(data);
                });

                $.post('/client/sale-bills/extra',
                    {'_token': '" . csrf_token() . "',sale_bill_number:sale_bill_number, extra_type: extra_type, extra_value: extra_value},
                    function (data) {
                        $('.after_totals').html(data);
                });
                $.post('/client/sale-bills/refresh',
                {
                    '_token': '" . csrf_token() . "',
                    sale_bill_number : sale_bill_number,
                },
                function (data) {
                    $('#final_total').val(data.final_total);
                });

                $(this).parent().parent().fadeOut(300);
            });
            $('.edit_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let sale_bill_number = $(this).attr('sale_bill_number');
            $.post('/client/sale-bills/edit-element',
                {
                    '_token': '" . csrf_token() . "',
                    sale_bill_number: sale_bill_number,
                    element_id: element_id
                },
                function (data) {
                    $('#product_id').val(data.product_id);
                    $('#product_id').selectpicker('refresh');
                    $('#product_price').val(data.product_price);
                    $('#product_unit_id').val(data.product_unit_id);
                    $('#quantity').val(data.quantity);
                    $('#quantity_price').val(data.quantity_price);
                    let product_id = data.product_id;
                    $.post('/client/sale-bills/get-edit', {
                        product_id: product_id,
                        sale_bill_number: sale_bill_number,
                        '_token': '" . csrf_token() . "'
                    }, function (data) {
                        $('input#quantity').attr('max', data.first_balance);
                        $('.available').html('الكمية المتاحة : ' + data.first_balance);
                    });
                    $('#add').hide();
                    $('#edit').show();
                    $('#edit').attr('element_id', element_id);
                    $('#edit').attr('sale_bill_number', sale_bill_number);
                });
            });
            $('.add_serials').on('click', function () {
            let element_id = $(this).attr('element_id');
            let product_unit_id = $(this).attr('product_unit_id');
            let quantity = $(this).attr('quantity');
            if (quantity <= 0) {
                alert('الكمية غير مقبولة');
            } else {
                $.post('/client/add-serials-sales', {
                    quantity: quantity,
                    element_id: element_id,
                    product_unit_id: product_unit_id
                }, function (data) {
                    $('.serials').html(data);
                });
            }
        });
        </script>
        ";
    }

    public function updateData(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bill_number = $request->sale_bill_number;
        $sale_bill = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        $elements = SaleBillElement::where('sale_bill_id', $sale_bill->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);
        $percentage = ($tax_value_added / 100) * $total;
        $after_total = $total + $percentage;
        echo "
            <div class='pull-right col-lg-6 '>
            اجمالى الفاتورة
            " . $total . " " . $currency . "
            </div>
            <div class='pull-left col-lg-6 '>
            اجمالى الفاتورة  بعد القيمة المضافة
            " . $after_total . " " . $currency . "
            </div>
            <div class='clearfix'></div>";
    }

    public function apply_discount(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bill_number = $request->sale_bill_number;
        $discount_type = $request->discount_type;
        $discount_value = $request->discount_value;
        $sale_bill = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        $elements = SaleBillElement::where('sale_bill_id', $sale_bill->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);

            $previous_extra = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
                ->where('action', 'extra')->first();
            if (!empty($previous_extra)) {
                $previous_extra_type = $previous_extra->action_type;
                $previous_extra_value = $previous_extra->value;
                if ($previous_extra_type == "percent") {
                    $previous_extra_value = $previous_extra_value / 100 * $total;
                }
            }

            if ($discount_type == "pound") {
                if (isset($previous_extra_value) && $previous_extra_value != 0) {
                    $after_discount = $total - $discount_value + $previous_extra_value;
                } else {
                    $after_discount = $total - $discount_value;
                }
            } else if ($discount_type == "percent") {
                $value = $discount_value / 100 * $total;
                if (isset($previous_extra_value) && $previous_extra_value != 0) {
                    $after_discount = $total - $value + $previous_extra_value;
                } else {
                    $after_discount = $total - $value;
                }
            }

            if (isset($after_discount) && $after_discount != 0) {
                $percentage = ($tax_value_added / 100) * $after_discount;
                $after_total = $after_discount + $percentage;
            } else {
                $percentage = ($tax_value_added / 100) * $total;
                $after_total = $total + $percentage;
            }
            echo "
            <div class='clearfix'></div>
            <div class='alert alert-secondary alert-sm text-center'>
                   اجمالى الفاتورة النهائى بعد الضريبة والشحن والخصم :
                    " . $after_total . " " . $currency . "
            </div>";
            $sale_bill_extra = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
                ->where('action', 'discount')->first();
            if (empty($sale_bill_extra)) {
                $sale_bill_extra = SaleBillExtra::create([
                    'sale_bill_id' => $sale_bill->id,
                    'action' => 'discount',
                    'action_type' => $discount_type,
                    'value' => $discount_value,
                    'company_id' => $company_id,
                ]);
            } else {
                $sale_bill_extra->update([
                    'action_type' => $discount_type,
                    'value' => $discount_value,
                ]);
            }
        }
    }

    public function refresh(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bill_number = $request->sale_bill_number;
        $sale_bill = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        $elements = $sale_bill->elements;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);
        $previous_extra = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
            ->where('action', 'extra')->first();
        if (!empty($previous_extra)) {
            $previous_extra_type = $previous_extra->action_type;
            $previous_extra_value = $previous_extra->value;
            if ($previous_extra_type == "percent") {
                $previous_extra_value = $previous_extra_value / 100 * $total;
            }
            $after_discount = $total + $previous_extra_value;
        }
        $previous_discount = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
            ->where('action', 'discount')->first();
        if (!empty($previous_discount)) {
            $previous_discount_type = $previous_discount->action_type;
            $previous_discount_value = $previous_discount->value;
            if ($previous_discount_type == "percent") {
                $previous_discount_value = $previous_discount_value / 100 * $total;
            }
            $after_discount = $total - $previous_discount_value;

        }
        if (!empty($previous_extra) && !empty($previous_discount)) {
            $after_discount = $total - $previous_discount_value + $previous_extra_value;
        } else {
            $after_discount = $total;
        }
        if (isset($after_discount) && $after_discount != 0) {
            $percentage = ($tax_value_added / 100) * $after_discount;
            $after_total_all = $after_discount + $percentage;
        } else {
            $percentage = ($tax_value_added / 100) * $total;
            $after_total_all = $total + $percentage;
        }
        $sale_bill->update([
            'final_total' => $after_total_all
        ]);
        return response()->json([
            'final_total' => $after_total_all,
        ]);
    }

    public function apply_extra(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bill_number = $request->sale_bill_number;
        $extra_type = $request->extra_type;
        $extra_value = $request->extra_value;
        $sale_bill = SaleBill::where('sale_bill_number', $sale_bill_number)->first();
        $elements = SaleBillElement::where('sale_bill_id', $sale_bill->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);

            $previous_discount = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
                ->where('action', 'discount')->first();
            if (!empty($previous_discount)) {
                $previous_discount_type = $previous_discount->action_type;
                $previous_discount_value = $previous_discount->value;
                if ($previous_discount_type == "percent") {
                    $previous_discount_value = $previous_discount_value / 100 * $total;
                }
            }


            if ($extra_type == "pound") {
                if (isset($previous_discount_value) && $previous_discount_value != 0) {
                    $after_extra = $total + $extra_value - $previous_discount_value;
                } else {
                    $after_extra = $total + $extra_value;
                }

            } else if ($extra_type == "percent") {
                $value = $extra_value / 100 * $total;
                if (isset($previous_discount_value) && $previous_discount_value != 0) {
                    $after_extra = $total + $value - $previous_discount_value;
                } else {
                    $after_extra = $total + $value;
                }
            }
            if (isset($after_extra) && $after_extra != 0) {
                $percentage = ($tax_value_added / 100) * $after_extra;
                $after_total = $after_extra + $percentage;
            } else {
                $percentage = ($tax_value_added / 100) * $total;
                $after_total = $total + $percentage;
            }
            echo "
            <div class='clearfix'></div>
            <div class='alert alert-secondary alert-sm text-center'>
                   اجمالى الفاتورة النهائى بعد الضريبة والشحن والخصم :
                    " . $after_total . " " . $currency . "
            </div>";
            $sale_bill_extra = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
                ->where('action', 'extra')->first();
            if (empty($sale_bill_extra)) {
                $sale_bill_extra = SaleBillExtra::create([
                    'sale_bill_id' => $sale_bill->id,
                    'action' => 'extra',
                    'action_type' => $extra_type,
                    'value' => $extra_value,
                    'company_id' => $company_id,
                ]);
            } else {
                $sale_bill_extra->update([
                    'action_type' => $extra_type,
                    'value' => $extra_value,
                ]);
            }
        }
    }

    public function get_return(Request $request)
    {
        $sale_bill = SaleBill::FindOrFail($request->sale_bill_id);
        $element = SaleBillElement::FindOrFail($request->element_id);
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $outer_clients = $company->outerClients;
        $products = $company->products;
        return view('client.sale_bills.return', compact('company', 'sale_bill', 'element', 'products', 'company_id', 'outer_clients'));
    }

    public function post_return(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $data = $request->all();
        $data['company_id'] = $company_id;
        $data['client_id'] = Auth::user()->id;
        $return = SaleBillReturn::create($data);
        $element = SaleBillElement::FindOrFail($request->element_id);
        $product_unit = $element->unit;
        $product = Product::FindOrFail($request->product_id);
        $sale_bill = $element->SaleBill;
        $product_unit->update([
            'first_balance' => $request->after_return
        ]);
        if (!empty($sale_bill->outer_client_id)) {
            $outer_client = OuterClient::FindOrFail($request->outer_client_id);
            $outer_client->update([
                'prev_balance' => $request->balance_after
            ]);
        }

        $quantity_before_return = $element->quantity;
        $product_price_before_return = $element->product_price;

        $quantity_after_return = $quantity_before_return - $request->return_quantity;
        $product_price_after_return = $quantity_after_return * $product_price_before_return;
        if ($quantity_after_return == 0 || $product_price_after_return == 0) {
            $element->delete();
        } else {
            $element->update([
                'quantity' => $quantity_after_return,
                'quantity_price' => $product_price_after_return,
            ]);
        }

        $elements = $sale_bill->elements;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);
        $previous_extra = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
            ->where('action', 'extra')->first();
        if (!empty($previous_extra)) {
            $previous_extra_type = $previous_extra->action_type;
            $previous_extra_value = $previous_extra->value;
            if ($previous_extra_type == "percent") {
                $previous_extra_value = $previous_extra_value / 100 * $total;
            }
            $after_discount = $total + $previous_extra_value;
        }
        $previous_discount = SaleBillExtra::where('sale_bill_id', $sale_bill->id)
            ->where('action', 'discount')->first();
        if (!empty($previous_discount)) {
            $previous_discount_type = $previous_discount->action_type;
            $previous_discount_value = $previous_discount->value;
            if ($previous_discount_type == "percent") {
                $previous_discount_value = $previous_discount_value / 100 * $total;
            }
            $after_discount = $total - $previous_discount_value;

        }
        if (!empty($previous_extra) && !empty($previous_discount)) {
            $after_discount = $total - $previous_discount_value + $previous_extra_value;
        } else {
            $after_discount = $total;
        }
        if (isset($after_discount) && $after_discount != 0) {
            $percentage = ($tax_value_added / 100) * $after_discount;
            $after_total_all = $after_discount + $percentage;
        } else {
            $percentage = ($tax_value_added / 100) * $total;
            $after_total_all = $total + $percentage;
        }
        $sale_bill->update([
            'final_total' => $after_total_all
        ]);
        return redirect()->route('client.sale_bills.returns');
    }

    public function get_returns()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $sale_bill_returns = $company->sale_bill_returns;
        return view('client.sale_bills.returns', compact('sale_bill_returns'));
    }

    public function redirect()
    {
        return redirect()->route('client.sale_bills.create')->with('success', 'تم انشاء فاتورة مبيعات بنجاح');
    }

    public function get_products(Request $request)
    {
        $store_id = $request->store_id;
        $products = Product::where('store_id', $store_id)->get();
        foreach ($products as $product) {
            echo "<option value='" . $product->id . "'>" . $product->product_name . "</option>";
        }
    }

    public function print($id)
    {
        $sale_bill = SaleBill::where('sale_bill_number', $id)->first();
        if (!empty($sale_bill)) {
            $elements = $sale_bill->elements;
            if ($elements->isEmpty()) {
                return abort('404');
            } else {
                return view('client.sale_bills.print', compact('sale_bill'));
            }
        } else {
            return abort('404');
        }
    }
}

?>
