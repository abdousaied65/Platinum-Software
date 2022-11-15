<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\sendingDailyPosReport;
use App\Models\Bank;
use App\Models\BankCash;
use App\Models\Branch;
use App\Models\Cash;
use App\Models\Category;
use App\Models\Client;
use App\Models\Company;
use App\Models\CouponCash;
use App\Models\CouponCode;
use App\Models\ExtraSettings;
use App\Models\OuterClient;
use App\Models\PosOpen;
use App\Models\PosOpenDiscount;
use App\Models\PosOpenElement;
use App\Models\PosOpenTax;
use App\Models\PosSerial;
use App\Models\PosSetting;
use App\Models\PosShift;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Safe;
use App\Models\ShiftReport;
use App\Models\SubCategory;
use App\Models\Tax;
use App\Models\TimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PosController extends Controller
{
    public function add_serials(Request $request)
    {
        $product_unit_id = $request->product_unit_id;
        $element_id = $request->element_id;
        $element = PosOpenElement::FindOrFail($element_id);
        $pos_open = $element->PosOpen;
        $pos_open_id = $pos_open->id;
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $quantity = $request->quantity;

        $serials = $element->serials;
        $old_serials = array();
        foreach ($serials as $serial) {
            array_push($old_serials, $serial->serial_number);
        }
        echo '<form id="myForm" method="POST" action="/client/save-serials-pos" target="_blank">';
        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        echo '<input type="hidden" name = "product_unit_id" value="' . $product_unit_id . '" /> ';
        echo '<input type="hidden" name = "pos_element_id" value="' . $element_id . '" /> ';
        echo '<input type="hidden" name = "pos_open_id" value="' . $pos_open_id . '" /> ';
        echo '<input type="hidden" name = "quantity" value="' . $quantity . '"  /> ';
        if ($serials->isEmpty()) {
            for ($i = 0; $i < $quantity; $i++) {
                $counter = $i+1;
                echo '
            <div class="form-group pull-right col-lg-3 col-xs-6">
                <label for="serials"> رقم السيريال # ' . $counter . ' </label>
                <input required type="text" class="form-control text-left serial" dir="ltr" name="serials[]" />
            </div>';
            }
        } else {
            for ($i = 0; $i < $quantity; $i++) {
                $counter = $i+1;
                if (empty($old_serials[$i])){
                    echo '
                    <div class="form-group pull-right col-lg-3 col-xs-6">
                        <label for="serials"> رقم السيريال # ' . $counter . ' </label>
                        <input required type="text" class="form-control text-left serial" dir="ltr" name="serials[]" />
                    </div>';
                }
                else{
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
        $pos_open_id = $request->pos_open_id;
        $pos_element_id = $request->pos_element_id;
        $pos_element = PosOpenElement::FindOrFail($pos_element_id);
        $old_serials = $pos_element->serials;
        if (!$old_serials->isEmpty()) {
            foreach ($old_serials as $old_serial) {
                $old_serial->delete();
            }
        }
        for ($i = 0; $i < $quantity; $i++) {
            $pos_serial = PosSerial::create([
                'company_id' => $company_id,
                'client_id' => $client_id,
                'product_unit_id' => $product_unit_id,
                'pos_open_id' => $pos_open_id,
                'pos_element_id' => $pos_element_id,
                'serial_number' => $serials[$i],
            ]);

        }
        echo "<script>window.close();</script>";
    }

    public function create()
    {
        $auth_id = Auth::user()->id;
        $user = Client::findOrFail($auth_id);
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $branch_id = $user->branch_id;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $pos_settings = $company->pos_settings;
        $categories = $company->categories;
        $outer_clients = $company->outerClients;
        $stores = $company->stores;
        if (empty($branch_id)) {
            return redirect()->route('client.home')
                ->with('error', 'غير مسموح لك بالدخول الى نقطة البيع لانها متاحه فقط للمستخدمين الذين يعملون فى فروع الشركة');
        }
        $shift = PosShift::where('company_id', $company_id)
            ->where('client_id', $auth_id)
            ->where('branch_id', $branch_id)
            ->where('status', 'open')
            ->first();
        if (empty($shift)) {
            $shift_type = "none";
        } else {
            $shift_type = "open";
        }
        $pending_pos = PosOpen::where('status', 'pending')
            ->where('company_id', $company_id)
            ->where('client_id', $auth_id)
            ->get();
        if (!empty($user->branch_id)) {
            $branch = Branch::FindOrFail($user->branch_id);
            $stores = $branch->stores;
            if ($company->all_users_access_main_branch == "yes") {
                $products = Product::where('company_id', $company_id)
                    ->get();
            } else {
                $products = Product::where('company_id', $company_id)
                    ->whereIn('store_id', $stores)
                    ->get();
            }
        } else {
            $products = Product::where('company_id', $company_id)
                ->get();
        }
        $last_shift = PosShift::where('company_id', $company_id)
            ->where('branch_id', $branch_id)
            ->where('client_id', $auth_id)
            ->where('status', 'closed')
            ->latest()->first();
        $timezones = TimeZone::all();
        $client_id = Auth::user()->id;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $taxes = Tax::where('company_id', $company_id)->get();

        $old_cash = Cash::max('cash_number');
        $pre_cash = ++$old_cash;
        if (!empty($user->branch_id)) {
            $safes = $branch->safes;
        } else {
            $safes = $company->safes;
        }
        $banks = $company->banks;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $bills = PosOpen::where('company_id', $company_id)
            ->where('client_id', $client_id)
            ->where('status', 'done')
            ->get();

        $check = Product::where('company_id', $company_id)->get();
        if ($check->isEmpty()) {
            $code_universal = "100000001";
        } else {
            $old_order = Product::max('code_universal');
            $code_universal = ++$old_order;
        }

        if (!empty($pos_open)) {
            $pos_open_elements = PosOpenElement::where('pos_open_id', $pos_open->id)->get();
            $pos_open_discount = PosOpenDiscount::where('pos_open_id', $pos_open->id)->first();
            $pos_open_tax = PosOpenTax::where('pos_open_id', $pos_open->id)->first();
            $pos_id = "pos_" . $pos_open->id;
            $pos_cash = Cash::where('bill_id', $pos_id)
                ->get();
            $pos_bank_cash = BankCash::where('bill_id', $pos_id)
                ->get();
            $pos_coupon_cash = CouponCash::where('bill_id', $pos_id)
                ->get();
            return view('client.pos.create',
                compact('company_id', 'last_shift', 'shift', 'shift_type', 'pos_settings', 'user', 'bills', 'pos_cash', 'pos_bank_cash', 'pos_coupon_cash', 'outer_clients', 'pending_pos', 'pos_open_discount', 'pos_open_tax',
                    'stores', 'code_universal', 'pos_open', 'currency', 'pos_open_elements', 'safes', 'banks', 'pre_cash', 'products', 'company', 'taxes', 'timezones', 'categories'));
        } else {
            return view('client.pos.create',
                compact('company_id', 'last_shift', 'shift', 'shift_type', 'pos_settings', 'code_universal', 'currency', 'user', 'bills', 'outer_clients'
                    , 'safes', 'banks', 'pre_cash', 'pending_pos', 'stores', 'taxes', 'pos_open', 'products'
                    , 'company', 'timezones', 'categories'));
        }
    }

    public function client_pos_shift_close($id)
    {
        $auth_id = Auth::user()->id;
        $user = Client::findOrFail($auth_id);
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $shift = PosShift::FindOrFail($id);
        $branch_id = $user->branch_id;
        if (!empty($branch_id)) {
            $branch = Branch::FindOrFail($branch_id);
            $safes = $branch->safes;
        } else {
            $safes = $company->safes;
        }
        if (empty($shift)) {
            $shift_type = "none";
        } else {
            $shift_type = "open";
        }
        return view('client.pos.close', compact('company', 'shift_type', 'safes', 'company_id', 'shift', 'user'));
    }

    public function pos_shift_close(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $admin = Client::where('company_id', $company_id)
            ->where('role_name', 'مدير النظام')
            ->first();
        $client_id = Auth::user()->id;
        $client = Client::FindOrFail($client_id);
        $branch_id = $client->branch_id;
        $shift_id = $request->shift_id;
        $shift = PosShift::FindOrFail($shift_id);
        $actual_cash = $request->actual_cash;
        $actual_bank = $request->actual_bank;
        $safe_id = $request->safe_id;
        $transfer_safe_amount = $request->transfer_safe_amount;
        $next_shift_balance = $actual_cash - $transfer_safe_amount;
        $shift->update([
            'status' => 'closed',
            'end_date_time' => now(),
            'next_shift_balance' => $next_shift_balance,
            'actual_cash' => $actual_cash,
            'actual_bank' => $actual_bank,
            'safe_id' => $safe_id,
            'transfer_safe_amount' => $transfer_safe_amount,
        ]);
        $pos_bills = $shift->PosBills;
        foreach ($pos_bills as $pos_bill) {
            if ($pos_bill->status == "open") {
                $pos_bill->update([
                    'status' => 'done'
                ]);
            }
        }
        $system_total = $request->system_total;
        $actual_total = $actual_cash + $actual_bank;
        $difference_amount = $actual_total - $system_total;
        $shift_report = ShiftReport::create([
            'company_id' => $company_id,
            'branch_id' => $branch_id,
            'client_id' => $client_id,
            'shift_id' => $shift_id,
            'system_total' => $system_total,
            'actual_total' => $actual_total,
            'difference_amount' => $difference_amount,
        ]);
        $safe = Safe::FindOrFail($safe_id);
        $old_safe_balance = $safe->balance;
        $new_safe_balance = $old_safe_balance + $transfer_safe_amount;
        $safe->update([
            'balance' => $new_safe_balance
        ]);
        $company = Company::FindOrFail($company_id);
        $pos_settings = $company->pos_settings;
        $cashier_safe_id = $pos_settings->safe_id;

        $cashier_safe = Safe::FindOrFail($cashier_safe_id);

        $old_cashier_safe_balance = $cashier_safe->balance;
        $new_cashier_safe_balance = $old_cashier_safe_balance - $transfer_safe_amount;
        $cashier_safe->update([
            'balance' => $new_cashier_safe_balance
        ]);
        $pos_sales = $shift->PosBills;
        $sum1 = 0;
        $sum2 = 0;
        foreach ($pos_sales as $key => $pos) {
            $pos_elements = $pos->elements;
            $pos_discount = $pos->discount;
            $pos_tax = $pos->tax;
            $sum = 0;
            $total_cost = 0;
            foreach ($pos_elements as $pos_element) {
                $sum = $sum + $pos_element->quantity_price;
                $purchasing_price = $pos_element->unit->purchasing_price;
                $quantity = $pos_element->quantity;
                $total_cost = $total_cost + ($quantity * $purchasing_price);
            }
            if (isset($pos) && isset($pos_tax) && empty($pos_discount)) {
                $tax_value = $pos_tax->tax_value;
                $percent = $tax_value / 100 * $sum;
                $sum = $sum + $percent;
            } elseif (isset($pos) && isset($pos_discount) && empty($pos_tax)) {
                $discount_value = $pos_discount->discount_value;
                $discount_type = $pos_discount->discount_type;
                if ($discount_type == "pound") {
                    $sum = $sum - $discount_value;
                } else {
                    $discount_value = ($discount_value / 100) * $sum;
                    $sum = $sum - $discount_value;
                }
            } elseif (isset($pos) && !empty($pos_discount) && !empty($pos_tax)) {
                $tax_value = $pos_tax->tax_value;
                $discount_value = $pos_discount->discount_value;
                $discount_type = $pos_discount->discount_type;
                if ($discount_type == "pound") {
                    $sum = $sum - $discount_value;
                } else {
                    $discount_value = ($discount_value / 100) * $sum;
                    $sum = $sum - $discount_value;
                }
                $percent = $tax_value / 100 * $sum;
                $sum = $sum + $percent;
            }
            $sum1 = $sum1 + $sum;
            $sum2 = $sum2 + $total_cost;
        }
        $total_sales_revenue = $sum1;
        $total_costs = $sum2;
        $profits = $total_sales_revenue - $total_costs;
        $data = array(
            'body' => 'تقرير الوردية / الشيفت ',
            'profits' => $profits,
        );

        $users = $company->clients;
        foreach ($users as $user) {
            if (in_array('مدير النظام', $user->role_name)) {
                Mail::to($user->email)->send(new sendingDailyPosReport($data, $shift, $shift_report));
            }
        }
        return redirect()->route('client.home')->with('error', 'تم اغلاق نقطة البيع وتقفيل اليومية والشيفت');
    }

    public function pos_shift_open(Request $request)
    {
        $data = $request->all();
        $start_date_time = $request->start_date_time;
        $date = date('Y-m-d');
        $start_date_time = $date . ' ' . $start_date_time;
        $data['start_date_time'] = $start_date_time;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $client = Client::FindOrFail($client_id);
        $branch_id = $client->branch_id;
        $data['company_id'] = $company_id;
        $data['client_id'] = $client_id;
        $data['branch_id'] = $branch_id;
        $pos_shift = PosShift::create($data);
        if ($pos_shift) {
            return redirect()->route('client.pos.create');
        } else {
            return redirect()->route('client.home');
        }
    }

    public function shuffle_coupon_codes(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;

        $chars = "0123456789876543210";
        $code = substr(str_shuffle($chars), 0, 16);

        $check = CouponCode::where('company_id', $company_id)
            ->where('coupon_code', $code)
            ->first();
        if (!empty($check)) {
            $chars = "0123456789876543210";
            $code = substr(str_shuffle($chars), 0, 16);
        }
        $coupon_code = $code;
        return response()->json([
            'coupon_code' => $coupon_code,
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $data['client_id'] = Auth::user()->id;
        $client = Client::FindOrFail($data['client_id']);
        $branch_id = $client->branch_id;
        $shift = PosShift::where('company_id', $data['company_id'])
            ->where('client_id', $data['client_id'])
            ->where('branch_id', $branch_id)
            ->where('status', 'open')
            ->first();
        $data['shift_id'] = $shift->id;
        $PosOpen = PosOpen::where('client_id', $data['client_id'])
            ->where('status', 'open')
            ->first();
        if (empty($PosOpen)) {
            $PosOpen = PosOpen::create($data);
        } else {
            $PosOpen->update($data);
        }
        $data['pos_open_id'] = $PosOpen->id;
        $product_id = $request->product_id;
        $product = Product::FindOrFail($product_id);
        $product_unit = ProductUnit::where('product_id', $product_id)
            ->where('first_balance', '>', '0')
            ->where('type', 'نعم')
            ->first();
        $outer_client_id = $request->outer_client_id;
        if (!empty($outer_client_id)) {
            $outer_client = OuterClient::FindOrFail($outer_client_id);
            $client_category = $outer_client->client_category;
            if ($client_category == "جملة") {
                $product_price = $product_unit->wholesale_price;
            } elseif ($client_category == "قطاعى") {
                $product_price = $product_unit->sector_price;
            }
        } else {
            $product_price = $product_unit->sector_price;
        }
        $element = PosOpenElement::where('product_id', $product_id)
            ->where('pos_open_id', $PosOpen->id)
            ->where('product_unit_id', $product_unit->id)
            ->first();
        if (empty($element)) {
            $data['product_id'] = $product_id;
            $data['product_price'] = $product_price;
            $data['quantity'] = 1;
            $data['quantity_price'] = $product_price;
            $data['company_id'] = $company->id;
            $data['product_unit_id'] = $product_unit->id;
            $pos_open_element = PosOpenElement::create($data);
        } else {
            $old_quantity = $element->quantity;
            $old_product_price = $element->product_price;
            $old_quantity_price = $element->quantity_price;

            $new_quantity = $old_quantity + 1;
            $new_product_price = $old_product_price;
            $new_quantity_price = $new_quantity * $new_product_price;

            $data['product_id'] = $product_id;
            $data['product_price'] = $new_product_price;
            $data['quantity'] = $new_quantity;
            $data['quantity_price'] = $new_quantity_price;
            $pos_open_element = $element->update($data);
        }
    }

    public function edit_quantity(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $element_id = $request->element_id;
        $edit_quantity = $request->edit_quantity;
        $element = PosOpenElement::FindOrFail($element_id);

        $old_quantity = $element->quantity;
        $old_product_price = $element->product_price;
        $old_quantity_price = $element->quantity_price;

        $new_quantity = $edit_quantity;
        $new_product_price = $old_product_price;
        $new_quantity_price = $new_quantity * $new_product_price;

        $data['product_price'] = $new_product_price;
        $data['quantity'] = $new_quantity;
        $data['quantity_price'] = $new_quantity_price;
        $pos_open_element = $element->update($data);

    }
    public function edit_price(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $element_id = $request->element_id;
        $edit_price = $request->edit_price;
        $element = PosOpenElement::FindOrFail($element_id);

        $old_quantity = $element->quantity;
        $old_product_price = $element->product_price;
        $old_quantity_price = $element->quantity_price;

        $new_quantity = $old_quantity;
        $new_product_price = $edit_price;
        $new_quantity_price = $new_quantity * $new_product_price;

        $data['product_price'] = $new_product_price;
        $data['quantity'] = $new_quantity;
        $data['quantity_price'] = $new_quantity_price;
        $pos_open_element = $element->update($data);

    }
    public function edit_quantity_price(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $element_id = $request->element_id;
        $edit_quantity_price = $request->edit_quantity_price;
        $element = PosOpenElement::FindOrFail($element_id);

        $old_quantity = $element->quantity;
        $old_product_price = $element->product_price;
        $old_quantity_price = $element->quantity_price;

        $new_quantity = $old_quantity;
        $new_product_price = $old_product_price;
        $new_quantity_price = $edit_quantity_price;

        $data['product_price'] = $new_product_price;
        $data['quantity'] = $new_quantity;
        $data['quantity_price'] = $new_quantity_price;
        $pos_open_element = $element->update($data);

    }

    public function change_element_product_unit(Request $request)
    {
        $data = $request->all();
        $element_id = $request->element_id;
        $unit_id = $request->unit_id;
        $element = PosOpenElement::FindOrFail($element_id);
        $product = $element->product;
        $product_id = $product->id;
        $product_unit = ProductUnit::FindOrFail($unit_id);
        $pos_open = $element->PosOpen;
        $outer_client_id = $pos_open->outer_client_id;

        $data['company_id'] = $element->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $data['client_id'] = Auth::user()->id;
        $data['pos_open_id'] = $element->pos_open_id;

        if (!empty($outer_client_id)) {
            $outer_client = OuterClient::FindOrFail($outer_client_id);
            $client_category = $outer_client->client_category;
            if ($client_category == "جملة") {
                $product_price = $product_unit->wholesale_price;
            } elseif ($client_category == "قطاعى") {
                $product_price = $product_unit->sector_price;
            }
        } else {
            $product_price = $product_unit->sector_price;
        }

        $data['product_id'] = $product_id;
        $data['product_price'] = $product_price;
        $data['quantity'] = $element->quantity;
        $data['quantity_price'] = $product_price * $element->quantity;
        $data['company_id'] = $company->id;
        $data['product_unit_id'] = $product_unit->id;
        $pos_open_element = $element->update($data);
    }

    public function delete_element(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $element_id = $request->element_id;
        $element = PosOpenElement::FindOrFail($element_id);
        $element->delete();
    }

    public function store_discount(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $data = $request->all();
        $PosOpen = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $data['pos_open_id'] = $PosOpen->id;
        $data['company_id'] = $company_id;
        $check = PosOpenDiscount::where('pos_open_id', $PosOpen->id)->first();
        if (!empty($check)) {
            $check->update($data);
        } else {
            $pos_open_discount = PosOpenDiscount::create($data);
        }
    }

    public function store_tax(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $data = $request->all();
        $PosOpen = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $pos_open_elements = PosOpenElement::where('pos_open_id', $PosOpen->id)->get();
        $data['pos_open_id'] = $PosOpen->id;
        $data['company_id'] = $company_id;
        $pos_open_tax = PosOpenTax::where('pos_open_id', $PosOpen->id)->first();
        $pos_open_discount = PosOpenDiscount::where('pos_open_id', $PosOpen->id)->first();
        if (!empty($pos_open_tax) && $request->tax_id != 0) {
            $pos_open_tax->update($data);
        } elseif ($request->tax_id == 0) {
            $pos_open_tax->delete();
        } else {
            $pos_open_tax = PosOpenTax::create($data);
        }

        $tax_value = $pos_open_tax->tax_value;
        $sum = 0;
        foreach ($pos_open_elements as $pos_open_element) {
            $sum = $sum + $pos_open_element->quantity_price;
        }
        if (isset($PosOpen) && !empty($pos_open_discount)) {
            $discount_value = $pos_open_discount->discount_value;
            $discount_type = $pos_open_discount->discount_type;
            if ($discount_type == "pound") {
                $sum = $sum - $discount_value;
            } else {
                $discount_value = ($discount_value / 100) * $sum;
                $sum = $sum - $discount_value;
            }
        }
        $percent = $tax_value / 100 * $sum;
        return response()->json([
            'percent' => $percent,
        ]);
    }

    public function get_subcategories_by_category_id(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $category_id = $request->category_id;
        $category = Category::FindOrFail($category_id);
        $sub_categories = SubCategory::where('category_id', $category->id)->get();
        foreach ($sub_categories as $sub_category) {
            echo "<a style='border:1px solid #ddd;height: auto;padding: 10px;font-size: 14px;color: #222;'
            class='sub_category text-center ml-1' sub_category_id='" . $sub_category->id . "'>
                " . $sub_category->sub_category_name . "
            </a>";
        }
        echo "<div class='clearfix'></div>";
        echo "
        <script>
        $(document).ready(function () {
            $('.sub_category').on('click', function () {
                var sub_category_id = $(this).attr('sub_category_id');
                $.post('/client/pos/get-products-by-sub-category-id', {
                    sub_category_id: sub_category_id,
                    '_token': '" . csrf_token() . "',
                }, function (data) {
                    $('.products').html(data);
                });
            });
        });
        </script>
        ";
    }

    public function get_products_by_sub_category_id(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $user = Client::FindOrFail($user_id);
        $company = Company::FindOrFail($company_id);
        $pos_settings = $company->pos_settings;
        $sub_category_id = $request->sub_category_id;
        $category_id = $request->category_id;
        if ($sub_category_id == "all") {
            if (!empty($user->branch_id)) {
                $branch = Branch::FindOrFail($user->branch_id);
                $stores = $branch->stores;
                if ($company->all_users_access_main_branch == "yes") {
                    $products = Product::where('company_id', $company_id)
                        ->where('category_id', $category_id)
                        ->get();
                } else {
                    $products = Product::where('company_id', $company_id)
                        ->where('category_id', $category_id)
                        ->whereIn('store_id', $stores)
                        ->get();
                }
            } else {
                $products = Product::where('company_id', $company_id)
                    ->where('category_id', $category_id)
                    ->get();
            }
            foreach ($products as $product) {
                echo "<div class='col-3 pull-right text-center'>
                <div class='product' style='box-shadow: 1px 1px 5px " . $product->color . ";border:1px solid " . $product->color . ";' product_id='" . $product->id . "'>";
                if ($pos_settings->product_image == "1") {
                    echo "<img style='width: 100%; min-height: 60px; margin-bottom: 5px;' src='" . asset($product->product_pic) . "' />";
                }
                echo "
                    <span style='font-size:14px;font-weight:bold;color: " . $product->color . "'> " . $product->product_name . " </span>
                </div>
            </div>";
            }
        } else {
            $sub_category = SubCategory::FindOrFail($sub_category_id);
            if (!empty($user->branch_id)) {
                $branch = Branch::FindOrFail($user->branch_id);
                $stores = $branch->stores;
                $products = Product::where('company_id', $company_id)
                    ->where('sub_category_id', $sub_category->id)
                    ->whereIn('store_id', $stores)
                    ->get();
            } else {
                $products = Product::where('company_id', $company_id)
                    ->where('sub_category_id', $sub_category->id)
                    ->get();
            }
            foreach ($products as $product) {
                echo "<div class='col-3 pull-right text-center'>
                <div class='product' style='box-shadow: 1px 1px 5px " . $product->color . ";border:1px solid " . $product->color . ";' product_id='" . $product->id . "'>";
                if ($pos_settings->product_image == "1") {
                    echo "<img style='width: 100%; min-height: 60px; margin-bottom: 5px;' src='" . asset($product->product_pic) . "' />";
                }
                echo "
                    <span style='font-size:14px;font-weight:bold;color: " . $product->color . "'> " . $product->product_name . " </span>
                </div>
            </div>";
            }
        }

        echo "
        <script>
            $(document).ready(function () {
                $('.product').on('click',function () {
                    let product_id = $(this).attr('product_id');
                    let notes = $('#notes').val();
                    let outer_client_id = $('#outer_client_id').val();
                    $.post('/client/pos-open/post', {
                        outer_client_id: outer_client_id,
                        product_id: product_id,
                        notes: notes,
                        '_token': '" . csrf_token() . "'
                    }, function (data) {
                        $.post('/client/pos-open/elements',
                            {'_token': '" . csrf_token() . "'},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });
                        $.post('/client/pos-open/refresh',
                            {'_token': '" . csrf_token() . "'},
                            function (proto) {
                                $('#items').html(proto.items);
                                $('#total_quantity').html('('  + proto.total_quantity + ')');
                                $('#sum').html(proto.sum);
                                $('#total').html(proto.total);
                                $('#final_total').val(proto.total);
                                $('#tds_2').html(proto.percent);
                                $('#tds').html(proto.discount_value);
                            });
                        $('#outer_client_id').attr('disabled', true).addClass('disabled');
                        var audioElement = document.createElement('audio');
                        audioElement.setAttribute('src', '" . asset('app-assets/mp3/beep.mp3') . "');
                        audioElement.play();
                    });

                })
            });
        </script>";
    }

    public function get_pos_open_elements(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $elements = PosOpenElement::where('pos_open_id', $pos_open->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        if (!$elements->isEmpty()) {
            foreach ($elements as $element) {
                $units = $element->product->units;
                echo "<tr>";
                echo "<td>" . $element->product->product_name . "</td>";
                echo "<td>";
                ?>
                <select element_id='<?php echo $element->id; ?>' class='select_unit'>
                    <?php
                    foreach ($units as $unit) {
                        echo '<option
                     ';
                        if ($unit->id == $element->product_unit_id) {
                            echo "selected";
                        }
                        echo '
                     value="' . $unit->id . '">' . $unit->unit->unit_name . '</option>';
                    }
                    ?>
                </select>
                <?php
                echo "</td>";
                echo "<td><input dir='ltr' type='text' class='edit_price' element_id ='" . $element->id . "' style='width:100% !important;' value='" . $element->product_price . "' /></td>";
                echo "<td><input dir='ltr' type='text' class='edit_quantity' element_id ='" . $element->id . "' style='width:100% !important;' value='" . $element->quantity . "' /></td>";
                echo "<td><input dir='ltr' type='text' class='edit_quantity_price' element_id ='" . $element->id . "' style='width:100%!important;' value='" . $element->quantity_price . "' /></td>";
                echo "<td><a style='font-size: 20px!important;' class='btn btn-sm btn-info add_serials' data-toggle='modal' href='#modaldemo100'><i class='fa fa-barcode'></i></a></td>";
                echo "<td class='no-print'>
                        <button type='button' pos_open_number='" . $element->PosOpen->pos_open_number . "'
                            element_id='" . $element->id . "' class='btn btn-sm btn-danger remove_element'>
                            <i class='fa fa-trash'></i>
                        </button>
                    </td>";
                echo "</tr>";
            }
        }
        echo "
        <script>
            $(document).ready(function () {
                $('.edit_quantity').on('change',function () {
                    let element_id = $(this).attr('element_id');
                    let edit_quantity = $(this).val();
                    if (edit_quantity > 0){
                        $.post('/client/pos-open/edit-quantity', {
                            element_id: element_id,
                            edit_quantity: edit_quantity,
                            '_token': '" . csrf_token() . "'
                            }, function (data) {
                            $.post('/client/pos-open/elements',
                                {'_token': '" . csrf_token() . "'},
                                function (elements) {
                                    $('.bill_details').html(elements);
                                });
                                $.post('/client/pos-open/refresh',
                                {'_token': '" . csrf_token() . "'},
                                function (proto) {
                                    $('#items').html(proto.items);
                                    $('#total_quantity').html('('  + proto.total_quantity + ')');
                                    $('#sum').html(proto.sum);
                                    $('#total').html(proto.total);
                                    $('#final_total').val(proto.total);
                                    $('#tds_2').html(proto.percent);
                                    $('#tds').html(proto.discount_value);
                                });
                        var audioElement = document.createElement('audio');
                        audioElement.setAttribute('src', '" . asset('app-assets/mp3/beep.mp3') . "');
                        audioElement.play();
                        });
                    }
                    else{
                        alert('اكتب رقم صحيح اكبر من 0');
                    }
                });
                $('.edit_price').on('change', function () {
                    let element_id = $(this).attr('element_id');
                    let edit_price = $(this).val();
                    if (edit_price > 0) {
                        $.post('/client/pos-open/edit-price', {
                            element_id: element_id,
                            edit_price: edit_price,
                            '_token': '" . csrf_token() . "'
                        }, function (data) {
                            $.post('/client/pos-open/elements',
                                {'_token': '" . csrf_token() . "'},
                                function (elements) {
                                    $('.bill_details').html(elements);
                                });
                            $.post('/client/pos-open/refresh',
                                {'_token': '" . csrf_token() . "'},
                                function (proto) {
                                    $('#items').html(proto.items);
                                    $('#total_quantity').html('(' + proto.total_quantity + ')');
                                    $('#sum').html(proto.sum);
                                    $('#total').html(proto.total);
                                    $('#final_total').val(proto.total);
                                    $('#tds_2').html(proto.percent);
                                    $('#tds').html(proto.discount_value);
                                });
                            var audioElement = document.createElement('audio');
                            audioElement.setAttribute('src', '" . asset('app-assets/mp3/beep.mp3') . "');
                            audioElement.play();
                        });
                    } else {
                        alert('اكتب رقم صحيح اكبر من 0');
                    }

                });
                $('.edit_quantity_price').on('change', function () {
                    let element_id = $(this).attr('element_id');
                    let edit_quantity_price = $(this).val();
                    if (edit_quantity_price > 0) {
                        $.post('/client/pos-open/edit-quantity-price', {
                            element_id: element_id,
                            edit_quantity_price: edit_quantity_price,
                            '_token': '" . csrf_token() . "'
                        }, function (data) {
                            $.post('/client/pos-open/elements',
                                {'_token': '" . csrf_token() . "'},
                                function (elements) {
                                    $('.bill_details').html(elements);
                                });
                            $.post('/client/pos-open/refresh',
                                {'_token': '" . csrf_token() . "'},
                                function (proto) {
                                    $('#items').html(proto.items);
                                    $('#total_quantity').html('(' + proto.total_quantity + ')');
                                    $('#sum').html(proto.sum);
                                    $('#total').html(proto.total);
                                    $('#final_total').val(proto.total);
                                    $('#tds_2').html(proto.percent);
                                    $('#tds').html(proto.discount_value);
                                });
                            var audioElement = document.createElement('audio');
                            audioElement.setAttribute('src', '" . asset('app-assets/mp3/beep.mp3') . "');
                            audioElement.play();
                        });
                    } else {
                        alert('اكتب رقم صحيح اكبر من 0');
                    }

                });


                $('.remove_element').on('click',function () {
                    let element_id = $(this).attr('element_id');
                    $.post('/client/pos-open/delete-element', {
                        element_id: element_id,
                        '_token': '" . csrf_token() . "'
                        }, function (data) {
                        $.post('/client/pos-open/elements',
                            {'_token': '" . csrf_token() . "'},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });
                        $.post('/client/pos-open/refresh',
                                {'_token': '" . csrf_token() . "'},
                                function (proto) {
                                    $('#items').html(proto.items);
                                    $('#total_quantity').html('('  + proto.total_quantity + ')');
                                    $('#sum').html(proto.sum);
                                    $('#total').html(proto.total);
                                    $('#final_total').val(proto.total);
                                    $('#tds_2').html(proto.percent);
                                    $('#tds').html(proto.discount_value);
                                });
                                var audioElement = document.createElement('audio');
                        audioElement.setAttribute('src', '" . asset('app-assets/mp3/beep.mp3') . "');
                        audioElement.play();
                    });
                });
                $('.select_unit').on('change',function () {
                    let unit_id = $(this).val();
                    let element_id = $(this).attr('element_id');
                    $.post('/client/change-product-element-unit', {
                        unit_id: unit_id,
                        element_id: element_id,
                        '_token': '" . csrf_token() . "'
                    }, function (data) {
                        $.post('/client/pos-open/elements',
                            {'_token': '" . csrf_token() . "'},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });
                        $.post('/client/pos-open/refresh',
                            {'_token': '" . csrf_token() . "'},
                            function (proto) {
                                $('#items').html(proto.items);
                                $('#total_quantity').html(proto.total_quantity);
                                $('#sum').html(proto.sum);
                                $('#total').html(proto.total);
                                $('#final_total').val(proto.total);
                                $('#tds_2').html(proto.percent);
                                $('#tds').html(proto.discount_value);
                                $('#sale_bill_number').val(proto.pos_open_id);
                            });

                        var audioElement = document.createElement('audio');
                        audioElement.setAttribute('src', '" . asset('app-assets/mp3/beep.mp3') . "');
                        audioElement.play();
                    });
                });
                $('.add_serials').on('click', function () {
                    let element_id = $(this).parent().parent().find('.select_unit').attr('element_id');
                    let product_unit_id = $(this).parent().parent().find('.select_unit').val();
                    let quantity = $(this).parent().parent().find('.edit_quantity').val();
                    if (quantity <= 0) {
                        alert('الكمية غير مقبولة');
                    } else {
                        $.post('/client/add-serials-pos', {
                            quantity: quantity,
                            element_id: element_id,
                            product_unit_id: product_unit_id
                        }, function (data) {
                            $('.serials').html(data);
                        });
                    }
                });
            });
        </script>";
    }

    public function pending_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $notes = $request->notes;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        if (!empty($pos_open)) {
            $pos_open->update([
                'status' => 'pending',
                'notes' => $notes
            ]);
            return response()->json([
                'reason' => 'تم تعليق الفاتورة',
                'success' => 1
            ]);
        } else {
            return response()->json([
                'reason' => 'لا يوجد فاتورة لتعليقها',
                'success' => 0
            ]);
        }
    }

    public function restore_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $pos_open_id = $request->pos_open_id;
        $pos_open = PosOpen::FindOrFail($pos_open_id);
        if (!empty($pos_open)) {
            $pos_open->update([
                'status' => 'open'
            ]);
        }
    }

    public function refresh(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $elements = PosOpenElement::where('pos_open_id', $pos_open->id)->get();
        $pos_open_discount = PosOpenDiscount::where('pos_open_id', $pos_open->id)->first();
        $pos_open_tax = PosOpenTax::where('pos_open_id', $pos_open->id)->first();
        $items = 0;
        $sum = 0;
        $discount = 0;
        $total_quantity = 0;
        foreach ($elements as $element) {
            ++$items;
            $total_quantity = $total_quantity + $element->quantity;
            $sum = $sum + $element->quantity_price;
        }
        if (isset($pos_open)) {
            $total = $sum;
            $percent = 0;
            if (isset($pos_open_tax) || !empty($pos_open_tax)) {
                $tax_value = $pos_open_tax->tax_value;
            } else {
                $tax_value = 0;
            }
            if (isset($pos_open_discount) || !empty($pos_open_discount)) {
                $discount_value = $pos_open_discount->discount_value;
                $discount_type = $pos_open_discount->discount_type;
                if ($discount_type == "percent") {
                    $discount_value = ($discount_value / 100) * $sum;
                    $discount = $discount_value . " ( " . $pos_open_discount->discount_value . " % ) ";
                } else {
                    $discount = $discount_value;
                }
            } else {
                $discount_value = 0;
            }
            $total = $total - $discount_value;
            $percent = $tax_value / 100 * $total;
            $total = $total + $percent;
        }
        if (isset($pos_open_tax)) {
            return response()->json([
                'items' => $items,
                'total_quantity' => $total_quantity,
                'sum' => $sum,
                'total' => $total,
                'discount_value' => $discount,
                'percent' => $percent . " ( " . $pos_open_tax->tax_value . " %) ",
                'pos_open_id' => $pos_open->id
            ]);
        } else {
            return response()->json([
                'items' => $items,
                'total_quantity' => $total_quantity,
                'sum' => $sum,
                'total' => $total,
                'discount_value' => $discount,
                'percent' => $percent,
                'pos_open_id' => $pos_open->id
            ]);
        }
    }

    public function get_coupon_code(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $coupon_code = $request->coupon_code;
        $check = CouponCode::where('coupon_code', $coupon_code)
            ->first();
        if (!empty($check)) {
            $status = "success";
            $coupon_value = $check->coupon_value;
        }
        return response()->json([
            'status' => $status,
            'coupon_value' => $coupon_value,
        ]);
    }

    public function get_coupon_codes(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $outer_client_id = $request->outer_client_id;
        $coupon_codes = CouponCode::where('outer_client_id', $outer_client_id)
            ->orWhere('company_id', $company_id)
            ->orWhere('client_id', $client_id)
            ->where('status', 'new')
            ->get();
        foreach ($coupon_codes as $coupon_code) {
            $dept = $coupon_code->dept;
            if ($dept == "categories") {
                $dept_name = "خصم فئة";
            } else if ($dept == "products") {
                $dept_name = "خصم منتج";
            } else if ($dept == "outer_clients") {
                $dept_name = "خصم عميل";
            }
            echo '<option value="' . $coupon_code->coupon_code . '">' . $coupon_code->coupon_code . " - " . $dept_name . '</option>';
        }
    }

    public function finish_cash_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $final_total = $request->final_total;
        $client_id = Auth::user()->id;
        $client = Client::FindOrFail($client_id);
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $elements = $pos_open->elements;
        foreach ($elements as $element) {
            $product = Product::FindOrFail($element->product_id);
            $product_unit = $element->unit;
            $product_before_balance = $product_unit->first_balance;
            $product_after_balance = $product_before_balance - $element->quantity;
            $product_unit->update([
                'first_balance' => $product_after_balance
            ]);
        }
        if (!empty($pos_open)) {
            $branch = Branch::FindOrFail($client->branch_id);
            $pos_setting = PosSetting::where('company_id', $company_id)
                ->where('branch_id', $branch->id)
                ->first();
            $safe = Safe::FindOrFail($pos_setting->safe_id);
            $old_cash = Cash::max('cash_number');
            $pre_cash = ++$old_cash;
            $outer_client_id = $pos_open->outer_client_id;
            if (!empty($outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($outer_client_id);
                $balance_before = $outer_client->prev_balance;
                $balance_after = $balance_before - $final_total;
            } else {
                $balance_before = 0;
                $balance_after = 0;
            }
            $bill_id = "pos_" . $pos_open->id;
            $cash = Cash::create([
                'cash_number' => $pre_cash,
                'company_id' => $company_id,
                'client_id' => $client_id,
                'safe_id' => $safe->id,
                'outer_client_id' => $outer_client_id,
                'balance_before' => $balance_before,
                'balance_after' => $balance_after,
                'amount' => $final_total,
                'bill_id' => $bill_id,
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
            ]);
            $old_safe_balance = $safe->balance;
            $new_safe_balance = $old_safe_balance + $final_total;
            $safe->update([
                'balance' => $new_safe_balance
            ]);
            $pos_open->update([
                'status' => 'done'
            ]);
            return response()->json([
                'reason' => 'تم الدفع وحفظ الفاتورة',
                'success' => 1,
                'pos_id' => $pos_open->id,
            ]);
        } else {
            return response()->json([
                'reason' => 'لا يوجد فاتورة للدفع والحفظ',
                'success' => 0,
                'pos_id' => $pos_open->id,
            ]);
        }
    }

    public function finish_bank_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $final_total = $request->final_total;
        $client_id = Auth::user()->id;
        $client = Client::FindOrFail($client_id);
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $elements = $pos_open->elements;
        foreach ($elements as $element) {
            $product = Product::FindOrFail($element->product_id);
            $product_unit = $element->unit;
            $product_before_balance = $product_unit->first_balance;
            $product_after_balance = $product_before_balance - $element->quantity;
            $product_unit->update([
                'first_balance' => $product_after_balance
            ]);
        }
        if (!empty($pos_open)) {
            $branch = Branch::FindOrFail($client->branch_id);
            $pos_setting = PosSetting::where('company_id', $company_id)
                ->where('branch_id', $branch->id)
                ->first();
            $bank = Bank::FindOrFail($pos_setting->bank_id);
            $old_cash = BankCash::max('cash_number');
            $pre_cash = ++$old_cash;
            $outer_client_id = $pos_open->outer_client_id;
            if (!empty($outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($outer_client_id);
                $balance_before = $outer_client->prev_balance;
                $balance_after = $balance_before - $final_total;
            } else {
                $balance_before = 0;
                $balance_after = 0;
            }
            $bill_id = "pos_" . $pos_open->id;
            $cash = BankCash::create([
                'cash_number' => $pre_cash,
                'company_id' => $company_id,
                'client_id' => $client_id,
                'bank_id' => $bank->id,
                'outer_client_id' => $outer_client_id,
                'balance_before' => $balance_before,
                'balance_after' => $balance_after,
                'amount' => $final_total,
                'bill_id' => $bill_id,
                'date' => date('Y-m-d'),
                'time' => date('H:i:s'),
            ]);
            $old_bank_balance = $bank->bank_balance;
            $new_bank_balance = $old_bank_balance + $final_total;
            $bank->update([
                'bank_balance' => $new_bank_balance
            ]);
            $pos_open->update([
                'status' => 'done'
            ]);
            return response()->json([
                'reason' => 'تم الدفع وحفظ الفاتورة',
                'success' => 1,
                'pos_id' => $pos_open->id,
            ]);
        } else {
            return response()->json([
                'reason' => 'لا يوجد فاتورة للدفع والحفظ',
                'success' => 0,
                'pos_id' => $pos_open->id,
            ]);
        }
    }

    public function done_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $final_total = $request->final_total;
        $notes = $request->notes;
        $client_id = Auth::user()->id;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $elements = $pos_open->elements;
        foreach ($elements as $element) {
            $product = Product::FindOrFail($element->product_id);
            $product_unit = $element->unit;
            $product_before_balance = $product_unit->first_balance;
            $product_after_balance = $product_before_balance - $element->quantity;
            $product_unit->update([
                'first_balance' => $product_after_balance
            ]);
        }

        if (!empty($pos_open)) {
            $cash_id = "pos_" . $pos_open->id;
            $cash = Cash::where('bill_id', $cash_id)->get();
            if (!$cash->isEmpty()) {
                $cash_amount = 0;
                foreach ($cash as $item) {
                    $cash_amount = $cash_amount + $item->amount;
                }
            } else {
                $cash_amount = 0;
            }
            $bank_cash = BankCash::where('bill_id', $cash_id)->get();
            if (!$bank_cash->isEmpty()) {
                $cash_bank_amount = 0;
                foreach ($bank_cash as $item) {
                    $cash_bank_amount = $cash_bank_amount + $item->amount;
                }
            } else {
                $cash_bank_amount = 0;
            }

            $coupon_cash = CouponCash::where('bill_id', $cash_id)->get();
            if (!$coupon_cash->isEmpty()) {
                $cash_coupon_amount = 0;
                foreach ($coupon_cash as $item) {
                    $cash_coupon_amount = $cash_coupon_amount + $item->amount;
                }
            } else {
                $cash_coupon_amount = 0;
            }

            $total_amount = $cash_amount + $cash_bank_amount + $cash_coupon_amount;
            $rest = $final_total - $total_amount;
            if (isset($pos_open->outer_client_id) && !empty($pos_open->outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($pos_open->outer_client_id);
                $prev_balance = $outer_client->prev_balance;
                $new_balance = $prev_balance + $rest;
                $outer_client->update([
                    'prev_balance' => $new_balance
                ]);
            }
            $pos_open->update([
                'status' => 'done',
                'notes' => $notes
            ]);
            return response()->json([
                'reason' => 'تم حفظ الفاتورة',
                'success' => 1,
                'pos_id' => $pos_open->id,
            ]);
        } else {
            return response()->json([
                'reason' => 'لا يوجد فاتورة لحفظها',
                'success' => 0,
                'pos_id' => $pos_open->id,
            ]);
        }
    }


    public function check_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        if (!empty($pos_open)) {
            return response()->json([
                'reason' => '',
                'success' => 1
            ]);
        } else {
            return response()->json([
                'reason' => 'لابد من اضافة منتجات للفاتورة اولا',
                'success' => 0
            ]);
        }
    }

    public function print($pos_id)
    {
        $pos = PosOpen::FindOrFail($pos_id);
        return view('client.pos.print', compact('pos'));
    }

    public function show_shift_details($id)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $shift = PosShift::FindOrFail($id);
        $shift_report = ShiftReport::where('shift_id', $shift->id)->first();
        return view('client.pos.shift', compact('shift', 'company_id', 'shift_report', 'company'));
    }

    public function pos_sales_report()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $pos_sales = PosOpen::where('status', 'done')
            ->where('company_id', $company_id)->get();
        $shifts = PosShift::where('company_id', $company_id)
            ->where('status', 'closed')
            ->where('end_date_time', 'LIKE', '%' . date('Y-m-d') . '%')
            ->get();
        return view('client.pos.report', compact('company_id', 'shifts', 'company', 'pos_sales'));
    }

    public function pos_sales_report_print()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $pos_sales = PosOpen::where('status', 'done')
            ->where('company_id', $company_id)->get();
        return view('client.pos.print_report', compact('company_id', 'company', 'pos_sales'));
    }

    public function pos_edit(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $bill_id = $request->bill_id;
        $pos = PosOpen::where('id', $bill_id)->first();
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        $elements = $pos->elements;
        $pos_tax = $pos->tax;
        $pos_discount = $pos->discount;
        $sum = 0;
        foreach ($elements as $pos_element) {
            $sum = $sum + $pos_element->quantity_price;
        }
        if (isset($pos) && isset($pos_tax) && empty($pos_discount)) {
            $tax_value = $pos_tax->tax_value;
            $percent = $tax_value / 100 * $sum;
            $sum = $sum + $percent;
        } elseif (isset($pos) && isset($pos_discount) && empty($pos_tax)) {
            $discount_value = $pos_discount->discount_value;
            $discount_type = $pos_discount->discount_type;
            if ($discount_type == "pound") {
                $sum = $sum - $discount_value;
            } else {
                $discount_value = ($discount_value / 100) * $sum;
                $sum = $sum - $discount_value;
            }
        } elseif (isset($pos) && !empty($pos_discount) && !empty($pos_tax)) {
            $tax_value = $pos_tax->tax_value;
            $discount_value = $pos_discount->discount_value;
            $discount_type = $pos_discount->discount_type;
            if ($discount_type == "percent") {
                $discount_value = ($discount_value / 100) * $sum;
            }
            $tot = $sum - $discount_value;
            $percent = $tax_value / 100 * $tot;
            $sum = $sum - $discount_value + $percent;
        }


        if (!empty($pos)) {
            if (!empty($pos_open)) {
                $pos_open->update([
                    'status' => 'pending'
                ]);
            }

            $cash_id = "pos_" . $bill_id;
            $cash = Cash::where('bill_id', $cash_id)->get();
            if (!$cash->isEmpty()) {
                $cash_amount = 0;
                foreach ($cash as $item) {
                    $cash_amount = $cash_amount + $item->amount;
                }
            } else {
                $cash_amount = 0;
            }

            $bank_cash = BankCash::where('bill_id', $cash_id)->get();
            if (!$bank_cash->isEmpty()) {
                $cash_bank_amount = 0;
                foreach ($bank_cash as $item) {
                    $cash_bank_amount = $cash_bank_amount + $item->amount;
                }
            } else {
                $cash_bank_amount = 0;
            }

            $coupon_cash = CouponCash::where('bill_id', $cash_id)->get();
            if (!$coupon_cash->isEmpty()) {
                $cash_coupon_amount = 0;
                foreach ($coupon_cash as $item) {
                    $cash_coupon_amount = $cash_coupon_amount + $item->amount;
                    $item->coupon->update([
                        'status' => 'new'
                    ]);
                }
            } else {
                $cash_coupon_amount = 0;
            }
            $total_amount = $cash_amount + $cash_bank_amount + $cash_coupon_amount;
            $rest = $sum - $total_amount;

            if (isset($pos->outer_client_id) && !empty($pos->outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($pos->outer_client_id);
                $prev_balance = $outer_client->prev_balance;

                $new_balance = $prev_balance - $rest;
                $outer_client->update([
                    'prev_balance' => $new_balance
                ]);
            }


            $pos->update([
                'status' => 'open'
            ]);
            foreach ($elements as $element) {
                $product = Product::FindOrFail($element->product_id);
                $product_unit = $element->unit;
                $product_before_balance = $product_unit->first_balance;
                $product_after_balance = $product_before_balance + $element->quantity;
                $product_unit->update([
                    'first_balance' => $product_after_balance
                ]);
            }
            return response()->json([
                'message' => '',
                'success' => 1
            ]);
        } else {
            return response()->json([
                'message' => 'لا يوجد فاتورة مسجلة بهذا الرقم',
                'success' => 0
            ]);
        }
    }

    public function delete_pos_open(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $pos_open = PosOpen::where('client_id', $client_id)
            ->where('status', 'open')
            ->first();
        if (!empty($pos_open)) {
            $cash_id = "pos_" . $pos_open->id;
            $cash = Cash::where('bill_id', $cash_id)->get();
            if (!$cash->isEmpty()) {
                foreach ($cash as $item) {
                    $amount = $item->amount;
                    $safe = Safe::FindOrFail($item->safe_id);
                    $old_safe_balance = $safe->balance;
                    $new_safe_balance = $old_safe_balance - $amount;
                    $safe->update([
                        'balance' => $new_safe_balance
                    ]);
                    $item->delete();
                }
            }
            $bank_cash = BankCash::where('bill_id', $cash_id)->get();
            if (!$bank_cash->isEmpty()) {
                foreach ($bank_cash as $item) {
                    $amount = $item->amount;
                    $bank = Bank::FindOrFail($item->bank_id);
                    $old_bank_balance = $bank->bank_balance;
                    $new_bank_balance = $old_bank_balance - $amount;
                    $bank->update([
                        'bank_balance' => $new_bank_balance
                    ]);
                    $item->delete();
                }
            }
            $coupon_cash = CouponCash::where('bill_id', $cash_id)->get();
            if (!$coupon_cash->isEmpty()) {
                foreach ($coupon_cash as $item) {
                    $item->coupon->update([
                        'status' => 'new'
                    ]);
                    $item->delete();
                }
            }

            $pos_open->delete();
            return response()->json([
                'reason' => 'تم الغاء الفاتورة',
                'success' => 1
            ]);
        } else {
            return response()->json([
                'reason' => 'لا يوجد فاتورة لحذفها',
                'success' => 0
            ]);
        }
    }

    public function pos_delete(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $bill_id = $request->bill_id;
        $pos = PosOpen::where('id', $bill_id)->first();
        $elements = $pos->elements;
        $pos_tax = $pos->tax;
        $pos_discount = $pos->discount;
        $sum = 0;
        foreach ($elements as $pos_element) {
            $sum = $sum + $pos_element->quantity_price;
        }
        if (isset($pos) && isset($pos_tax) && empty($pos_discount)) {
            $tax_value = $pos_tax->tax_value;
            $percent = $tax_value / 100 * $sum;
            $sum = $sum + $percent;
        } elseif (isset($pos) && isset($pos_discount) && empty($pos_tax)) {
            $discount_value = $pos_discount->discount_value;
            $discount_type = $pos_discount->discount_type;
            if ($discount_type == "pound") {
                $sum = $sum - $discount_value;
            } else {
                $discount_value = ($discount_value / 100) * $sum;
                $sum = $sum - $discount_value;
            }
        } elseif (isset($pos) && !empty($pos_discount) && !empty($pos_tax)) {
            $tax_value = $pos_tax->tax_value;
            $discount_value = $pos_discount->discount_value;
            $discount_type = $pos_discount->discount_type;
            if ($discount_type == "percent") {
                $discount_value = ($discount_value / 100) * $sum;
            }
            $tot = $sum - $discount_value;
            $percent = $tax_value / 100 * $tot;
            $sum = $sum - $discount_value + $percent;
        }

        if (!empty($pos)) {
            $cash_id = "pos_" . $bill_id;
            $cash = Cash::where('bill_id', $cash_id)->get();
            if (!$cash->isEmpty()) {
                $cash_amount = 0;
                foreach ($cash as $item) {
                    $cash_amount = $cash_amount + $item->amount;
                    $amount = $item->amount;
                    $safe = Safe::FindOrFail($item->safe_id);
                    $old_safe_balance = $safe->balance;
                    $new_safe_balance = $old_safe_balance - $amount;
                    $safe->update([
                        'balance' => $new_safe_balance
                    ]);
                    $item->delete();
                }
            } else {
                $cash_amount = 0;
            }

            $bank_cash = BankCash::where('bill_id', $cash_id)->get();
            if (!$bank_cash->isEmpty()) {
                $cash_bank_amount = 0;
                foreach ($bank_cash as $item) {
                    $cash_bank_amount = $cash_bank_amount + $item->amount;
                    $amount = $item->amount;
                    $bank = Bank::FindOrFail($item->bank_id);
                    $old_bank_balance = $bank->bank_balance;
                    $new_bank_balance = $old_bank_balance - $amount;
                    $bank->update([
                        'bank_balance' => $new_bank_balance
                    ]);
                    $item->delete();
                }
            } else {
                $cash_bank_amount = 0;
            }

            $coupon_cash = CouponCash::where('bill_id', $cash_id)->get();
            if (!$coupon_cash->isEmpty()) {
                $cash_coupon_amount = 0;
                foreach ($coupon_cash as $item) {
                    $cash_coupon_amount = $cash_coupon_amount + $item->amount;
                    $item->coupon->update([
                        'status' => 'new'
                    ]);
                    $item->delete();
                }
            } else {
                $cash_coupon_amount = 0;
            }
            $total_amount = $cash_amount + $cash_bank_amount + $cash_coupon_amount;
            $rest = $sum - $total_amount;

            if (isset($pos->outer_client_id) && !empty($pos->outer_client_id)) {
                $outer_client = OuterClient::FindOrFail($pos->outer_client_id);
                $prev_balance = $outer_client->prev_balance;

                $new_balance = $prev_balance - $rest;
                $outer_client->update([
                    'prev_balance' => $new_balance
                ]);
            }
        }
        foreach ($elements as $element) {
            $product = Product::FindOrFail($element->product_id);
            $product_unit = $element->unit;
            $product_before_balance = $product_unit->first_balance;
            $product_after_balance = $product_before_balance + $element->quantity;
            $product_unit->update([
                'first_balance' => $product_after_balance
            ]);
        }
        $pos->delete();
        return response()->json([
            'message' => 'تم حذف الفاتورة بنجاح',
            'success' => 1,
        ]);
    }

    function pay_delete(Request $request)
    {
        $payment_method = $request->payment_method;
        $cash_id = $request->cash_id;
        if ($payment_method == "cash") {
            $cash = Cash::FindOrFail($cash_id);
            $amount = $cash->amount;
            $safe = Safe::FindOrFail($cash->safe_id);
            $old_safe_balance = $safe->balance;
            $new_safe_balance = $old_safe_balance - $amount;
            $safe->update([
                'balance' => $new_safe_balance
            ]);
            $cash->delete();
        } elseif ($payment_method == "coupon") {
            $cash = CouponCash::FindOrFail($cash_id);
            $cash->coupon->update([
                'status' => 'new'
            ]);
            $cash->delete();
        } elseif ($payment_method == "bank") {
            $cash = BankCash::FindOrFail($cash_id);
            $amount = $cash->amount;
            $bank = Bank::FindOrFail($cash->bank_id);
            $old_bank_balance = $bank->bank_balance;
            $new_bank_balance = $old_bank_balance - $amount;
            $bank->update([
                'bank_balance' => $new_bank_balance
            ]);
            $cash->delete();
        }
    }

    public function store_cash_clients(Request $request)
    {
        $this->validate($request, [
            'cash_number' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $data = $request->all();
        $company_id = $data['company_id'];
        $data['client_id'] = Auth::user()->id;
        $outer_client_id = $data['outer_client_id'];
        $amount = $data['amount'];
        if (!empty($outer_client_id)) {
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
            $cash = Cash::create($data);
            $safe = Safe::FindOrFail($request->safe_id);
            $old_safe_balance = $safe->balance;
            $new_safe_balance = $old_safe_balance + $amount;
            $safe->update([
                'balance' => $new_safe_balance
            ]);
        } elseif ($payment_method == "coupon") {
            $coupon = CouponCode::where('coupon_code', $request->coupon_code)->first();
            $coupon_id = $coupon->id;
            $data['coupon_id'] = $coupon_id;
            $cash = CouponCash::create($data);
        } else {
            $cash = BankCash::create($data);
            $bank = Bank::FindOrFail($request->bank_id);
            $old_bank_balance = $bank->bank_balance;
            $new_bank_balance = $old_bank_balance + $amount;
            $bank->update([
                'bank_balance' => $new_bank_balance
            ]);
        }
        if ($cash) {
            if ($payment_method == "cash") {
                $pay_method = 'دفع نقدى كاش ';
            } elseif ($payment_method == "bank") {
                $pay_method = 'دفع بنكى شبكة ';
            } elseif ($payment_method == "coupon") {
                $pay_method = 'دفع كوبون خصم ';
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
                'msg' => 'هناك خطأ فى تسجيل الدفع حاول مرة اخرى',
            ]);
        }
    }
}
