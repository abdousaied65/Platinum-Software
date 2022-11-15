<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductSerial;
use App\Models\ProductUnit;
use App\Models\Store;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = Product::where('company_id', $company_id)
            ->get();
        $product_units = ProductUnit::where('company_id', $company_id)
            ->get();
        $purchase_prices = array();
        $balances = array();
        foreach ($product_units as $product) {
            $product_price = $product->purchasing_price;
            $product_balance = $product->first_balance;
            array_push($balances, $product_balance);

            $total_price = $product_price * $product_balance;
            array_push($purchase_prices, $total_price);
        }
        $total_purchase_prices = array_sum($purchase_prices);
        $total_balances = array_sum($balances);
        return view('client.products.index', compact('company', 'total_balances', 'total_purchase_prices', 'company_id', 'products'));
    }

    public function create()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $stores = Store::where('company_id', $company_id)->get();
        $categories = Category::where('company_id', $company_id)->get();
        $sub_categories = SubCategory::where('company_id', $company_id)->get();
        $units = $company->units;
        $check = Product::where('company_id', $company_id)->get();
        if ($check->isEmpty()) {
            $code_universal = "100000001";
        } else {
            $old_order = Product::where('company_id', $company_id)->max('code_universal');
            $code_universal = ++$old_order;
        }
        return view('client.products.create',
            compact('company_id', 'units', 'sub_categories', 'code_universal', 'categories', 'stores', 'company'));
    }

    public function store_pos(Request $request)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $data = $request->all();

        $data['company_id'] = Auth::user()->company_id;
        $product = Product::create($data);
        if ($product) {
            return response()->json([
                'status' => true,
                'product_id' => $product->id,
                'product_name' => $product->product_name,
                'code_universal' => $product->code_universal,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'هناك خطأ فى تسجيل الدفع النقدى حاول مرة اخرى',
            ]);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_pic' => 'mimes:png,jpg,jpeg|max:2048',
        ]);
        $data = $request->all();
        if ($data['typo'] == "new") {
            $product = Product::create($data);
            if ($request->hasFile('product_pic')) {
                $image = $request->file('product_pic');
                $fileName = $image->getClientOriginalName();
                $uploadDir = 'uploads/products/' . $product->id;
                $image->move($uploadDir, $fileName);
                $product->product_pic = $uploadDir . '/' . $fileName;
                $product->save();
            }
            $productUnit = ProductUnit::create([
                'company_id' => $request->company_id,
                'product_id' => $product->id,
                'unit_id' => $request->unit_id,
                'type' => $request->type,
                'first_balance' => $request->first_balance,
                'min_balance' => $request->min_balance,
                'purchasing_price' => $request->purchasing_price,
                'wholesale_price' => $request->wholesale_price,
                'sector_price' => $request->sector_price,
            ]);
        } else {
            $product = Product::FindOrFail($request->product_id);
            $product->update($data);
            if (!empty($request->unit_id)) {
                $productUnit = ProductUnit::create([
                    'company_id' => $request->company_id,
                    'product_id' => $product->id,
                    'unit_id' => $request->unit_id,
                    'type' => $request->type,
                    'first_balance' => $request->first_balance,
                    'min_balance' => $request->min_balance,
                    'purchasing_price' => $request->purchasing_price,
                    'wholesale_price' => $request->wholesale_price,
                    'sector_price' => $request->sector_price,
                ]);
            }
        }
        if ($product) {
            if (!empty($request->unit_id)) {
                return Response()->json([
                    "success" => true,
                    "product_id" => $product->id,
                    "unit_name" => $productUnit->unit->unit_name,
                    "product_unit" => $productUnit,
                    "msg" => "تم اضافة وحدة جديدة تابعة للمنتج بنجاح"
                ]);
            } else {
                return Response()->json([
                    "success" => true,
                    "product_id" => $product->id,
                    "msg" => "تم تعديل بيانات المنتج بنجاح"
                ]);
            }
        } else {
            return Response()->json([
                "success" => false,
                "msg" => "هناك مشكلة جرب مرة اخرى"
            ]);
        }
    }

    public function add_serials(Request $request)
    {
        $product_unit_id = $request->product_unit_id;
        $product_unit = ProductUnit::FindOrFail($product_unit_id);
        $quantity = $request->quantity;
        $serials = $product_unit->serials;
        $old_serials = array();
        foreach ($serials as $serial) {
            array_push($old_serials, $serial->serial_number);
        }
        echo '<form id="myForm" method="POST" action="/client/save-serials" target="_blank">';
        echo '<input type="hidden" name="_token" value="' . csrf_token() . '">';
        echo '<input type="hidden" name = "product_unit_id" value="' . $product_unit_id . '" /> ';
        echo '<input type="hidden" name = "quantity" value="' . $quantity . '"  /> ';
        echo '<h5 class="alert alert-sm alert-danger text-center"><i class="fa fa-plus"></i>  منطقة اضافة السيريالات </h5>';
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
                echo '
            <div class="form-group pull-right col-lg-3 col-xs-6">
                <label for="serials"> رقم السيريال # ' . $counter . ' </label>
                <input required type="text" class="form-control text-left serial" value="' . $old_serials[$i] . '" dir="ltr" name="serials[]" />
            </div>';
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
            $('.serials_result').html('<h3> تم اضافة السيريالات بنجاح الى هذه الوحدة من المنتج </h3>');
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
        $product = $product_unit->product;
        $product_id = $product->id;

        $old_serials = $product_unit->serials;
        if (!$old_serials->isEmpty()) {
            foreach ($old_serials as $old_serial) {
                $old_serial->delete();
            }
        }
        for ($i = 0; $i < $quantity; $i++) {
            $product_serial = ProductSerial::create([
                'company_id' => $company_id,
                'client_id' => $client_id,
                'product_id' => $product_id,
                'product_unit_id' => $product_unit_id,
                'serial_number' => $serials[$i],
                'status' => 'new',
            ]);
        }
        echo "<script>window.close();</script>";
    }

    public function show($id)
    {
        $product = Product::FindOrFail($id);
        return view('client.products.show', compact('product'));
    }

    public function edit($id)
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $stores = Store::where('company_id', $company_id)->get();
        $categories = Category::where('company_id', $company_id)->get();
        $sub_categories = SubCategory::where('company_id', $company_id)->get();
        $product = Product::findOrFail($id);
        $units = $company->units;
        return view('client.products.edit', compact('stores', 'sub_categories', 'units', 'categories', 'product', 'company_id', 'company'));
    }

    public function destroy(Request $request)
    {
        $product = Product::FindOrFail($request->productid);
        $product->delete();
        return redirect()->route('client.products.index')
            ->with('success', 'تم حذف المنتج بنجاح');
    }

    public function print()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = Product::where('company_id', $company_id)
            ->get();
        return view('client.products.print', compact('products', 'company'));
    }

    public function barcode()
    {
        $company_id = Auth::user()->company_id;
        $company = Company::FindOrFail($company_id);
        $products = Product::where('company_id', $company_id)
            ->where('code_universal', '!=', '')
            ->get();
        return view('client.products.generate', compact('products'));
    }

    public function remove_unit(Request $request)
    {
        $unit_id = $request->unit_id;
        $unit = ProductUnit::FindOrFail($unit_id);
        $unit->delete();
        return Response()->json([
            "success" => true,
            "msg" => "تم حذف وحدة تابعة للمنتج بنجاح"
        ]);

    }

    public function generate_barcode(Request $request)
    {
        $count = $request->count;
        $product = Product::FindOrFail($request->product_id);
        $product_unit = ProductUnit::where('product_id', $product->id)
            ->where('first_balance', '>', 0)
            ->where('type', 'نعم')
            ->first();
        return view('client.products.barcode', compact('product','product_unit', 'count'));
    }
}
