@if(isset($data['products_k']) && !empty($data['products_k']))
    <table>
        <thead>
        <tr>
            @if(isset($data['options']) && in_array('product_name',$data['options']))
                <th>
                    @if(App::getLocale() == 'ar')
                        اسم المنتج
                    @else
                        Product Name
                    @endif
                </th>
            @endif
            @if(isset($data['options']) && in_array('code_universal',$data['options']))
                <th>
                    @if(App::getLocale() == 'ar')
                        الكود
                    @else
                        Barcode
                    @endif
                </th>
            @endif
            @if(isset($data['options']) && in_array('purchasing_price',$data['options']))
                <th>
                    @if(App::getLocale() == 'ar')
                        سعر الشراء
                    @else
                        Purchasing Price
                    @endif
                </th>
            @endif
            @if(isset($data['options']) && in_array('purchases',$data['options']))
                <th>
                    @if(App::getLocale() == 'ar')
                        مشتريات
                    @else
                        purchases
                    @endif
                </th>
            @endif
            @if(isset($data['options']) && in_array('sales',$data['options']))
                <th>
                    @if(App::getLocale() == 'ar')
                        مبيعات
                    @else
                        Sales
                    @endif
                </th>
            @endif
            @if(isset($data['options']) && in_array('current_quantity',$data['options']))
                <th>
                    @if(App::getLocale() == 'ar')
                        كمية حالية
                    @else
                        Current Quantity
                    @endif
                </th>
            @endif
        </tr>
        </thead>
        <tbody>
        <?php $sum = 0;?>
        @foreach($data['products_k'] as $data['product_k'])
            <tr>
                @if(isset($data['options']) && in_array('product_name',$data['options']))
                    <td>{{ $data['product_k']->product_name }}</td>
                @endif
                @if(isset($data['options']) && in_array('code_universal',$data['options']))
                    <td>{{ $data['product_k']->code_universal }}</td>
                @endif
                @if(isset($data['options']) && in_array('purchasing_price',$data['options']))
                    <td>{{floatval( $data['product_k']->purchasing_price  )}}</td>
                @endif
                @if(isset($data['options']) && in_array('purchases',$data['options']))
                    <td>
                        <?php
                        $buy_elements = \App\Models\BuyBillElement::where('product_id', $data['product_k']->id)->get();
                        $total_buy_elements = 0;
                        foreach ($buy_elements as $buy_element) {
                            $total_buy_elements = $total_buy_elements + $buy_element->quantity;
                        }
                        echo floatval($total_buy_elements);
                        ?>
                    </td>
                @endif
                @if(isset($data['options']) && in_array('sales',$data['options']))
                    <td>
                        <?php
                        $sale_elements = \App\Models\SaleBillElement::where('product_id', $data['product_k']->id)->get();
                        $total_sale_elements = 0;
                        foreach ($sale_elements as $sale_element) {
                            $total_sale_elements = $total_sale_elements + $sale_element->quantity;
                        }
                        $total_sold = $total_sale_elements;
                        echo floatval($total_sold);
                        ?>
                    </td>
                @endif
                @if(isset($data['options']) && in_array('current_quantity',$data['options']))
                    <td>{{floatval( $data['product_k']->first_balance  )}}</td>
                @endif
            </tr>
            <?php $total = $data['product_k']->first_balance * $data['product_k']->purchasing_price;
            $sum = $sum + $total;
            ?>
        @endforeach
        <tr>
            <td>
                @if(App::getLocale() == 'ar')
                    اجمالى التكلفة
                @else
                    Total Costs
                @endif
            </td>
            <td>{{floatval( $sum  ) }}</td>
        </tr>
        </tbody>
    </table>
@endif
