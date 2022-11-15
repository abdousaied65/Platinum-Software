<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Mail\sendingQuotation;
use App\Models\BuyBill;
use App\Models\BuyCash;
use App\Models\Company;
use App\Models\ExtraSettings;
use App\Models\OuterClient;

use App\Models\Product;
use App\Models\ProductUnit;
use App\Models\Quotation;
use App\Models\QuotationElement;
use App\Models\QuotationExtra;
use App\Models\SaleBill;
use App\Models\SaleBillElement;
use App\Models\SaleBillExtra;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{

    public function index()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $quotations = $company->quotations;
        $outer_clients = $company->outerClients;
        $products = $company->products;
        return view('client.quotations.index', compact('company', 'products', 'company_id', 'outer_clients', 'quotations'));
    }

    public function filter_code(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = $company->products;
        $quotations = $company->quotations;
        $outer_clients = $company->outerClients;

        $product_id = $request->code_universal;
        $product_k = Product::FindOrFail($product_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $quotation_elements = QuotationElement::where('product_id', $product_k->id)->get();
        $arr = array();
        foreach ($quotation_elements as $quotation_element) {
            $quotation = $quotation_element->quotation;
            $quotation_id = $quotation->id;
            array_push($arr, $quotation_id);
        }
        $my_array = array_unique($arr);
        $product_quotations = Quotation::whereIn('id', $my_array)->get();
        return view('client.quotations.index', compact('currency', 'product_k', 'products', 'product_quotations', 'quotations', 'outer_clients', 'company'));
    }

    public function filter_product(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = $company->products;
        $quotations = $company->quotations;
        $outer_clients = $company->outerClients;

        $product_id = $request->product_name;
        $product_k = Product::FindOrFail($product_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $quotation_elements = QuotationElement::where('product_id', $product_k->id)->get();
        $arr = array();
        foreach ($quotation_elements as $quotation_element) {
            $quotation = $quotation_element->quotation;
            $quotation_id = $quotation->id;
            array_push($arr, $quotation_id);
        }
        $my_array = array_unique($arr);
        $product_quotations = Quotation::whereIn('id', $my_array)->get();
        return view('client.quotations.index', compact('currency', 'product_k', 'products', 'product_quotations', 'quotations', 'outer_clients', 'company'));
    }

    public function filter_client(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);

        $products = $company->products;
        $quotations = $company->quotations;
        $outer_clients = $company->outerClients;

        $outer_client_id = $request->outer_client_id;
        $outer_client_k = OuterClient::FindOrFail($outer_client_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $client_quotations = Quotation::where('outer_client_id', $outer_client_k->id)->get();

        return view('client.quotations.index', compact('currency', 'products', 'outer_client_k', 'client_quotations', 'quotations', 'outer_clients', 'company'));
    }

    public function filter_all(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = $company->products;
        $quotations = $company->quotations;
        $outer_clients = $company->outerClients;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $all_quotations = $company->quotations;
        return view('client.quotations.index', compact('currency', 'products', 'all_quotations', 'quotations', 'outer_clients', 'company'));
    }

    public function filter_key(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);

        $products = $company->products;
        $quotations = $company->quotations;
        $outer_clients = $company->outerClients;

        $quotation_id = $request->quotation_id;

        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;

        $quotation_k = Quotation::FindOrFail($quotation_id);
        $elements = $quotation_k->elements;
        $extras = $quotation_k->extras;
        foreach ($extras as $key) {
            if ($key->action == "discount") {
                if ($key->action_type == "pound") {
                    $quotation_discount_value = $key->value;
                    $quotation_discount_type = "pound";
                } else {
                    $quotation_discount_value = $key->value;
                    $quotation_discount_type = "percent";
                }
            } else {
                if ($key->action_type == "pound") {
                    $quotation_extra_value = $key->value;
                    $quotation_extra_type = "pound";
                } else {
                    $quotation_extra_value = $key->value;
                    $quotation_extra_type = "percent";
                }
            }
        }
        if ($extras->isEmpty()) {
            $quotation_discount_value = 0;
            $quotation_extra_value = 0;
            $quotation_discount_type = "pound";
            $quotation_extra_type = "pound";
        }
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);

        $previous_extra = QuotationExtra::where('quotation_id', $quotation_k->id)
            ->where('action', 'extra')->first();
        if (!empty($previous_extra)) {
            $previous_extra_type = $previous_extra->action_type;
            $previous_extra_value = $previous_extra->value;
            if ($previous_extra_type == "percent") {
                $previous_extra_value = $previous_extra_value / 100 * $total;
            }
            $after_discount = $total + $previous_extra_value;
        }


        $previous_discount = QuotationExtra::where('quotation_id', $quotation_k->id)
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

        return view('client.quotations.index',
            compact('currency', 'after_discount', 'after_total_all', 'quotation_k', 'quotations', 'outer_clients'
                , 'elements', 'extras', 'products', 'company', 'quotation_discount_value', 'quotation_discount_type', 'quotation_extra_value', 'quotation_extra_type'));
    }

    public function send($id)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $quotation = Quotation::where('quotation_number', $id)->first();
        $tax_value_added = $company->tax_value_added;
        $elements = $quotation->elements;
        $sum = array();
        foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);
        $previous_extra = QuotationExtra::where('quotation_id', $quotation->id)
            ->where('action', 'extra')->first();
        if (!empty($previous_extra)) {
            $previous_extra_type = $previous_extra->action_type;
            $previous_extra_value = $previous_extra->value;
            if ($previous_extra_type == "percent") {
                $previous_extra_value = $previous_extra_value / 100 * $total;
            }
            $after_discount = $total + $previous_extra_value;
        }
        $previous_discount = QuotationExtra::where('quotation_id', $quotation->id)
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
        $data = array(
            'quotation' => $quotation,
            'body' => 'بيانات عرض السعر',
            'elements' => $quotation->elements,
            'extras' => $quotation->extras,
            'subject' => 'مرفق مع هذه الرسالة بيانات تفصيلية لعرض السعر',
            'company' => $company,
            'after_total_all' => $after_total_all,
            'currency' => $currency,
        );
        Mail::to($quotation->outerClient->client_email)->send(new sendingQuotation($data));
        return redirect()->route('client.quotations.index')
            ->with('success', 'تم  ارسال عرض السعر  الى بريد العميل بنجاح');

    }

    public function show($id)
    {
        dd($id);
    }

    public function create()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $categories = $company->categories;
        $all_products = Product::where('company_id', $company_id)->get();
        $stores = $company->stores;
        $units = $company->units;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $outer_clients = OuterClient::where('company_id', $company_id)->get();
        $check = Quotation::all();
        if ($check->isEmpty()) {
            $pre_quotation = 1;
        } else {
            $old_quotation = Quotation::max('quotation_number');
            $pre_quotation = ++$old_quotation;
        }
        return view('client.quotations.create',
            compact('company', 'outer_clients', 'units', 'stores', 'categories', 'extra_settings', 'company_id', 'all_products', 'pre_quotation'));
    }

    public function get_product_price(Request $request)
    {
        $product_id = $request->product_id;
        $outer_client_id = $request->outer_client_id;
        $product = Product::FindOrFail($product_id);
        $product_unit = ProductUnit::where('product_id', $product_id)
            ->where('first_balance', '>', 0)
            ->where('type', 'نعم')
            ->first();
        $outer_client = OuterClient::FindOrFail($outer_client_id);
        $client_category = $outer_client->client_category;
        $sector_price = $product_unit->sector_price;
        $wholesale_price = $product_unit->wholesale_price;
        $first_balance = $product_unit->first_balance;
        if ($client_category == "جملة") {
            $order_price = $wholesale_price;
        } elseif ($client_category == "قطاعى") {
            $order_price = $sector_price;
        }
        return response()->json([
            'order_price' => $order_price,
            'first_balance' => $first_balance . ' ' . $product_unit->unit->unit_name
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = Auth::user()->company_id;
        $company = Company::FindOrFail($data['company_id']);
        $data['client_id'] = Auth::user()->id;
        $quotation = Quotation::where('quotation_number', $data['quotation_number'])->first();
        if (empty($quotation)) {
            $quotation = Quotation::create($data);
        } else {
            $quotation->update($data);
        }
        $data['quotation_id'] = $quotation->id;
        $data['company_id'] = $company->id;
        $product_unit_id = $request->product_unit_id;
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $check = QuotationElement::where('quotation_id', $quotation->id)
            ->where('product_id', $request->product_id)
            ->where('product_unit_id', $request->product_unit_id)
            ->where('company_id', $company->id)
            ->first();
        if (empty($check)) {
            $quotation_element = QuotationElement::create($data);
        } else {
            $old_quantity = $check->quantity;
            $new_quantity = $old_quantity + $request->quantity;
            $product_price = $request->product_price;
            $new_quantity_price = $new_quantity * $product_price;
            $product_unit_id = $request->product_unit_id;
            $quotation_element = $check->update([
                'product_price' => $product_price,
                'quantity' => $new_quantity,
                'product_unit_id' => $product_unit_id,
                'quantity_price' => $new_quantity_price,
            ]);
        }

        if ($quotation && $quotation_element) {
            $all_elements = QuotationElement::where('quotation_id', $quotation->id)->get();
            return response()->json([
                'status' => true,
                'msg' => 'تمت الاضافة الى عرض السعر بنجاح',
                'all_elements' => $all_elements,
            ]);
        } else {
            $all_elements = QuotationElement::where('quotation_id', $quotation->id)->get();
            return response()->json([
                'status' => false,
                'msg' => 'هناك خطأ فى عملية الاضافة',
                'all_elements' => $all_elements,
            ]);
        }
    }

    public function destroy_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = QuotationElement::FindOrFail($element_id);
        $quotation_id = $element->quotation_id;
        $element->delete();
    }

    public function changeQuotation(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $data = $request->all();
        $quotation_number = $request->quotation_number;
        $quotation = Quotation::where('quotation_number', $quotation_number)->first();
        $quotation->update($data);
        echo "<p class='alert alert-sm alert-success text-center mt-2 mb-2'>تم حفظ البيانات بنجاح</p>";
    }

    public function updateData(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $quotation_number = $request->quotation_number;
        $quotation = Quotation::where('quotation_number', $quotation_number)->first();
        $elements = QuotationElement::where('quotation_id', $quotation->id)->get();
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
            اجمالى عرض السعر
            " . $total . " " . $currency . "
            </div>
            <div class='pull-left col-lg-6 '>
            اجمالى عرض السعر بعد القيمة المضافة
            " . $after_total . " " . $currency . "
            </div>
            <div class='clearfix'></div>";
    }

    public function get_quotation_elements(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $quotation_number = $request->quotation_number;
        $quotation = Quotation::where('quotation_number', $quotation_number)->first();
        $elements = QuotationElement::where('quotation_id', $quotation->id)->get();
        $extras = QuotationExtra::where('quotation_id', $quotation->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            echo '<h6 class="alert alert-sm alert-danger text-center">
                <i class="fa fa-info-circle"></i>
            بيانات عناصر عرض السعر رقم
                ' . $quotation_number . '
            </h6>';
            $i = 0;
            echo "<table class='table table-condensed table-striped table-bordered'>";
            echo "<thead>";
            echo "<th>  # </th>";
            echo "<th> اسم المنتج </th>";
            echo "<th> سعر الوحدة </th>";
            echo "<th> الكمية </th>";
            echo "<th>  الاجمالى </th>";
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
                echo "<td class='no-print'>
                            <button type='button' quotation_number='" . $element->quotation->quotation_number . "' element_id='" . $element->id . "' class='btn btn-sm btn-info edit_element'>
                                <i class='fa fa-pencil'></i> تعديل
                            </button>
                            <button type='button' quotation_number='" . $element->quotation->quotation_number . "' element_id='" . $element->id . "' class='btn btn-sm btn-danger remove_element'>
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
                     اجمالى عرض السعر
                    " . $total . " " . $currency . "
                </div>
                <div class='pull-left col-lg-6 '>
                    اجمالى عرض السعر بعد القيمة المضافة
                    " . $after_total . " " . $currency . "
                </div>
                <div class='clearfix'></div>
            </div>";

        }

        echo "
        <script>
            $('.remove_element').on('click',function(){
                let element_id = $(this).attr('element_id');
                let quotation_number = $(this).attr('quotation_number');

                let discount_type = $('#discount_type').val();
                let discount_value = $('#discount_value').val();

                let extra_type = $('#extra_type').val();
                let extra_value = $('#extra_value').val();

                $.post('/client/quotations/element/delete',
                {'_token': '" . csrf_token() . "', element_id: element_id},
                function (data) {
                    $.post('/client/quotations/elements',
                        {'_token': '" . csrf_token() . "', quotation_number: quotation_number},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                    });
                $.post('/client/quotations/discount',
                    {'_token': '" . csrf_token() . "',quotation_number:quotation_number, discount_type: discount_type, discount_value: discount_value},
                    function (data) {
                        $('.after_totals').html(data);
                });

                $.post('/client/quotations/extra',
                    {'_token': '" . csrf_token() . "',quotation_number:quotation_number, extra_type: extra_type, extra_value: extra_value},
                    function (data) {
                        $('.after_totals').html(data);
                });

                $(this).parent().parent().fadeOut(300);
            });

            $('.edit_element').on('click', function () {
                let element_id = $(this).attr('element_id');
                let product_unit_id = $('#product_unit_id').val();
                let quotation_number = $(this).attr('quotation_number');
                $.post('/client/quotations/edit-element',
                    {
                        '_token': '" . csrf_token() . "',
                        quotation_number: quotation_number,
                        element_id: element_id
                    },
                    function (data) {
                        $('#product_id').val(data.product_id);
                        $('#product_id').selectpicker('refresh');
                        $('#product_price').val(data.product_price);
                        $('#quantity').val(data.quantity);
                        $('#quantity_price').val(data.quantity_price);
                        let product_id = data.product_id;
                        $.post('/client/quotations/get-edit', {
                            product_id: product_id,
                            product_unit_id: data.product_unit_id,
                            quotation_number: quotation_number,
                            '_token': '" . csrf_token() . "'
                        }, function (data) {
                            $('input#quantity').attr('max', data.first_balance);
                            $('.available').html('الكمية المتاحة : ' + data.first_balance);
                        });
                        $.post('/client/get-edit-product-units', {
                            product_id: product_id,
                            '_token': '" . csrf_token() . "',
                        }, function (proto) {
                            $('#product_unit_id').html(proto).val(data.product_unit_id);
                        });
                        $('#add').hide();
                        $('#edit').show();
                        $('#edit').attr('element_id', element_id);
                        $('#edit').attr('quotation_number', quotation_number);
                    });
                });

        </script>
        ";
    }

    public function apply_discount(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $quotation_number = $request->quotation_number;
        $discount_type = $request->discount_type;
        $discount_value = $request->discount_value;
        $quotation = Quotation::where('quotation_number', $quotation_number)->first();
        $elements = QuotationElement::where('quotation_id', $quotation->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);

            $previous_extra = QuotationExtra::where('quotation_id', $quotation->id)
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
                   اجمالى عرض السعر النهائى بعد الضريبة والشحن والخصم :
                    " . $after_total . " " . $currency . "
            </div>";
            $quotation_extra = QuotationExtra::where('quotation_id', $quotation->id)
                ->where('action', 'discount')->first();
            if (empty($quotation_extra)) {
                $quotation_extra = QuotationExtra::create([
                    'quotation_id' => $quotation->id,
                    'action' => 'discount',
                    'action_type' => $discount_type,
                    'value' => $discount_value,
                    'company_id' => $company_id,
                ]);
            } else {
                $quotation_extra->update([
                    'action_type' => $discount_type,
                    'value' => $discount_value,
                ]);
            }
        }
    }

    public function apply_extra(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $quotation_number = $request->quotation_number;
        $extra_type = $request->extra_type;
        $extra_value = $request->extra_value;
        $quotation = Quotation::where('quotation_number', $quotation_number)->first();
        $elements = QuotationElement::where('quotation_id', $quotation->id)->get();
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $tax_value_added = $company->tax_value_added;
        $sum = array();
        if (!$elements->isEmpty()) {
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);

            $previous_discount = QuotationExtra::where('quotation_id', $quotation->id)
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
                   اجمالى عرض السعر النهائى بعد الضريبة والشحن والخصم :
                    " . $after_total . " " . $currency . "
            </div>";
            $quotation_extra = QuotationExtra::where('quotation_id', $quotation->id)
                ->where('action', 'extra')->first();
            if (empty($quotation_extra)) {
                $quotation_extra = QuotationExtra::create([
                    'quotation_id' => $quotation->id,
                    'action' => 'extra',
                    'action_type' => $extra_type,
                    'value' => $extra_value,
                    'company_id' => $company_id,
                ]);
            } else {
                $quotation_extra->update([
                    'action_type' => $extra_type,
                    'value' => $extra_value,
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $quotation_number = $request->quotation_number;
        $quotation = Quotation::where('quotation_number', $quotation_number)->first();
        $quotation->elements()->delete();
        $quotation->extras()->delete();
        $quotation->delete();
        return redirect()->route('client.quotations.create')
            ->with('success', 'تم حذف عرض السعر بنجاح');
    }

    public function redirect()
    {
        return redirect()->route('client.quotations.create')->with('success', 'تم انشاء عرض السعر بنجاح');
    }

    public function get_outer_client_details(Request $request)
    {
        $outer_client_id = $request->outer_client_id;
        $outer_client = OuterClient::FindOrFail($outer_client_id);
        if ($outer_client->prev_balance > 0) {
            $balance = "عليه " . floatval($outer_client->prev_balance);
        } elseif ($outer_client->prev_balance < 0) {
            $balance = "له " . floatval(abs($outer_client->prev_balance));
        } else {
            $balance = 0;
        }

        echo "<div class='col-lg-4 pull-right'>" . "الفئة : " . trans('main.'.$outer_client->client_category) . '</div>';
        echo "<div class='col-lg-4 pull-right'>" . " مديونية العميل : " . $balance . '</div>';
        echo "<div class='col-lg-4 pull-right'>" . " الجنسية : " . $outer_client->client_national . '</div>';
        echo "<div class='clearfix'></div>";
    }

    public function get_products(Request $request)
    {
        $store_id = $request->store_id;
        $products = Product::where('store_id', $store_id)->get();
        foreach ($products as $product) {
            echo "<option value='" . $product->id . "'>" . $product->product_name . "</option>";
        }
    }

    public function edit($id)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $quotation = Quotation::findOrFail($id);
        $categories = $company->categories;
        $all_products = $company->products;
        $stores = $company->stores;
        $units = $company->units;
        $extra_settings = ExtraSettings::where('company_id', $company_id)->first();
        $currency = $extra_settings->currency;
        $outer_clients = OuterClient::where('company_id', $company_id)->get();
        $safes = $company->safes;
        $banks = $company->banks;
        return view('client.quotations.edit',
            compact('quotation', 'categories', 'units', 'all_products', 'stores',
                'extra_settings', 'safes', 'banks', 'outer_clients', 'company_id', 'company'));
    }

    public function delete_bill(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;
        $bill_id = $request->billid;
        $quotation = Quotation::FindOrFail($bill_id);
        $elements = $quotation->elements;
        $extras = $quotation->extras;
        $quotation->elements()->delete();
        $quotation->extras()->delete();
        $quotation->delete();
        return redirect()->route('client.home')
            ->with('success', 'تم حذف عرض السعر  بنجاح');
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

    public function update_element(Request $request)
    {
        $element_id = $request->element_id;
        $element = QuotationElement::FindOrFail($element_id);
        $element->update([
            'product_unit_id' => $request->product_unit_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'quantity_price' => $request->quantity_price,
            'product_price' => $request->product_price,
        ]);
    }

    public function edit_element(Request $request)
    {
        $element = QuotationElement::FindOrFail($request->element_id);
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

    public function convert_to_salebill($id)
    {
        $quotation = Quotation::FindOrFail($id);
        $quotation_elements = $quotation->elements;
        $quotation_extras = $quotation->extras;

        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $client_id = Auth::user()->id;

        $check = SaleBill::all();
        if ($check->isEmpty()) {
            $pre_bill = 1;
        } else {
            $old_pre_bill = SaleBill::max('sale_bill_number');
            $pre_bill = ++$old_pre_bill;
        }
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $status = "open";
        $paid = "0";

        $tax_value_added = $company->tax_value_added;
        $sum = array();
        foreach ($quotation_elements as $element) {
            array_push($sum, $element->quantity_price);
        }
        $total = array_sum($sum);
        $previous_extra = QuotationExtra::where('quotation_id', $quotation->id)
            ->where('action', 'extra')->first();
        if (!empty($previous_extra)) {
            $previous_extra_type = $previous_extra->action_type;
            $previous_extra_value = $previous_extra->value;
            if ($previous_extra_type == "percent") {
                $previous_extra_value = $previous_extra_value / 100 * $total;
            }
            $after_discount = $total + $previous_extra_value;
        }
        $previous_discount = QuotationExtra::where('quotation_id', $quotation->id)
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
        $final_total = $after_total_all;
        $rest = $final_total;

        $saleBill = SaleBill::create([
            'company_id' => $company_id,
            'client_id' => $client_id,
            'outer_client_id' => $quotation->outer_client_id,
            'sale_bill_number' => $pre_bill,
            'date' => $date,
            'time' => $time,
            'status' => $status,
            'final_total' => $final_total,
            'paid' => $paid,
            'rest' => $rest,
        ]);

        foreach ($quotation_elements as $element) {
            $salebill_element = SaleBillElement::create([
                'sale_bill_id' => $saleBill->id,
                'company_id' => $company_id,
                'product_id' => $element->product_id,
                'product_price' => $element->product_price,
                'quantity' => $element->quantity,
                'quantity_price' => $element->quantity_price,
                'product_unit_id' => $element->product_unit_id
            ]);
        }
        foreach ($quotation_extras as $extra) {
            $saleBill_extra = SaleBillExtra::create([
                'company_id' => $company_id,
                'sale_bill_id' => $saleBill->id,
                'action' => $extra->action,
                'action_type' => $extra->action_type,
                'value' => $extra->value,
            ]);
        }
        return redirect()->route('client.sale_bills.create')->with('success', 'تم تحويل عرض السعر الى فاتورة مبيعات');
    }
}

?>
