<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow no-print" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Request::is('*home') ? 'active' : '' }}">
                <a href="{{route('client.home')}}"><i class="sidebar-item-icon fa fa-dashboard"></i>
                    <span class="menu-title text-center">
                        @if(App::getLocale() == 'ar')
                            لوحة التحكم
                        @else
                            Admin Dashboard
                        @endif
                    </span>
                </a>
            </li>
            @if(empty($package) || $package->products == "1")
                @if($screen_settings == "admin" || $screen_settings->products == "1")
                    <li class="nav-item {{ Request::is('*/branches*','*/stores*','*/categories*','*/products*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/products.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    المنتجات
                                @else
                                    Products
                                @endif
                            </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/branches*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            الفروع
                                        @else
                                            Branches
                                        @endif
                                    </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة فرع جديد')
                                        <li class="{{ Request::is('*/branches/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.branches.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة فرع جديد
                                                @else
                                                    Add New Branch
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة فروع الشركة')
                                        <li class="{{ Request::is('*/branches') ? 'active' : '' }}">
                                            <a href="{{ route('client.branches.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة فروع الشركة
                                                @else
                                                    List All Branches
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/stores*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            المخازن
                                        @else
                                            Stores
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة مخزن جديد')
                                        <li class="{{ Request::is('*/stores/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.stores.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة مخزن جديد
                                                @else
                                                    Add New Store
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة مخازن الشركة')
                                        <li class="{{ Request::is('*/stores') ? 'active' : '' }}">
                                            <a href="{{ route('client.stores.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة مخازن الشركة
                                                @else
                                                    List All Stores
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/clients-stores-transfer-get') ? 'active' : '' }}">
                                            <a href="{{ route('client.stores.transfer.get') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تحويل بين المخازن
                                                @else
                                                    Transfer Between Stores
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/clients-stores-inventory-get') ? 'active' : '' }}">
                                            <a href="{{ route('client.inventory.get') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    جرد مخازن الشركة
                                                @else
                                                    Stores Inventory
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/categories*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            الفئات الرئيسية
                                        @else
                                            Main Categories
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة فئة جديد')
                                        <li class="{{ Request::is('*/categories/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.categories.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة فئة رئيسية جديدة
                                                @else
                                                    Add New Main Category
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة فئات الشركة')
                                        <li class="{{ Request::is('*/categories') ? 'active' : '' }}">
                                            <a href="{{ route('client.categories.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عرض الفئات الرئيسية
                                                @else
                                                    List All Main Categories
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/subcategories*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            الفئات الفرعية
                                        @else
                                            Sub Categories
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة فئة جديد')
                                        <li class="{{ Request::is('*/subcategories/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.subcategories.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة فئة فرعية جديدة
                                                @else
                                                    Add New Sub Category
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة فئات الشركة')
                                        <li class="{{ Request::is('*/subcategories') ? 'active' : '' }}">
                                            <a href="{{ route('client.subcategories.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عرض الفئات الفرعية
                                                @else
                                                    List All Sub Categories
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/units*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            وحدات المنتجات
                                        @else
                                            Product Units
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة فئة جديد')
                                        <li class="{{ Request::is('*/units/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.units.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة وحدة جديدة
                                                @else
                                                    Add New Product Unit
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة فئات الشركة')
                                        <li class="{{ Request::is('*/units') ? 'active' : '' }}">
                                            <a href="{{ route('client.units.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة وحدات المنتجات
                                                @else
                                                    List All Product Units
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/products*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            المنتجات
                                        @else
                                            Products
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة منتج جديد')
                                        <li class="{{ Request::is('*/products/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.products.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة منتج جديد
                                                @else
                                                    Add New Product
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة المنتجات')
                                        <li class="{{ Request::is('*/products') ? 'active' : '' }}">
                                            <a href="{{ route('client.products.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة المنتجات
                                                @else
                                                    List All Products
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/generate-barcode') ? 'active' : '' }}">
                                            <a href="{{ route('barcode') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    طباعة باركود المنتجات
                                                @else
                                                    Print Product Barcode
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @if(empty($package) ||  $package->debt == "1")
                @if($screen_settings == "admin" || $screen_settings->debt == "1")
                    <li class="nav-item {{ Request::is('*/outer_clients*','*/suppliers*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/depts.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    الديون
                                @else
                                    Debts
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/outer_clients*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            العملاء
                                        @else
                                            Clients
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة عميل جديد')
                                        <li class="{{ Request::is('*/outer_clients/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.outer_clients.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة عميل جديد
                                                @else
                                                    Add New Client
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة العملاء الحاليين')
                                        <li class="{{ Request::is('*/outer_clients') ? 'active' : '' }}">
                                            <a href="{{ route('client.outer_clients.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة العملاء الحاليين
                                                @else
                                                    List All Clients
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('فلترة العملاء ( بحث متقدم )')
                                        <li class="{{ Request::is('*/clients-outer-clients-filter') ? 'active' : '' }}">
                                            <a href="{{ route('client.outer_clients.filter') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    فلترة العملاء ( بحث متقدم )
                                                @else
                                                    Clients Filter
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/suppliers*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            الموردين
                                        @else
                                            Suppliers
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة مورد جديد')
                                        <li class="{{ Request::is('*/suppliers/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.suppliers.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة مورد جديد
                                                @else
                                                    Add New Supplier
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة الموردين الحاليين')
                                        <li class="{{ Request::is('*/suppliers') ? 'active' : '' }}">
                                            <a href="{{ route('client.suppliers.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة الموردين الحاليين
                                                @else
                                                    List All Suppliers
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('فلترة الموردين ( بحث متقدم )')
                                        <li class="{{ Request::is('*/clients-suppliers-filter') ? 'active' : '' }}">
                                            <a href="{{ route('client.suppliers.filter') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    فلترة الموردين ( بحث متقدم )
                                                @else
                                                    Suppliers Filter
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @if(empty($package) ||  $package->banks_safes == "1")
                @if($screen_settings == "admin" || $screen_settings->banks_safes == "1")
                    <li class="nav-item {{ Request::is('*/banks*','*/safes*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/safes.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    البنوك والخزن
                                @else
                                    Banks & Safes
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/safes*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            الخزائن
                                        @else
                                            Safes
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة خزينة جديد')
                                        <li class="{{ Request::is('*/safes/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.safes.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة خزينة جديد
                                                @else
                                                    Add New Safe
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة خزائن الشركة')
                                        <li class="{{ Request::is('*/safes') ? 'active' : '' }}">
                                            <a href="{{ route('client.safes.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة خزائن الشركة
                                                @else
                                                    List All Safes
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/safes-transfer') ? 'active' : '' }}">
                                            <a href="{{ route('client.safes.transfer') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تحويل بين الخزن
                                                @else
                                                    Safes Transfer
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/banks*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            البنوك
                                        @else
                                            Banks
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة بنك جديد')
                                        <li class="{{ Request::is('*/banks/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.banks.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة بنك جديد
                                                @else
                                                    Add New Bank
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('قائمة البنوك الحاليين')
                                        <li class="{{ Request::is('*/banks') ? 'active' : '' }}">
                                            <a href="{{ route('client.banks.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    قائمة البنوك الحاليين
                                                @else
                                                    List All Banks
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('سحب وايداع نقدى')
                                        <li class="{{ Request::is('*/clients-banks-process') ? 'active' : '' }}">
                                            <a href="{{ route('client.banks.process') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>

                                                @if(App::getLocale() == 'ar')
                                                    سحب وايداع نقدى
                                                @else
                                                    Withdraw and deposit
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('تحويل بين البنوك')
                                        <li class="{{ Request::is('*/clients-banks-transfer') ? 'active' : '' }}">
                                            <a href="{{ route('client.banks.transfer') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تحويل بين البنوك وبعضها
                                                @else
                                                    Transfer Between Banks
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/clients-bank-safe-transfer') ? 'active' : '' }}">
                                            <a href="{{ route('client.bank.safe.transfer') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تحويل من بنك الى خزنة
                                                @else
                                                    Transfer From Bank To Safe
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/clients-safe-bank-transfer') ? 'active' : '' }}">
                                            <a href="{{ route('client.safe.bank.transfer') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تحويل من خزنة الى بنك
                                                @else
                                                    Transfer From Safe To Bank
                                                @endif
                                            </a>
                                        </li>
                                    @endcan

                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @can('نقطة البيع')
                <li class="nav-item {{ Request::is('*/pos*') ? 'active open' : '' }}">
                    <a href="{{route('client.pos.create')}}">
                        <img class="img-icon" src="{{asset('app-assets/images/icons/pos.png')}}" alt="">
                        <span class="menu-title">
                            @if(App::getLocale() == 'ar')
                                نقطة البيع
                            @else
                                POS Cashier
                            @endif
                    </span>
                    </a>
                </li>
            @endcan
            @can('تقرير مبيعات نقطة البيع')
                <li class="nav-item {{ Request::is('*/pos-sales-report*') ? 'active open' : '' }}">
                    <a href="{{route('pos.sales.report')}}">
                        <img class="img-icon" src="{{asset('app-assets/images/icons/pos.png')}}" alt="">
                        <span class="menu-title">
                            @if(App::getLocale() == 'ar')
                                تقرير مبيعات نقطة البيع
                            @else
                                Pos Cashier Sales Report
                            @endif
                    </span>
                    </a>
                </li>
            @endcan

            <li class="nav-item {{ Request::is('*/coupons*') ? 'active open' : '' }}">
                <a href="javascript:;">
                    <i class="fa fa-list"></i>
                    <span class="menu-title">
                        @if(App::getLocale() == 'ar')
                            قائمة كوبونات الخصم
                        @else
                            Discount Coupons
                        @endif
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ Request::is('*/coupons/create') ? 'active' : '' }}">
                        <a href="{{ route('client.coupons.create') }}"><i class="fa fa-plus"></i>
                            @if(App::getLocale() == 'ar')
                                اضافة كوبون خصم جديد
                            @else
                                Add New Discount Coupon
                            @endif
                        </a>
                    </li>
                    <li class="{{ Request::is('*/coupons') ? 'active' : '' }}">
                        <a href="{{ route('client.coupons.index') }}"><i class="fa fa-list"></i>
                            @if(App::getLocale() == 'ar')
                                عروض كوبونات الخصم
                            @else
                                List All Discount Coupons
                            @endif
                        </a>
                    </li>
                </ul>
            </li>


            @if(empty($package) ||  $package->sales == "1")
                @if($screen_settings == "admin" || $screen_settings->sales == "1")
                    <li class="nav-item {{ Request::is('*/quotations*','*/sale_bills*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/sales.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    المبيعات
                                @else
                                    Sales
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/sale_bills*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            فواتير البيع
                                        @else
                                            Sale Bills
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة فاتورة بيع جديدة')
                                        <li class="{{ Request::is('*/sale_bills/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.sale_bills.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة فاتورة بيع جديدة
                                                @else
                                                    Add New Sale Bill
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('فواتير البيع السابقة')
                                        <li class="{{ Request::is('*/sale_bills') ? 'active' : '' }}">
                                            <a href="{{ route('client.sale_bills.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    فواتير البيع السابقة
                                                @else
                                                    List All Sale Bills
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('مرتجعات فواتير البيع عملاء')
                                        <li class="{{ Request::is('*/sale-bills/get-returns') ? 'active' : '' }}">
                                            <a href="{{ url('/client/sale-bills/get-returns') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    مرتجعات فواتير البيع عملاء
                                                @else
                                                    Sale Bill Returns
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>

                            <li class="nav-item {{ Request::is('*/quotations*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            عروض الاسعار
                                        @else
                                            Quotations
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة عرض سعر جديد')
                                        <li class="{{ Request::is('*/quotations/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.quotations.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة عرض سعر جديد
                                                @else
                                                    Add New Quotation
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('عروض الاسعار السابقة')
                                        <li class="{{ Request::is('*/quotations') ? 'active' : '' }}">
                                            <a href="{{ route('client.quotations.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عروض الاسعار السابقة
                                                @else
                                                    List All Quotations
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @if(empty($package) ||  $package->purchases == "1")
                @if($screen_settings == "admin" || $screen_settings->purchases == "1")
                    <li class="nav-item {{ Request::is('*/purchase_orders*','*/buy_bills*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/buy_bills.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    المشتريات
                                @else
                                    Buy Bills
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/buy_bills*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            فواتير المشتريات
                                        @else
                                            Buy Bills
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة فاتورة مشتريات جديدة')
                                        <li class="{{ Request::is('*/buy_bills/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.buy_bills.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة فاتورة مشتريات جديدة
                                                @else
                                                    Add New Buy Bill
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('فواتير المشتريات السابقة')
                                        <li class="{{ Request::is('*/buy_bills') ? 'active' : '' }}">
                                            <a href="{{ route('client.buy_bills.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    فواتير المشتريات السابقة
                                                @else
                                                    List All Buy Bills
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('مرتجعات فواتير المشتريات')
                                        <li class="{{ Request::is('*/buy-bills/get-returns') ? 'active' : '' }}">
                                            <a href="{{ url('/client/buy-bills/get-returns') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    مرتجعات فواتير المشتريات
                                                @else
                                                    Buy Bill Returns
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/purchase_orders*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            اوامر الشراء
                                        @else
                                            Purchase Orders
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    <li class="{{ Request::is('*/purchase_orders/create') ? 'active' : '' }}">
                                        <a href="{{ route('client.purchase_orders.create') }}">
                                            <i class="fa fa-plus text-success tx-20"></i>
                                            @if(App::getLocale() == 'ar')
                                                اضافة امر شراء جديد
                                            @else
                                                Add New Purchase Order
                                            @endif
                                        </a>
                                    </li>
                                    <li class="{{ Request::is('*/purchase_orders') ? 'active' : '' }}">
                                        <a href="{{ route('client.purchase_orders.index') }}">
                                            <i class="fa fa-plus text-success tx-20"></i>
                                            @if(App::getLocale() == 'ar')
                                                عروض اوامر الشراء السابقة
                                            @else
                                                List All Purchase Orders
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @if(empty($package) ||  $package->finance == "1")
                @if($screen_settings == "admin" || $screen_settings->finance == "1")
                    <li class="nav-item {{ Request::is('*/expenses*','*/cash*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/finance.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    الماليات
                                @else
                                    Financial Issues
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/expenses*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            المصاريف
                                        @else
                                            Expenses
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('المصاريف الثابتة')
                                        <li class="{{ Request::is('*/clients-expenses-fixed*') ? 'active' : '' }}">
                                            <a href="{{ route('client.fixed.expenses') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    المصاريف الثابتة
                                                @else
                                                    Fixed Expenses
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('تسجيل مصاريف جديدة')
                                        <li class="{{ Request::is('*/expenses/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.expenses.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تسجيل مصاريف جديدة
                                                @else
                                                    Add New Expense
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('عرض المصاريف')
                                        <li class="{{ Request::is('*/expenses') ? 'active' : '' }}">
                                            <a href="{{ route('client.expenses.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عرض المصاريف
                                                @else
                                                    List All Expenses
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="{{ Request::is('*/clients-add-cash-clients*','*/clients-add-cash-suppliers*') ? 'active open' : '' }}">
                                <a class="menu-item" href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    @if(App::getLocale() == 'ar')
                                        تسجيل دفع نقدى
                                    @else
                                        Add Cash Payments
                                    @endif
                                </a>
                                <ul class="menu-content">
                                    @can('استلام نقدية من عميل')
                                        <li class="{{Request::is('*/clients-add-cash-clients*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.add.cash.clients')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    استلام نقدية من عميل
                                                @else
                                                    Take Cash From Client
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{Request::is('*/clients-give-cash-clients*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.give.cash.clients')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اعطاء سلفه الى عميل
                                                @else
                                                    Give Cash To Client
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('دفع نقدى الى مورد')
                                        <li class="{{Request::is('*/clients-add-cash-suppliers*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.add.cash.suppliers')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفع نقدى الى مورد
                                                @else
                                                    Give Cash To Supplier
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{Request::is('*/clients-give-cash-suppliers*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.give.cash.suppliers')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اخذ سلفه من مورد
                                                @else
                                                    Take Cash From Supplier
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="{{ Request::is('*/clients-add-cashbank-clients*','*/clients-add-cashbank-suppliers*') ? 'active open' : '' }}">
                                <a class="menu-item" href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    @if(App::getLocale() == 'ar')
                                        تسجيل دفع بنكى
                                    @else
                                        Bank Payments
                                    @endif
                                </a>
                                <ul class="menu-content">
                                    @can('استلام نقدية من عميل')
                                        <li class="{{Request::is('*/clients-add-cashbank-clients*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.add.cashbank.clients')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفع بنكى من عميل
                                                @else
                                                    Bank Payment From client
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('دفع نقدى الى مورد')
                                        <li class="{{Request::is('*/clients-add-cashbank-suppliers*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.add.cashbank.suppliers')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفع بنكى الى مورد
                                                @else
                                                    Bank Payment To Supplier
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="{{ Request::is('*/capitals*') ? 'active open' : '' }}">
                                <a class="menu-item" href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    @if(App::getLocale() == 'ar')
                                        ادارة راس المال
                                    @else
                                        Capital management
                                    @endif
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة مبلغ راس مال')
                                        <li class="{{Request::is('*/capitals/create*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.capitals.create')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة مبلغ راس مال
                                                @else
                                                    Add New Capital Balance
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('مبالغ راس المال المضافة')
                                        <li class="{{Request::is('*/capitals') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.capitals.index')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    مبالغ راس المال المضافة
                                                @else
                                                    List All Capital Balances
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="{{ Request::is('*/cash*') ? 'active open' : '' }}">
                                <a class="menu-item" href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    @if(App::getLocale() == 'ar')
                                        دفعات النقدية السابقة
                                    @else
                                        List Cash Payment
                                    @endif
                                </a>
                                <ul class="menu-content">
                                    @can('دفعات نقدية من العملاء')
                                        <li class="{{Request::is('*/clients-cash-clients*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.cash.clients')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفعات نقدية من العملاء
                                                @else
                                                    List Cash Payments From Clients
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('دفعات نقدية الى الموردين')
                                        <li class="{{Request::is('*/clients-cash-suppliers*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.cash.suppliers')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفعات نقدية الى الموردين
                                                @else
                                                    List Cash Payments From Suppliers
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="{{ Request::is('*/cash*') ? 'active open' : '' }}">
                                <a class="menu-item" href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    @if(App::getLocale() == 'ar')
                                        السلفيات السابقة
                                    @else
                                        Advance Payments
                                    @endif
                                </a>
                                <ul class="menu-content">
                                    @can('دفعات نقدية من العملاء')
                                        <li class="{{Request::is('*/clients-borrow-clients*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.borrow.clients')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    سلفيات الى العملاء
                                                @else
                                                    Clients Advance Payments
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('دفعات نقدية الى الموردين')
                                        <li class="{{Request::is('*/clients-borrow-suppliers*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.borrow.suppliers')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    سلفيات من الموردين
                                                @else
                                                    Suppliers Advance Payments
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="{{ Request::is('*/cash*') ? 'active open' : '' }}">
                                <a class="menu-item" href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    @if(App::getLocale() == 'ar')
                                        دفعات بنكية سابقة
                                    @else
                                        Bank Payments
                                    @endif
                                </a>
                                <ul class="menu-content">
                                    @can('دفعات نقدية من العملاء')
                                        <li class="{{Request::is('*/clients-cashbank-clients*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.cashbank.clients')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفعات بنكية من العملاء
                                                @else
                                                    Clients Bank Payments
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('دفعات نقدية الى الموردين')
                                        <li class="{{Request::is('*/clients-cashbank-suppliers*') ? 'active' : ''}}">
                                            <a class="menu-item" href="{{route('client.cashbank.suppliers')}}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    دفعات بنكية الى الموردين
                                                @else
                                                    Suppliers Bank Payments
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @if(empty($package) ||  $package->marketing == "1")
                @if($screen_settings == "admin" || $screen_settings->marketing == "1")
                    <li class="nav-item {{ Request::is('*/gifts*','*/emails*') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/marketing.png')}}" alt="">
                            <span class="menu-title">
                                @if(App::getLocale() == 'ar')
                                    التسويق
                                @else
                                    Marketing
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item {{ Request::is('*/gifts*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            هدايا العملاء المميزين
                                        @else
                                            Clients Gifts
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('اضافة هدية جديد')
                                        <li class="{{ Request::is('*/gifts/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.gifts.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة هدية جديدة
                                                @else
                                                    Add New Gift
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('عرض هدايا العملاء')
                                        <li class="{{ Request::is('*/gifts') ? 'active' : '' }}">
                                            <a href="{{ route('client.gifts.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عرض هدايا العملاء
                                                @else
                                                    List Clients Gifts
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            <li class="nav-item {{ Request::is('*/emails*') ? 'active open' : '' }}">
                                <a href="javascript:;">
                                    <i class="fa fa-plus text-success tx-20"></i>
                                    <span class="menu-title">
                                        @if(App::getLocale() == 'ar')
                                            قسم الايميلات
                                        @else
                                            Email Messages
                                        @endif
                                </span>
                                </a>
                                <ul class="menu-content">
                                    @can('ارسال ايميل الى عميل')
                                        <li class="{{ Request::is('*/clients-emails-clients') ? 'active' : '' }}">
                                            <a href="{{ route('client.emails.clients') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    ارسال ايميل الى عميل
                                                @else
                                                    Send Email To Client
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                    @can('ارسال ايميل الى مورد')
                                        <li class="{{ Request::is('*/clients-emails-suppliers') ? 'active' : '' }}">
                                            <a href="{{ route('client.emails.suppliers') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    ارسال ايميل الى مورد
                                                @else
                                                    Send Email To Supplier
                                                @endif
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
            @if(empty($package) ||  $package->accounting == "1")
                @if($screen_settings == "admin" || $screen_settings->accounting == "1")
                    @can('دفتر اليومية')
                        <li class="nav-item {{ Request::is('*/daily/get*') ? 'active open' : '' }}">
                            <a href="{{url('/client/daily/get')}}">
                                <i class="fa fa-plus text-success tx-20"></i>
                                <span class="menu-title">
                                    @if(App::getLocale() == 'ar')
                                        دفتر اليومية
                                    @else
                                        Daily Journal
                                    @endif
                                </span>
                            </a>
                        </li>
                    @endcan
                @endif
            @endif
            @if(empty($package) ||  $package->reports == "1")
                @if($screen_settings == "admin" || $screen_settings->reports == "1")
                    @can('تقارير عامة')
                        <li class="nav-item {{ Request::is('*/report*') ? 'active' : '' }}">
                            <a href="{{route('client.reports')}}">
                                <img class="img-icon" src="{{asset('app-assets/images/icons/reports.png')}}" alt="">
                                <span class="menu-title text-center">
                                    @if(App::getLocale() == 'ar')
                                        تقارير عامة
                                    @else
                                        General Reports
                                    @endif
                            </span>
                            </a>
                        </li>
                    @endcan
                @endif
            @endif
            @if(empty($package) || $package->maintenance == "1")
                @if($screen_settings == "admin" || $screen_settings->maintenance == "1")
                    @can('قسم الصيانة')
                        <li class="nav-item {{ Request::is('*/maintenance-settings-view*') ? 'active open' : '' }}">
                            <a href="{{route('maintenance.settings.view')}}">
                                <i class="fa fa-plus text-success tx-20"></i>
                                <span class="menu-title">
                                    @if(App::getLocale() == 'ar')
                                        خيارات قسم الصيانة
                                    @else
                                        Maintenance Options
                                    @endif
                                </span>
                            </a>
                        </li>
                        <li class="nav-item {{ Request::is('*/maintenance') ? 'active open' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-plus text-success tx-20"></i>
                                <span class="menu-title">
                                    @if(App::getLocale() == 'ar')
                                        قسم الصيانة
                                    @else
                                        Maintenance Department
                                    @endif
                                </span>
                            </a>
                            <ul class="menu-content">
                                <li class="nav-item {{ Request::is('*/engineers*') ? 'active open' : '' }}">
                                    <a href="javascript:;">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                مهندسين الصيانة
                                            @else
                                                Maintenance Technicians
                                            @endif
                                        </span>
                                    </a>
                                    <ul class="menu-content">
                                        <li class="{{ Request::is('*/engineers/create') ? 'active' : '' }}">
                                            <a href="{{ route('client.engineers.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة مهندس صيانة
                                                @else
                                                    Add New Maintenance Technician
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/engineers') ? 'active' : '' }}">
                                            <a href="{{ route('client.engineers.index') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عرض مهندسين الصيانة
                                                @else
                                                    List Maintenance Technicians
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item {{ Request::is('*/get-maintenance-device') ? 'active open' : '' }}">
                                    <a href="{{route('get.maintenance.device')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                استلام جهاز صيانة
                                            @else
                                                Receive Maintenance Device
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('*/maintenance-devices') ? 'active open' : '' }}">
                                    <a href="{{route('maintenance.devices')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                عرض الاجهزة المستلمة
                                            @else
                                                List The Received Devices
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('*/maintenance-bill*') ? 'active open' : '' }}">
                                    <a href="javascript:;">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                فواتير الصيانة
                                            @else
                                                Maintenance Bills
                                            @endif
                                        </span>
                                    </a>
                                    <ul class="menu-content">
                                        <li class="{{ Request::is('*/maintenance-bill-create') ? 'active' : '' }}">
                                            <a href="{{ route('maintenance.bill.create') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    اضافة فاتورة صيانة
                                                @else
                                                    Add New Maintenance Bill
                                                @endif
                                            </a>
                                        </li>
                                        <li class="{{ Request::is('*/maintenance-bills') ? 'active' : '' }}">
                                            <a href="{{ route('maintenance.bills') }}">
                                                <i class="fa fa-plus text-success tx-20"></i>
                                                @if(App::getLocale() == 'ar')
                                                    عرض فواتير الصيانة
                                                @else
                                                    List All Maintenance Devices
                                                @endif
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
            @endif

            @if(empty($package) ||  $package->settings == "1")
                @if($screen_settings == "admin" || $screen_settings->settings == "1")
                    @can('صلاحيات المستخدمين')
                        <li class="nav-item {{ Request::is('*/employees*','*/roles*') ? 'active open' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-plus text-success tx-20"></i>
                                <span class="menu-title">
                                    @if(App::getLocale() == 'ar')
                                        الموظفين
                                    @else
                                        Employees
                                    @endif
                                </span>
                            </a>
                            <ul class="menu-content">
                                <li class="{{ Request::is('*/employees/create') ? 'active' : '' }}">
                                    <a href="{{route('client.employees.create')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            اضافة موظف جديد
                                        @else
                                            Add New Employee
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ Request::is('*/employees') ? 'active' : '' }}">
                                    <a href="{{route('client.employees.index')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            قائمة الموظفين الحاليين
                                        @else
                                            List All Employees
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ Request::is('*/employees-cash') ? 'active' : '' }}">
                                    <a href="{{route('employees.get.cash')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            اضافة دفعة الى موظف
                                        @else
                                            Give Cash To Employee
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ Request::is('*/employees-cashs') ? 'active' : '' }}">
                                    <a href="{{route('employees.cashs')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مدفوعات الموظفين
                                        @else
                                            Employees Cash Payments
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                @endif
            @endif


            @if(empty($package) ||  $package->settings == "1")
                @if($screen_settings == "admin" || $screen_settings->settings == "1")
                    @can('صلاحيات المستخدمين')
                        <li class="nav-item {{ Request::is('*/roles*') ? 'active open' : '' }}">
                            <a href="javascript:;">
                                <i class="fa fa-plus text-success tx-20"></i>
                                <span class="menu-title">
                                    @if(App::getLocale() == 'ar')
                                        صلاحيات المستخدمين
                                    @else
                                        Users Privileges
                                    @endif
                                </span>
                            </a>
                            <ul class="menu-content">
                                <li class="{{ Request::is('*/clients/create') ? 'active' : '' }}">
                                    <a href="{{route('client.clients.create')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            اضافة مستخدم جديد
                                        @else
                                            Add New User
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ Request::is('*/clients') ? 'active' : '' }}">
                                    <a href="{{route('client.clients.index')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            قائمة المستخدمين الحاليين
                                        @else
                                            List All Users
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ Request::is('*/roles/create') ? 'active' : '' }}">
                                    <a href="{{route('client.roles.create')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            اضافة صلاحية جديدة
                                        @else
                                            Add New Privilege
                                        @endif
                                    </a>
                                </li>
                                <li class="{{ Request::is('*/roles') ? 'active' : '' }}">
                                    <a href="{{route('client.roles.index')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            قائمة الصلاحيات الموجودة
                                        @else
                                            List All Privileges
                                        @endif
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                @endif
            @endif
            @if(empty($package) ||  $package->settings == "1")
                @if($screen_settings == "admin" || $screen_settings->settings == "1")
                    <li class="nav-item {{ Request::is('*/roles*','*settings') ? 'active open' : '' }}">
                        <a href="javascript:;">
                            <img class="img-icon" src="{{asset('app-assets/images/icons/settings.png')}}" alt="">
                            <span class="menu-title">
                               @if(App::getLocale() == 'ar')
                                    الضبط
                                @else
                                   Settings
                                @endif
                        </span>
                        </a>
                        <ul class="menu-content">
                            @can('الاعدادات العامة للنظام')
                                <li class="nav-item {{ Request::is('*settings') ? 'active open' : '' }}">
                                    <a href="{{ route('client.basic.settings.edit')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                الاعدادات العامة للنظام
                                            @else
                                                Basic Settings
                                            @endif
                                    </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ Request::is('*/screens-settings') ? 'active open' : '' }}">
                                    <a href="{{ route('screens.settings')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                اعدادات ظهور الشاشات
                                            @else
                                                Screens Display Settings
                                            @endif
                                        </span>
                                    </a>
                                </li>

                                <li class="nav-item {{ Request::is('*/pos-settings') ? 'active open' : '' }}">
                                    <a href="{{ route('pos.settings')}}">
                                        <i class="fa fa-plus text-success tx-20"></i>
                                        <span class="menu-title">
                                            @if(App::getLocale() == 'ar')
                                                اعدادات  نقاط البيع
                                            @else
                                                POS Settings
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
    </div>
</div>
