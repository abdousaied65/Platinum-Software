<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cash;
use App\Models\Category;
use App\Models\Company;
use App\Models\Delegate;
use App\Models\DeviceIssue;
use App\Models\DeviceType;
use App\Models\Engineer;
use App\Models\ExtraSettings;
use App\Models\MaintenanceBill;
use App\Models\MaintenanceBillElement;
use App\Models\MaintenanceDevice;
use App\Models\MaintenancePlace;
use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Safe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MaintenanceController extends Controller
{
    public function maintenance_settings_view()
    {
        $client_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $devices_types = DeviceType::where('company_id', $company_id)->get();
        $devices_issues = DeviceIssue::where('company_id', $company_id)->get();
        $delegates = Delegate::where('company_id', $company_id)->get();
        $maintenance_places = MaintenancePlace::where('company_id', $company_id)->get();
        return view('client.maintenance.settings', compact('company_id', 'delegates', 'maintenance_places', 'devices_types', 'devices_issues', 'client_id'));
    }

    public function maintenance_device_post(Request $request)
    {
        $data = $request->all();
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $device_type = DeviceType::create($data);
        return redirect()->route('maintenance.settings.view')->with('success', 'تم اضافة نوع جهاز جديد');
    }

    public function maintenance_device_delete(Request $request)
    {
        $device_type_id = $request->device_type_id;
        $device_type = DeviceType::FindOrFail($device_type_id);
        $device_type->delete();
        return redirect()->route('maintenance.settings.view')->with('success', 'تم حذف نوع الجهاز');
    }

    public function maintenance_issue_post(Request $request)
    {
        $data = $request->all();
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $device_issue = DeviceIssue::create($data);
        return redirect()->route('maintenance.settings.view')->with('success', 'تم اضافة مشكلة جهاز جديدة');
    }

    public function maintenance_issue_delete(Request $request)
    {
        $issue_id = $request->issue_id;
        $device_issue = DeviceIssue::FindOrFail($issue_id);
        $device_issue->delete();
        return redirect()->route('maintenance.settings.view')->with('success', 'تم حذف مشكلة الجهاز');
    }

    public function maintenance_delegate_post(Request $request)
    {
        $data = $request->all();
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $delegate = Delegate::create($data);
        return redirect()->route('maintenance.settings.view')->with('success', 'تم اضافة مندوب صيانة جديد');
    }

    public function maintenance_delegate_delete(Request $request)
    {
        $delegate_id = $request->delegate_id;
        $delegate = Delegate::FindOrFail($delegate_id);
        $delegate->delete();
        return redirect()->route('maintenance.settings.view')->with('success', 'تم حذف مندوب صيانة');
    }

    public function maintenance_place_post(Request $request)
    {
        $data = $request->all();
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $place = MaintenancePlace::create($data);
        return redirect()->route('maintenance.settings.view')->with('success', 'تم اضافة مكان صيانة جديد');
    }

    public function maintenance_place_delete(Request $request)
    {
        $place_id = $request->place_id;
        $place = MaintenancePlace::FindOrFail($place_id);
        $place->delete();
        return redirect()->route('maintenance.settings.view')->with('success', 'تم حذف مكان صيانة');
    }

    public function get_maintenance_device()
    {
        $client_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $stores = $company->stores;
        $devices_types = DeviceType::where('company_id', $company_id)->get();
        $devices_issues = DeviceIssue::where('company_id', $company_id)->get();
        $check = MaintenanceDevice::all();
        if ($check->isEmpty()) {
            $receipt_number = 1;
        } else {
            $old_receipt_number = MaintenanceDevice::max('receipt_number');
            $receipt_number = ++$old_receipt_number;
        }
        return view('client.maintenance.get_maintenance_device',
            compact('company', 'receipt_number', 'devices_issues', 'devices_types', 'company_id', 'stores'));
    }

    public function post_maintenance_device(Request $request)
    {
        $data = $request->all();
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $maintenance_device = MaintenanceDevice::create($data);
        if ($request->hasFile('device_pic')) {
            $device_pic = $request->file('device_pic');
            $fileName = $device_pic->getClientOriginalName();
            $uploadDir = 'uploads/devices/' . $maintenance_device->id;
            $device_pic->move($uploadDir, $fileName);
            $maintenance_device->device_pic = $uploadDir . '/' . $fileName;
            $maintenance_device->save();
        }
        $maintenance_bill = MaintenanceBill::where('company_id', $data['company_id'])
            ->where('maintenance_device_id', $maintenance_device->id)
            ->first();
        if (!empty($maintenance_bill)) {
            $bill_id = $maintenance_bill->bill_id;
        } else {
            $check = MaintenanceBill::all();
            if ($check->isEmpty()) {
                $bill_id = 1;
            } else {
                $old_bill_id = MaintenanceBill::max('bill_id');
                $bill_id = ++$old_bill_id;
            }
        }
        $data['bill_id'] = $bill_id;
        $data['maintenance_device_id'] = $maintenance_device->id;
        $data['engineer_evaluation'] = 'لم يوافق';
        $data['owner_approval'] = 'موافق';
        $data['date'] = date('Y-m-d');
        MaintenanceBill::create($data);
        return redirect()->route('maintenance.devices')
            ->with('success', 'تم استلام الجهاز بنجاح');
    }

    public function maintenance_devices()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $maintenance_devices = MaintenanceDevice::where('company_id', $company_id)->get();
        return view('client.maintenance.maintenance_devices',
            compact('company', 'company_id', 'maintenance_devices'));
    }

    public function maintenance_bill_create($id = null)
    {
        $client_id = Auth::user()->id;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $maintenance_devices = $company->maintenance_devices;
        $engineers = $company->engineers;
        $stores = $company->stores;
        $category = Category::where('company_id', $company_id)
            ->where('category_type', 'قطع غيار الصيانة')
            ->first();
        $maintenance_bill = MaintenanceBill::where('company_id', $company_id)
            ->where('maintenance_device_id', $id)
            ->first();
        if (!empty($maintenance_bill)) {
            $bill_id = $maintenance_bill->bill_id;
        } else {
            $check = MaintenanceBill::all();
            if ($check->isEmpty()) {
                $bill_id = 1;
            } else {
                $old_bill_id = MaintenanceBill::max('bill_id');
                $bill_id = ++$old_bill_id;
            }
        }
        if(!empty($category)){
            $products = $category->products;
        }
        else{
            $products = $company->products;
        }
        $devices_types = DeviceType::where('company_id', $company_id)->get();
        $devices_issues = DeviceIssue::where('company_id', $company_id)->get();
        $delegates = Delegate::where('company_id', $company_id)->get();
        $maintenance_places = MaintenancePlace::where('company_id', $company_id)->get();
        $check = Cash::all();
        if ($check->isEmpty()) {
            $pre_cash = 1;
        } else {
            $old_cash = Cash::max('cash_number');
            $pre_cash = ++$old_cash;
        }
        $safes = $company->safes;
        $banks = $company->banks;
        if ($id != null) {
            $maintenance_device = MaintenanceDevice::FindOrFail($id);
            return view('client.maintenance.maintenance_bill', compact('banks', 'safes', 'pre_cash', 'maintenance_bill', 'bill_id', 'company_id', 'delegates', 'maintenance_places', 'devices_types', 'devices_issues', 'maintenance_device', 'products', 'stores', 'company', 'engineers', 'client_id', 'maintenance_devices'));
        } else {
            return view('client.maintenance.maintenance_bill', compact('banks', 'safes', 'pre_cash', 'maintenance_bill', 'bill_id', 'company_id', 'delegates', 'maintenance_places', 'products', 'devices_types', 'devices_issues', 'stores', 'company', 'engineers', 'client_id', 'maintenance_devices'));
        }
    }

    public function get_product_price(Request $request)
    {
        $product_id = $request->product_id;
        $product_unit = ProductUnit::where('product_id', $product_id)
            ->where('first_balance', '>', 0)
            ->where('type', 'نعم')
            ->first();
        $sector_price = $product_unit->sector_price;
        $first_balance = $product_unit->first_balance;

        return response()->json([
            'sector_price' => $sector_price,
            'first_balance' => $first_balance,
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $data['client_id'] = Auth::user()->id;
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::where('bill_id', $bill_id)
            ->first();
        if (empty($MaintenanceBill)) {
            $MaintenanceBill = MaintenanceBill::create($data);
        }
        $data['maintenance_bill_id'] = $MaintenanceBill->id;
        $check = MaintenanceBillElement::where('maintenance_bill_id', $MaintenanceBill->id)
            ->where('product_id', $request->product_id)
            ->where('company_id', $request->company_id)
            ->first();
        if (empty($check)) {
            $check = MaintenanceBillElement::create($data);
        } else {
            $old_quantity = $check->quantity;
            $new_quantity = $old_quantity + $request->quantity;
            $product_price = $request->product_price;
            $new_quantity_price = $new_quantity * $product_price;
            $check->update([
                'product_price' => $product_price,
                'quantity' => $new_quantity,
                'quantity_price' => $new_quantity_price,
            ]);
        }
        $product = Product::FindOrFail($check->product_id);
        $product_unit = ProductUnit::where('product_id', $product->id)
            ->where('first_balance', '>', 0)
            ->where('type', 'نعم')
            ->first();
        $old_product_balance = $product_unit->first_balance;
        $new_product_balance = $old_product_balance - $check->quantity;
        $product_unit->update([
            'first_balance' => $new_product_balance
        ]);
    }

    public function get_maintenance_bill_elements(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $bill_id = $request->bill_id;
        $maintenance_bill = MaintenanceBill::where('bill_id', $bill_id)->first();
        $elements = MaintenanceBillElement::where('maintenance_bill_id', $maintenance_bill->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            $i = 0;
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
                echo "<tr>";
                echo "<td>" . $element->product->product_name . "</td>";
                echo "<td>" . $element->product_price . "</td>";
                echo "<td>" . $element->quantity . "</td>";
                echo "<td>" . $element->quantity_price . "</td>";
                echo "<td class='no-print'>
                    <button type='button' bill_id='" . $element->MaintenanceBill->bill_id . "' element_id='" . $element->id . "' class='btn btn-sm btn-danger remove_element'>
                        <i class='fa fa-trash'></i>
                    </button>
                </td>";
                echo "</tr>";
            }
        }
        echo "<script>
        $('.remove_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let bill_id = $(this).attr('bill_id');
            $.post('/client/maintenance-bills/element/delete',
                {'_token': '" . csrf_token() . "', element_id: element_id},
                function (data) {
                    $.post('/client/maintenance-bills/elements',
                        {'_token': '" . csrf_token() . "', bill_id: bill_id},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                });
            $.post('/client/maintenance-bills/refresh',
                {'_token': '" . csrf_token() . "',bill_id: bill_id},
                function (proto) {
                    $('[name*=spare_parts_cost]').val(proto.total).trigger('change');
                    $('#bill_total').html(proto.total);
                });
            $(this).parent().parent().fadeOut(300);
        });
        </script>";
    }

    public function refresh(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $bill_id = $request->bill_id;
        $maintenance_bill = MaintenanceBill::where('bill_id', $bill_id)->first();
        $elements = $maintenance_bill->elements;
        $total = 0;
        foreach ($elements as $element) {
            $total = $total + $element->quantity_price;
        }
        return response()->json([
            'total' => $total,
        ]);
    }

    public function delete_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = MaintenanceBillElement::FindOrFail($element_id);
        $element->delete();
        $product = Product::FindOrFail($element->product_id);
        $product_unit = ProductUnit::where('product_id', $product->id)
            ->where('first_balance', '>', 0)
            ->where('type', 'نعم')
            ->first();
        $old_product_balance = $product_unit->first_balance;
        $new_product_balance = $old_product_balance + $element->quantity;
        $product_unit->update([
            'first_balance' => $new_product_balance
        ]);

    }

    public function delete_bill(Request $request)
    {
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::where('bill_id', $bill_id)->first();
        if (!empty($MaintenanceBill)) {
            $elements = $MaintenanceBill->elements;
            foreach ($elements as $element) {
                $element->delete();
            }
            $MaintenanceBill->delete();
        }
    }

    public function saveAll(Request $request)
    {
        $data = $request->all();
        $company_id = $request->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $data['client_id'] = $client_id;
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::where('bill_id', $bill_id)
            ->first();
        if (empty($MaintenanceBill)) {
            $MaintenanceBill = MaintenanceBill::create($data);
        } else {
            $MaintenanceBill->update($data);
        }
    }

    public function total_cost(Request $request)
    {
        $repair_cost = $request->repair_cost;
        $delegate_cost = $request->delegate_cost;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $tax_value_added = $company->tax_value_added;
        $total = $repair_cost + $delegate_cost;
        $tax = $tax_value_added / 100 * $total;
        $total_cost = $total + $tax;
        return response()->json([
            'total_cost' => $total_cost,
        ]);
    }

    public function total_cost_2(Request $request)
    {
        $spare_parts_cost = $request->spare_parts_cost;
        $maintenance_cost = $request->maintenance_cost;
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $tax_value_added = $company->tax_value_added;
        $total = $spare_parts_cost + $maintenance_cost;
        $tax = $tax_value_added / 100 * $total;
        $total_cost = $total + $tax;
        return response()->json([
            'total_cost' => $total_cost,
        ]);
    }

    public function engineer_percent(Request $request)
    {
        $bill_id = $request->bill_id;
        $engineer_id = $request->engineer_id;
        $engineer = Engineer::FindOrFail($engineer_id);
        $commission_rate = $engineer->commission_rate;

        $delegate_cost = $request->delegate_cost;
        $maintenance_cost = $request->maintenance_cost;

        $MaintenanceBill = MaintenanceBill::where('bill_id', $bill_id)->first();
        if (empty($MaintenanceBill)) {
            $engineer_percent = 0;
        } else {
            if ($MaintenanceBill->maintenance_cost == "0") {
                if (empty($delegate_cost)) {
                    $cost = $MaintenanceBill->delegate_cost;
                } else {
                    $cost = $delegate_cost;
                }
            } else {
                if (empty($maintenance_cost)) {
                    $cost = $MaintenanceBill->maintenance_cost;
                } else {
                    $cost = $maintenance_cost;
                }
            }
            $engineer_percent = $commission_rate / 100 * $cost;
        }
        return response()->json([
            'engineer_percent' => $engineer_percent,
        ]);
    }

    public function print_device_receipt($id)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $maintenance_device = MaintenanceDevice::FindOrFail($id);
        return view('client.maintenance.print_device_receipt', compact('maintenance_device', 'company'));
    }

    public function receipt_page_login()
    {
        return view('client.maintenance.receipt_page_login');
    }

    public function receipt_page_login_post(Request $request)
    {
        $device_owner_phone = $request->device_owner_phone;
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::where('bill_id', $bill_id)
            ->first();
        if (!empty($MaintenanceBill)) {
            $old_phone_number = $MaintenanceBill->MaintenanceDevice->device_owner_phone;
            if ($device_owner_phone == $old_phone_number) {
                return redirect()->route('receipt.page', $MaintenanceBill->id);
            } else {
                echo('wrong phone number');
                return redirect()->route('receipt.page.login')->withInput()->with('error', 'رقم الهاتف غير صحيح');
            }
        } else {
            return redirect()->route('receipt.page.login')->withInput()->with('error', 'رقم الفاتورة غير صحيح');
        }
    }

    public function receipt_page($id)
    {
        $MaintenanceBill = MaintenanceBill::FindOrFail($id);
        $MaintenanceDevice = $MaintenanceBill->MaintenanceDevice;
        return view('client.maintenance.receipt_page', compact('MaintenanceBill', 'MaintenanceDevice'));
    }

    public function accept_cost(Request $request)
    {
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::FindOrFail($bill_id);
        $MaintenanceBill->update([
            'status' => 'فى انتظار التسليم'
        ]);
        return response()->json([
            'status' => 'done',
        ]);
    }

    public function deny_cost(Request $request)
    {
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::FindOrFail($bill_id);
        $MaintenanceBill->update([
            'status' => 'العميل غير موافق على التكلفة ورفض الاستلام'
        ]);
        return response()->json([
            'status' => 'done',
        ]);
    }

    public function hand_over(Request $request)
    {
        $bill_id = $request->bill_id;
        $MaintenanceBill = MaintenanceBill::FindOrFail($bill_id);
        $total_cost = $MaintenanceBill->total_cost;
        $company_id = $MaintenanceBill->company->id;

        $safe = Safe::where('company_id',$company_id)->where('type','main')->first();
        $old_balance = $safe->balance;
        $new_balance = $old_balance + $total_cost;
        $safe->update([
            'balance' => $new_balance,
        ]);
        $MaintenanceBill->update([
            'status' => 'تم التسليم الى العميل'
        ]);
        return response()->json([
            'status' => 'done',
        ]);
    }

    public function maintenance_bills()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $maintenance_devices = MaintenanceDevice::where('company_id', $company_id)->get();
        return view('client.maintenance.maintenance_bills',
            compact('company', 'company_id', 'maintenance_devices'));

    }

}

