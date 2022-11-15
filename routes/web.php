<?php

use App\Models\Branch;
use App\Models\Currency;
use App\Models\Information;
use App\Models\IntroMovie;
use App\Models\Safe;
use App\Models\Store;
use App\Models\TimeZone;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::get('/', function () {
        $intro_movie = IntroMovie::First();
        return view('site.index', compact('intro_movie'));
    })->name('index');

    Route::get('/about', function () {
        return view('site.about');
    })->name('about');
    Route::get('/contact', function () {
        $informations = Information::First();
        return view('site.contact', compact('informations'));
    })->name('contact');
    Route::post('/send-message', 'Site\ContactController@send_message')->name('send.message');

    Route::get('/step-3', function () {
        $timezones = TimeZone::all();
        $currencies = Currency::all();
        return view('site.index3', compact('timezones', 'currencies'));
    })->name('index3');
    Route::post('/company-store', 'Site\CompanyController@store')->name('company.store');
    Route::get('/step-4/{id?}', function () {
        return view('site.index4');
    })->name('index4');
    Route::post('/company-store-step2', 'Site\CompanyController@store_s2')->name('company.store.s2');
    Route::get('/step-5/{id?}', function () {
        return view('site.index5');
    })->name('index5');
    Route::get('to-admin-login/{id?}', 'Site\CompanyController@to_admin_login')->name('to.admin.login');
    Route::post('/company-admin-login-store', 'Site\CompanyController@admin_login')->name('company.admin.login.store');

    Route::get('/branches/{id?}', function () {
        $branches = Branch::where('company_id', $_GET['company_id'])->get();
        return view('site.branches', compact('branches'));
    })->name('branches');
    Route::post('/company-branch-store', 'Site\CompanyController@store_branch')->name('company.branch.store');
    Route::get('/to-stores/{id?}', 'Site\CompanyController@stores')->name('to.stores');
    Route::get('/stores/{id?}', function () {
        $stores = Store::where('company_id', $_GET['company_id'])->get();
        $branches = Branch::where('company_id', $_GET['company_id'])->get();
        return view('site.stores', compact('stores', 'branches'));
    })->name('stores');
    Route::post('/company-store-store', 'Site\CompanyController@store_store')->name('company.store.store');
    Route::get('/to-safes/{id?}', 'Site\CompanyController@safes')->name('to.safes');
    Route::get('/safes/{id?}', function () {
        $safes = Safe::where('company_id', $_GET['company_id'])->get();
        $branches = Branch::where('company_id', $_GET['company_id'])->get();
        return view('site.safes', compact('safes', 'branches'));
    })->name('safes');
    Route::post('/company-safe-store', 'Site\CompanyController@safe_store')->name('company.safe.store');

    Route::get('/clients-summary-post', 'Client\SummaryController@post_clients_summary')->name('clients.summary.post');
    Route::get('/suppliers-summary-post', 'Client\SummaryController@post_suppliers_summary')->name('suppliers.summary.post');
    Route::get('/sale-bills/print/{id?}', 'Client\SaleBillController@print')->name('client.sale_bills.print');
    Route::get('/buy-bills/print/{id?}', 'Client\BuyBillController@print')->name('client.buy_bills.print');
});


// *********  Admin Routes ******** //

Route::group(
    [
        'namespace' => 'Admin',
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Auth::routes(
        [
            'verify' => false,
            'register' => false,
        ]
    );
    Route::GET('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::POST('admin/login', 'Auth\LoginController@login');
    Route::POST('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::GET('admin/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm');
    Route::POST('admin/password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::POST('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::GET('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::POST('admin/password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
    Route::GET('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::group(
    [
        'namespace' => 'Client',
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Auth::routes(
        [
            'verify' => false,
            'register' => false,
        ]
    );
    Route::GET('client/login', 'Auth\LoginController@showLoginForm')->name('client.login');
    Route::POST('client/login', 'Auth\LoginController@login');
    Route::POST('client/logout', 'Auth\LoginController@logout')->name('client.logout');
    Route::GET('client/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('client.password.confirm');
    Route::POST('client/password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::POST('client/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
    Route::GET('client/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('client.password.request');
    Route::POST('client/password/reset', 'Auth\ResetPasswordController@reset')->name('client.password.update');
    Route::GET('client/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('client.password.reset');
});

Route::group(
    [
        'namespace' => 'Client',
        'prefix' => LaravelLocalization::setLocale(). '/receipt',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('maintenance-devices/receipt/login', 'MaintenanceController@receipt_page_login')->name('receipt.page.login');
    Route::post('maintenance-devices/receipt/login', 'MaintenanceController@receipt_page_login_post')->name('receipt.page.login.post');
    Route::get('maintenance-devices/receipt/{id?}', 'MaintenanceController@receipt_page')->name('receipt.page');
    Route::post('maintenance-devices/receipt/accept-cost', 'MaintenanceController@accept_cost');
    Route::post('maintenance-devices/receipt/deny-cost', 'MaintenanceController@deny_cost');
    Route::post('maintenance-devices/receipt/hand-over', 'MaintenanceController@hand_over');
});
Route::group(
    [
        'namespace' => 'Client',
        'prefix' => LaravelLocalization::setLocale() .'/client',
        'middleware' => ['auth:client-web', 'CheckStatus','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'HomeController@index')->name('client.home');
    Route::get('/go-to-upgrade', 'HomeController@go_to_upgrade')->name('go.to.upgrade');
    Route::get('/go-to-upgrade2/{id?}', 'HomeController@go_to_upgrade2')->name('go.to.upgrade2');

    // clients Routes
    Route::resource('clients', 'ClientController')->names([
        'index' => 'client.clients.index',
        'create' => 'client.clients.create',
        'update' => 'client.clients.update',
        'destroy' => 'client.clients.destroy',
        'edit' => 'client.clients.edit',
        'store' => 'client.clients.store',
    ]);
    // ClientProfile Routes
    Route::get('profile/edit/{id}', 'ClientProfileController@edit')->name('client.profile.edit');
    Route::patch('profile/edit/{id}', 'ClientProfileController@update')->name('client.profile.update');
    Route::patch('profile/store/{id}', 'ClientProfileController@store')->name('client.profile.store');

    // settings
    Route::get('client-basic-settings-edit', 'SettingsController@basic')->name('client.basic.settings.edit');
    Route::get('client-billing-settings-edit', 'SettingsController@billing')->name('client.billing.settings.edit');
    Route::get('client-extra-settings-edit', 'SettingsController@extra')->name('client.extra.settings.edit');
    Route::get('client-backup-settings-edit', 'SettingsController@backup')->name('client.backup.settings.edit');
    Route::get('client-backup', 'SettingsController@get_backup')->name('client.get.backup');
    Route::patch('client-basic-settings-update', 'SettingsController@update_basic')->name('client.basic.settings.update');
    Route::patch('client-billing-settings-update', 'SettingsController@update_billing')->name('client.billing.settings.update');
    Route::patch('client-extra-settings-update', 'SettingsController@update_extra')->name('client.extra.settings.update');
    Route::post('client-restore', 'SettingsController@restore')->name('client.restore');

    Route::get('screens-settings', 'SettingsController@screens_settings')->name('screens.settings');
    Route::get('screens-settings-edit/{id?}', 'SettingsController@screens_settings_edit')->name('screens.settings.edit');
    Route::patch('screens-settings-update', 'SettingsController@screens_settings_update')
        ->name('screens.settings.update');

    Route::get('pos-settings', 'SettingsController@pos_settings')->name('pos.settings');
    Route::get('pos-settings-edit/{id?}', 'SettingsController@pos_settings_edit')->name('pos.settings.edit');
    Route::patch('pos-settings-update', 'SettingsController@pos_settings_update')
        ->name('pos.settings.update');


    // Branches Routes
    Route::resource('branches', 'BranchController')->names([
        'index' => 'client.branches.index',
        'create' => 'client.branches.create',
        'update' => 'client.branches.update',
        'destroy' => 'client.branches.destroy',
        'edit' => 'client.branches.edit',
        'store' => 'client.branches.store',
    ]);

    // Stores Routes
    Route::resource('stores', 'StoreController')->names([
        'index' => 'client.stores.index',
        'create' => 'client.stores.create',
        'update' => 'client.stores.update',
        'destroy' => 'client.stores.destroy',
        'edit' => 'client.stores.edit',
        'store' => 'client.stores.store',
    ]);

    Route::get('clients-stores-inventory-get', 'StoreController@inventory_get')->name('client.inventory.get');
    Route::post('clients-stores-inventory-post', 'StoreController@inventory_post')->name('client.inventory.post');
    Route::post('export-inventory', 'ImportExportController@export_inventory')->name('inventory.export');

    Route::get('clients-stores-transfer-get', 'StoreController@transfer_get')->name('client.stores.transfer.get');
    Route::post('clients-stores-transfer-post', 'StoreController@transfer_post')->name('client.stores.transfer.post');

    Route::post('get-products-by-store-id', 'StoreController@get_products_by_store_id')->name('get.products.by.store.id');

    Route::post('get-clients-by-branch-id', 'ReportController@get_clients_by_branch_id')->name('get.clients.by.branch.id');


    // Safes Routes
    Route::resource('safes', 'SafeController')->names([
        'index' => 'client.safes.index',
        'create' => 'client.safes.create',
        'update' => 'client.safes.update',
        'destroy' => 'client.safes.destroy',
        'edit' => 'client.safes.edit',
        'store' => 'client.safes.store',
    ]);
    Route::get('safes-transfer', 'SafeController@transfer_get')->name('client.safes.transfer');
    Route::post('safes-transfer-post', 'SafeController@transfer_post')->name('client.safes.transfer.post');
    Route::delete('safes-transfer-destroy', 'SafeController@transfer_destroy')->name('client.safes.transfer.destroy');

    // Categories Routes
    Route::resource('categories', 'CategoryController')->names([
        'index' => 'client.categories.index',
        'create' => 'client.categories.create',
        'update' => 'client.categories.update',
        'destroy' => 'client.categories.destroy',
        'edit' => 'client.categories.edit',
        'store' => 'client.categories.store',
    ]);
    // subCategories Routes
    Route::resource('subcategories', 'SubCategoryController')->names([
        'index' => 'client.subcategories.index',
        'create' => 'client.subcategories.create',
        'update' => 'client.subcategories.update',
        'destroy' => 'client.subcategories.destroy',
        'edit' => 'client.subcategories.edit',
        'store' => 'client.subcategories.store',
    ]);
    // units Routes
    Route::resource('units', 'UnitController')->names([
        'index' => 'client.units.index',
        'create' => 'client.units.create',
        'update' => 'client.units.update',
        'destroy' => 'client.units.destroy',
        'edit' => 'client.units.edit',
        'store' => 'client.units.store',
    ]);

    // products Routes
    Route::resource('products', 'ProductController')->names([
        'index' => 'client.products.index',
        'create' => 'client.products.create',
        'update' => 'client.products.update',
        'destroy' => 'client.products.destroy',
        'edit' => 'client.products.edit',
        'store' => 'client.products.store',
        'show' => 'client.products.show',
    ]);
    Route::get('clients-products-empty', 'ProductController@empty')->name('client.products.empty');
    Route::get('clients-products-limited', 'ProductController@limited')->name('client.products.limited');
    Route::get('clients-products-print', 'ProductController@print')->name('client.products.print');

    Route::post('remove-product-unit', 'ProductController@remove_unit')->name('remove.product.unit');

    Route::post('add-serials', 'ProductController@add_serials')->name('add.serials');
    Route::post('save-serials', 'ProductController@save_serials')->name('save.serials');

    Route::post('clients-products-storePos', 'ProductController@store_pos')->name('client.products.storePos');
    Route::get('/generate-barcode', 'ProductController@barcode')->name('barcode');
    Route::post('/generate-barcode', 'ProductController@generate_barcode')->name('generate.barcode');

    // outer_clients Routes
    Route::resource('outer_clients', 'OuterClientController')->names([
        'index' => 'client.outer_clients.index',
        'create' => 'client.outer_clients.create',
        'update' => 'client.outer_clients.update',
        'destroy' => 'client.outer_clients.destroy',
        'edit' => 'client.outer_clients.edit',
        'store' => 'client.outer_clients.store',
        'show' => 'client.outer_clients.show',
    ]);
    Route::get('clients-outer-clients-print', 'OuterClientController@print')->name('client.outer_clients.print');

    Route::get('clients-outer-clients-filter', 'OuterClientController@filter_clients')->name('client.outer_clients.filter');
    Route::get('clients-outer-clients-filter-key', 'OuterClientController@filter_clients');
    Route::post('clients-outer-clients-filter-key', 'OuterClientController@filter_key')->name('client.outer_clients.filter.key');

    Route::post('outer-clients-filter-name', 'OuterClientController@filter_name')->name('client.outer_clients.filter.name');

    Route::post('clients-outer-clients-storePos', 'OuterClientController@store_pos')->name('client.outer_clients.storePos');
    Route::post('clients-outer-clients-showPos', 'OuterClientController@show_pos')->name('client.outer_clients.showPos');

    // suppliers Routes
    Route::resource('suppliers', 'SupplierController')->names([
        'index' => 'client.suppliers.index',
        'create' => 'client.suppliers.create',
        'update' => 'client.suppliers.update',
        'destroy' => 'client.suppliers.destroy',
        'edit' => 'client.suppliers.edit',
        'store' => 'client.suppliers.store',
        'show' => 'client.suppliers.show',
    ]);

    Route::get('clients-suppliers-print', 'SupplierController@print')->name('client.suppliers.print');

    Route::get('clients-suppliers-filter', 'SupplierController@filter_suppliers')->name('client.suppliers.filter');
    Route::get('clients-suppliers-filter-key', 'SupplierController@filter_suppliers');
    Route::post('clients-suppliers-filter-key', 'SupplierController@filter_key')->name('client.suppliers.filter.key');


    // banks Routes
    Route::resource('banks', 'BankController')->names([
        'index' => 'client.banks.index',
        'create' => 'client.banks.create',
        'update' => 'client.banks.update',
        'destroy' => 'client.banks.destroy',
        'edit' => 'client.banks.edit',
        'store' => 'client.banks.store',
        'show' => 'client.banks.show',
    ]);

    Route::get('clients-banks-process', 'BankController@banks_process')->name('client.banks.process');
    Route::post('clients-banks-process-store', 'BankController@banks_process_store')->name('client.banks.process.store');
    Route::delete('clients-banks-process-destroy', 'BankController@banks_process_destroy')->name('client.banks.process.destroy');

    Route::get('clients-banks-transfer', 'BankController@banks_transfer')->name('client.banks.transfer');
    Route::post('clients-banks-transfer-store', 'BankController@banks_transfer_store')->name('client.banks.transfer.store');
    Route::delete('clients-banks-transfer-destroy', 'BankController@banks_transfer_destroy')->name('client.banks.transfer.destroy');

    Route::get('clients-bank-safe-transfer', 'BankController@bank_safe_transfer')->name('client.bank.safe.transfer');
    Route::post('clients-bank-safe-transfer-store', 'BankController@bank_safe_transfer_store')->name('client.bank.safe.transfer.store');
    Route::delete('clients-bank-safe-transfer-destroy', 'BankController@bank_safe_transfer_destroy')->name('client.bank.safe.transfer.destroy');

    Route::get('clients-safe-bank-transfer', 'BankController@safe_bank_transfer')->name('client.safe.bank.transfer');
    Route::post('clients-bank-safe-bank-transfer-store', 'BankController@safe_bank_transfer_store')->name('client.safe.bank.transfer.store');
    Route::delete('clients-bank-safe-bank-transfer-destroy', 'BankController@safe_bank_transfer_destroy')->name('client.safe.bank.transfer.destroy');


    Route::get('clients-expenses-fixed', 'ExpenseController@fixed_expenses')->name('client.fixed.expenses');
    Route::post('clients-fixed-expenses-store', 'ExpenseController@fixed_expenses_store')->name('client.fixed.expenses.store');
    Route::delete('clients-fixed-expenses-destroy', 'ExpenseController@fixed_expenses_destroy')->name('client.fixed.expenses.destroy');
    Route::get('clients-fixed-expenses-edit/{id?}', 'ExpenseController@fixed_expenses_edit')->name('client.fixed.expenses.edit');
    Route::patch('clients-fixed-expenses-update/{id?}', 'ExpenseController@fixed_expenses_update')->name('client.fixed.expenses.update');


    // expenses Routes
    Route::resource('expenses', 'ExpenseController')->names([
        'index' => 'client.expenses.index',
        'create' => 'client.expenses.create',
        'update' => 'client.expenses.update',
        'destroy' => 'client.expenses.destroy',
        'edit' => 'client.expenses.edit',
        'store' => 'client.expenses.store',
        'show' => 'client.expenses.show',
    ]);

    Route::get('clients-add-cash-clients', 'CashController@add_cash_clients')->name('client.add.cash.clients');
    Route::post('clients-store-cash-clients', 'CashController@store_cash_clients')->name('client.store.cash.clients');
    Route::get('clients-cash-clients', 'CashController@cash_clients')->name('client.cash.clients');
    Route::get('clients-edit-cash-clients/{id?}', 'CashController@edit_cash_clients')->name('client.edit.cash.clients');
    Route::delete('clients-delete-cash-clients', 'CashController@destroy_cash_clients')->name('client.destroy.cash.clients');
    Route::patch('clients-update-cash-clients/{id?}', 'CashController@update_cash_clients')->name('client.update.cash.clients');

    Route::get('clients-give-cash-clients', 'CashController@give_cash_clients')->name('client.give.cash.clients');
    Route::post('clients-store2-cash-clients', 'CashController@store2_cash_clients')->name('client.store2.cash.clients');
    Route::get('clients-borrow-clients', 'CashController@borrow_clients')->name('client.borrow.clients');
    Route::get('clients-edit-borrow-clients/{id?}', 'CashController@edit_borrow_clients')->name('client.edit.borrow.clients');
    Route::delete('clients-delete-borrow-clients', 'CashController@destroy_borrow_clients')->name('client.destroy.borrow.clients');
    Route::patch('clients-update-borrow-clients/{id?}', 'CashController@update_borrow_clients')->name('client.update.borrow.clients');


    Route::get('clients-add-cashbank-clients', 'CashBankController@add_cashbank_clients')->name('client.add.cashbank.clients');
    Route::post('clients-store-cashbank-clients', 'CashBankController@store_cashbank_clients')->name('client.store.cashbank.clients');
    Route::get('clients-cashbank-clients', 'CashBankController@cashbank_clients')->name('client.cashbank.clients');
    Route::get('clients-edit-cashbank-clients/{id?}', 'CashBankController@edit_cashbank_clients')->name('client.edit.cashbank.clients');
    Route::delete('clients-delete-cashbank-clients', 'CashBankController@destroy_cashbank_clients')->name('client.destroy.cashbank.clients');
    Route::patch('clients-update-cashbank-clients/{id?}', 'CashBankController@update_cashbank_clients')->name('client.update.cashbank.clients');


    Route::get('clients-add-cash-suppliers', 'CashController@add_cash_suppliers')->name('client.add.cash.suppliers');
    Route::post('clients-store-cash-suppliers', 'CashController@store_cash_suppliers')->name('client.store.cash.suppliers');
    Route::get('clients-cash-suppliers', 'CashController@cash_suppliers')->name('client.cash.suppliers');
    Route::get('clients-edit-cash-suppliers/{id?}', 'CashController@edit_cash_suppliers')->name('client.edit.cash.suppliers');
    Route::delete('clients-delete-cash-suppliers', 'CashController@destroy_cash_suppliers')->name('client.destroy.cash.suppliers');
    Route::patch('clients-update-cash-suppliers/{id?}', 'CashController@update_cash_suppliers')->name('client.update.cash.suppliers');


    Route::get('clients-give-cash-suppliers', 'CashController@give_cash_suppliers')->name('client.give.cash.suppliers');
    Route::post('clients-store2-cash-suppliers', 'CashController@store2_cash_suppliers')->name('client.store2.cash.suppliers');
    Route::get('clients-borrow-suppliers', 'CashController@borrow_suppliers')->name('client.borrow.suppliers');
    Route::get('clients-edit-borrow-suppliers/{id?}', 'CashController@edit_borrow_suppliers')->name('client.edit.borrow.suppliers');
    Route::delete('clients-delete-borrow-suppliers', 'CashController@destroy_borrow_suppliers')->name('client.destroy.borrow.suppliers');
    Route::patch('clients-update-borrow-suppliers/{id?}', 'CashController@update_borrow_suppliers')->name('client.update.borrow.suppliers');


    Route::get('clients-add-cashbank-suppliers', 'CashBankController@add_cashbank_suppliers')->name('client.add.cashbank.suppliers');
    Route::post('clients-store-cashbank-suppliers', 'CashBankController@store_cashbank_suppliers')->name('client.store.cashbank.suppliers');
    Route::get('clients-cashbank-suppliers', 'CashBankController@cashbank_suppliers')->name('client.cashbank.suppliers');
    Route::get('clients-edit-cashbank-suppliers/{id?}', 'CashBankController@edit_cashbank_suppliers')->name('client.edit.cashbank.suppliers');
    Route::delete('clients-delete-cashbank-suppliers', 'CashBankController@destroy_cashbank_suppliers')->name('client.destroy.cashbank.suppliers');
    Route::patch('clients-update-cashbank-suppliers/{id?}', 'CashBankController@update_cashbank_suppliers')->name('client.update.cashbank.suppliers');


    // capitals Routes
    Route::resource('capitals', 'CapitalController')->names([
        'index' => 'client.capitals.index',
        'create' => 'client.capitals.create',
        'update' => 'client.capitals.update',
        'destroy' => 'client.capitals.destroy',
        'edit' => 'client.capitals.edit',
        'store' => 'client.capitals.store',
        'show' => 'client.capitals.show',
    ]);

    // gifts Routes
    Route::resource('gifts', 'GiftController')->names([
        'index' => 'client.gifts.index',
        'create' => 'client.gifts.create',
        'update' => 'client.gifts.update',
        'destroy' => 'client.gifts.destroy',
        'edit' => 'client.gifts.edit',
        'store' => 'client.gifts.store',
        'show' => 'client.gifts.show',
    ]);

    Route::get('clients-emails-clients', 'EmailController@emails_clients')->name('client.emails.clients');
    Route::post('clients-send-client-email', 'EmailController@send_client_email')->name('client.send.client.email');

    Route::get('clients-emails-suppliers', 'EmailController@emails_suppliers')->name('client.emails.suppliers');
    Route::post('clients-send-supplier-email', 'EmailController@send_supplier_email')->name('client.send.supplier.email');

// quotations Routes
    Route::resource('quotations', 'QuotationController')->names([
        'index' => 'client.quotations.index',
        'create' => 'client.quotations.create',
        'update' => 'client.quotations.update',
        'destroy' => 'client.quotations.destroy',
        'edit' => 'client.quotations.edit',
        'store' => 'client.quotations.store',
        'show' => 'client.quotations.show',
    ]);
    Route::post('/quotations/get', 'QuotationController@get_product_price');
    Route::post('/quotations/elements', 'QuotationController@get_quotation_elements');
    Route::post('/quotations/element/delete', 'QuotationController@destroy_element');
    Route::post('/quotations/element/destroy', 'QuotationController@delete_element');
    Route::post('/quotations/post', 'QuotationController@save');
    Route::post('/quotations/discount', 'QuotationController@apply_discount');
    Route::post('/quotations/extra', 'QuotationController@apply_extra');
    Route::post('/quotations/updateData', 'QuotationController@updateData');
    Route::post('/quotations-changeQuotation', 'QuotationController@changeQuotation');

    Route::post('/quotations/get-edit', 'QuotationController@get_edit_product_price');
    Route::post('/quotations/element/update', 'QuotationController@update_element');
    Route::post('/quotations/edit-element', 'QuotationController@edit_element');


    Route::get('/quotations/send/{id?}', 'QuotationController@send')->name('client.quotations.send');
    Route::get('/quotations-redirect', 'QuotationController@redirect')->name('client.quotations.redirect');

    Route::post('clients-quotations-filter-key', 'QuotationController@filter_key')->name('client.quotations.filter.key');
    Route::post('clients-quotations-filter-client', 'QuotationController@filter_client')->name('client.quotations.filter.client');
    Route::post('clients-quotations-filter-code', 'QuotationController@filter_code')->name('client.quotations.filter.code');
    Route::post('clients-quotations-filter-product', 'QuotationController@filter_product')->name('client.quotations.filter.product');
    Route::post('clients-quotations-filter-all', 'QuotationController@filter_all')->name('client.quotations.filter.all');

    Route::post('/quotations/getOuterClientDetails', 'QuotationController@get_outer_client_details');
    Route::post('/quotations/getProducts', 'QuotationController@get_products');
    Route::delete('/quotations-deleteBill', 'QuotationController@delete_bill')->name('client.quotations.deleteBill');

    Route::get('/convert-to-salebill/{id?}', 'QuotationController@convert_to_salebill')
        ->name('convert.to.salebill');


// purchase_orders Routes
    Route::resource('purchase_orders', 'PurchaseOrderController')->names([
        'index' => 'client.purchase_orders.index',
        'create' => 'client.purchase_orders.create',
        'update' => 'client.purchase_orders.update',
        'destroy' => 'client.purchase_orders.destroy',
        'edit' => 'client.purchase_orders.edit',
        'store' => 'client.purchase_orders.store',
        'show' => 'client.purchase_orders.show',
    ]);
    Route::post('/purchase_orders/get', 'PurchaseOrderController@get_product_price');
    Route::post('/purchase_orders/elements', 'PurchaseOrderController@get_purchase_order_elements');
    Route::post('/purchase_orders/element/delete', 'PurchaseOrderController@destroy_element');
    Route::post('/purchase_orders/element/destroy', 'PurchaseOrderController@delete_element');
    Route::post('/purchase_orders/post', 'PurchaseOrderController@save');
    Route::post('/purchase_orders/discount', 'PurchaseOrderController@apply_discount');
    Route::post('/purchase_orders/extra', 'PurchaseOrderController@apply_extra');
    Route::post('/purchase_orders/updateData', 'PurchaseOrderController@updateData');
    Route::post('/purchase_orders-changepurchase_order', 'PurchaseOrderController@changePurchaseOrder');

    Route::get('/purchase_orders/send/{id?}', 'PurchaseOrderController@send')->name('client.purchase_orders.send');
    Route::get('/purchase_orders-redirect', 'PurchaseOrderController@redirect')->name('client.purchase_orders.redirect');

    Route::post('/purchase_orders/get-edit', 'PurchaseOrderController@get_edit_product_price');
    Route::post('/purchase_orders/element/update', 'PurchaseOrderController@update_element');
    Route::post('/purchase_orders/edit-element', 'PurchaseOrderController@edit_element');


    Route::post('clients-purchase_orders-filter-key', 'PurchaseOrderController@filter_key')->name('client.purchase_orders.filter.key');
    Route::post('clients-purchase_orders-filter-supplier', 'PurchaseOrderController@filter_supplier')->name('client.purchase_orders.filter.supplier');
    Route::post('clients-purchase_orders-filter-code', 'PurchaseOrderController@filter_code')->name('client.purchase_orders.filter.code');
    Route::post('clients-purchase_orders-filter-product', 'PurchaseOrderController@filter_product')->name('client.purchase_orders.filter.product');
    Route::post('clients-purchase_orders-filter-all', 'PurchaseOrderController@filter_all')->name('client.purchase_orders.filter.all');

    Route::post('/purchase_orders/getSupplierDetails', 'PurchaseOrderController@get_supplier_details');
    Route::post('/purchase_orders/getProducts', 'PurchaseOrderController@get_products');
    Route::delete('/purchase_orders-deleteBill', 'PurchaseOrderController@delete_bill')->name('client.purchase_orders.deleteBill');

    Route::get('/convert-to-buybill/{id?}', 'PurchaseOrderController@convert_to_buybill')
        ->name('convert.to.buybill');

// sale_bills Routes
    Route::resource('sale_bills', 'SaleBillController')->names([
        'index' => 'client.sale_bills.index',
        'create' => 'client.sale_bills.create',
        'update' => 'client.sale_bills.update',
        'destroy' => 'client.sale_bills.destroy',
        'edit' => 'client.sale_bills.edit',
        'store' => 'client.sale_bills.store',
        'show' => 'client.sale_bills.show',
    ]);
    Route::post('/sale-bills/get', 'SaleBillController@get_product_price');
    Route::post('/sale-bills/change-product-price', 'SaleBillController@change_product_price');
    Route::post('/get-product-units', 'SaleBillController@get_product_units')->name('get.product.units');
    Route::post('/get-edit-product-units', 'SaleBillController@get_edit_product_units')->name('get.edit.product.units');

    Route::post('/change-product-unit', 'SaleBillController@change_product_unit')
        ->name('change.product.unit');

    Route::post('add-serials-sales', 'SaleBillController@add_serials')->name('add.serials.sales');
    Route::post('save-serials-sales', 'SaleBillController@save_serials')->name('save.serials.sales');

    Route::post('/sale-bills/getOuterClientDetails', 'SaleBillController@get_outer_client_details');
    Route::post('/sale-bills/elements', 'SaleBillController@get_sale_bill_elements');
    Route::post('/sale-bills/element/delete', 'SaleBillController@delete_element');

    Route::post('/sale-bills/get-edit', 'SaleBillController@get_edit_product_price');
    Route::post('/sale-bills/element/update', 'SaleBillController@update_element');
    Route::post('/sale-bills/edit-element', 'SaleBillController@edit_element');

    Route::post('/sale-bills/post', 'SaleBillController@save');
    Route::post('/sale-bills/discount', 'SaleBillController@apply_discount');
    Route::post('/sale-bills/extra', 'SaleBillController@apply_extra');
    Route::post('/sale-bills/updateData', 'SaleBillController@updateData');
    Route::post('/sale-bills/saveAll', 'SaleBillController@saveAll');
    Route::post('/clients-store-cash-outer-clients-sale-bills', 'SaleBillController@store_cash_outer_clients')->name('client.store.cash.outerClients.SaleBill');
    Route::post('/sale-bills/refresh', 'SaleBillController@refresh');

    Route::post('clients-sale-bills-filter-key', 'SaleBillController@filter_key')->name('client.sale_bills.filter.key');
    Route::post('clients-sale-bills-filter-outer-client', 'SaleBillController@filter_outer_client')->name('client.sale_bills.filter.outer_client');
    Route::post('clients-sale-bills-filter-code', 'SaleBillController@filter_code')->name('client.sale_bills.filter.code');
    Route::post('clients-sale-bills-filter-product', 'SaleBillController@filter_product')->name('client.sale_bills.filter.product');
    Route::post('clients-sale-bills-filter-all', 'SaleBillController@filter_all')->name('client.sale_bills.filter.all');

    Route::post('/sale-bills/get-return', 'SaleBillController@get_return');
    Route::post('/sale-bills/post-return', 'SaleBillController@post_return')->name('client.sale_bills.post.return');
    Route::get('/sale-bills/get-returns', 'SaleBillController@get_returns')->name('client.sale_bills.returns');
    Route::get('/sale-bills-redirect', 'SaleBillController@redirect')->name('client.sale_bills.redirect');
    Route::get('/sale-bills/send/{id?}', 'SaleBillController@send')->name('client.sale_bills.send');

    Route::post('/sale-bills/getProducts', 'SaleBillController@get_products');
    Route::delete('/sale-bills/deleteBill', 'SaleBillController@delete_bill')->name('client.sale_bills.deleteBill');
    Route::post('/sale-bills/deleteSaleBill', 'SaleBillController@destroy')->name('client.sale_bills.cancel');
    Route::post('/sale-bills/pay-delete', 'SaleBillController@pay_delete')->name('sale_bills.pay.delete');

    // buy_bills Routes
    Route::resource('buy_bills', 'BuyBillController')->names([
        'index' => 'client.buy_bills.index',
        'create' => 'client.buy_bills.create',
        'update' => 'client.buy_bills.update',
        'destroy' => 'client.buy_bills.destroy',
        'edit' => 'client.buy_bills.edit',
        'store' => 'client.buy_bills.store',
        'show' => 'client.buy_bills.show',
    ]);

    Route::post('/buy-bills/get', 'BuyBillController@get_product_price');
    Route::post('/buy-bills/elements', 'BuyBillController@get_buy_bill_elements');
    Route::post('/buy-bills/element/delete', 'BuyBillController@delete_element');
    Route::post('/buy-bills/post', 'BuyBillController@save');
    Route::post('/buy-bills/discount', 'BuyBillController@apply_discount');
    Route::post('/buy-bills/extra', 'BuyBillController@apply_extra');
    Route::post('/buy-bills/updateData', 'BuyBillController@updateData');
    Route::post('/buy-bills/saveAll', 'BuyBillController@saveAll');
    Route::post('/clients-store-cash-suppliers-buy-bills', 'BuyBillController@store_cash_suppliers')->name('client.store.cash.suppliers.buyBill');
    Route::post('/buy-bills/refresh', 'BuyBillController@refresh');

    Route::post('add-serials-buy', 'BuyBillController@add_serials')->name('add.serials.buy');
    Route::post('save-serials-buy', 'BuyBillController@save_serials')->name('save.serials.buy');

    Route::post('/buy-bills/get-edit', 'BuyBillController@get_edit_product_price');
    Route::post('/buy-bills/element/update', 'BuyBillController@update_element');
    Route::post('/buy-bills/edit-element', 'BuyBillController@edit_element');

    Route::post('clients-buy-bills-filter-key', 'BuyBillController@filter_key')->name('client.buy_bills.filter.key');
    Route::post('clients-buy-bills-filter-supplier', 'BuyBillController@filter_supplier')->name('client.buy_bills.filter.supplier');
    Route::post('clients-buy-bills-filter-code', 'BuyBillController@filter_code')->name('client.buy_bills.filter.code');
    Route::post('clients-buy-bills-filter-product', 'BuyBillController@filter_product')->name('client.buy_bills.filter.product');
    Route::post('clients-buy-bills-filter-all', 'BuyBillController@filter_all')->name('client.buy_bills.filter.all');

    Route::post('/buy-bills/get-return', 'BuyBillController@get_return');
    Route::post('/buy-bills/post-return', 'BuyBillController@post_return')->name('client.buy_bills.post.return');
    Route::get('/buy-bills/get-returns', 'BuyBillController@get_returns')->name('client.buy_bills.returns');
    Route::get('/buy-bills-redirect', 'BuyBillController@redirect')->name('client.buy_bills.redirect');
    Route::get('/buy-bills/send/{id?}', 'BuyBillController@send')->name('client.buy_bills.send');

    Route::post('/buy-bills/getSupplierDetails', 'BuyBillController@get_supplier_details');
    Route::post('/buy-bills/getProducts', 'BuyBillController@get_products');
    Route::delete('/buy-bills/deleteBill', 'BuyBillController@delete_bill')->name('client.buy_bills.deleteBill');
    Route::post('/buy-bills/deleteBuyBill', 'BuyBillController@destroy')->name('client.buy_bills.cancel');
    Route::post('/buy-bills/pay-delete', 'BuyBillController@pay_delete')->name('buy_bills.pay.delete');

    // summary routes
    Route::get('/clients-summary-get', 'SummaryController@get_clients_summary');
    Route::get('/suppliers-summary-get', 'SummaryController@get_suppliers_summary');

    Route::get('/employees-summary-get', 'SummaryController@get_employees_summary');
    Route::post('/employees-summary-post', 'SummaryController@post_employees_summary')->name('employees.summary.post');

    Route::post('/clients-summary/send', 'SummaryController@send_client_summary')
        ->name('client.summary.send');

    Route::post('/suppliers-summary/send', 'SummaryController@send_supplier_summary')
        ->name('supplier.summary.send');

    // daily routes

    Route::get('/daily/get', 'DailyController@get_daily');
    Route::post('/daily/post', 'DailyController@post_daily')->name('client.daily.post');

// reports

    Route::get('/reports', 'ReportController@reports')->name('client.reports');
    Route::get('/report1/get', 'ReportController@get_report1');
    Route::post('/report1/post', 'ReportController@post_report1')->name('client.report1.post');

    Route::get('/report2/get', 'ReportController@get_report2');
    Route::post('/report2/post', 'ReportController@post_report2')->name('client.report2.post');

    Route::get('/report3/get', 'ReportController@get_report3');
    Route::post('/report3/post', 'ReportController@post_report3')->name('client.report3.post');

    Route::get('/report4/get', 'ReportController@get_report4');
    Route::post('/report4/post', 'ReportController@post_report4')->name('client.report4.post');

    Route::get('/report5/get', 'ReportController@get_report5');
    Route::post('/report5/post', 'ReportController@post_report5')->name('client.report5.post');

    Route::get('/report6/get', 'ReportController@get_report6');
    Route::post('/report6/post', 'ReportController@post_report6')->name('client.report6.post');

    Route::get('/report7/get', 'ReportController@get_report7');
    Route::post('/report7/post', 'ReportController@post_report7')->name('client.report7.post');

    Route::get('/report8/get', 'ReportController@get_report8');
    Route::post('/report8/post', 'ReportController@post_report8')->name('client.report8.post');

    Route::get('/report9/get', 'ReportController@get_report9');
    Route::post('/report9/post', 'ReportController@post_report9')->name('client.report9.post');

    Route::get('/report10/get', 'ReportController@get_report10');
    Route::post('/report10/post', 'ReportController@post_report10')->name('client.report10.post');

    Route::get('/report11/get', 'ReportController@get_report11');
    Route::post('/report11/post', 'ReportController@post_report11')->name('client.report11.post');

    Route::get('/report12/get', 'ReportController@get_report12');
    Route::post('/report12/post', 'ReportController@post_report12')->name('client.report12.post');

    Route::get('/report13/get', 'ReportController@get_report13');
    Route::post('/report13/post', 'ReportController@post_report13')->name('client.report13.post');

    Route::get('/report14/get', 'ReportController@get_report14');
    Route::post('/report14/post', 'ReportController@post_report14')->name('client.report14.post');

    Route::get('/report15/get', 'ReportController@get_report15');
    Route::post('/report15/post', 'ReportController@post_report15')->name('client.report15.post');

    Route::get('/report16/get', 'ReportController@get_report16');
    Route::post('/report16/post', 'ReportController@post_report16')->name('client.report16.post');

    Route::get('/report17/get', 'ReportController@get_report17');
    Route::post('/report17/post', 'ReportController@post_report17')->name('client.report17.post');

    Route::get('/report18/get', 'ReportController@get_report18');
    Route::post('/report18/post', 'ReportController@post_report18')->name('client.report18.post');

    Route::get('/report19/get', 'ReportController@get_report19');
    Route::post('/report19/post', 'ReportController@post_report19')->name('client.report19.post');

    Route::get('/report20/get', 'ReportController@get_report20');
    Route::post('/report20/post', 'ReportController@post_report20')->name('client.report20.post');

    Route::get('/report21/get', 'ReportController@get_report21');
    Route::post('/report21/post', 'ReportController@post_report21')->name('client.report21.post');

    Route::get('/report22/get', 'ReportController@get_report22');
    Route::post('/report22/post', 'ReportController@post_report22')->name('client.report22.post');

    // Roles Routes
    Route::resource('roles', 'RoleController')->names([
        'index' => 'client.roles.index',
        'create' => 'client.roles.create',
        'update' => 'client.roles.update',
        'destroy' => 'client.roles.destroy',
        'edit' => 'client.roles.edit',
        'store' => 'client.roles.store',
    ]);

    Route::get('export-suppliers', 'ImportExportController@export_suppliers')->name('suppliers.export');
    Route::post('import-suppliers', 'ImportExportController@import_suppliers')->name('suppliers.import');

    Route::get('export-outer-clients', 'ImportExportController@export_outer_clients')->name('outer_clients.export');
    Route::post('import-outer-clients', 'ImportExportController@import_outer_clients')->name('outer_clients.import');

    // employees Routes
    Route::resource('employees', 'EmployeeController')->names([
        'index' => 'client.employees.index',
        'create' => 'client.employees.create',
        'update' => 'client.employees.update',
        'destroy' => 'client.employees.destroy',
        'edit' => 'client.employees.edit',
        'store' => 'client.employees.store',
    ]);

    Route::get('employees-cashs', 'EmployeeController@cashs')->name('employees.cashs');

    Route::get('employees-cash', 'EmployeeController@get_cash')->name('employees.get.cash');
    Route::post('employees-cash-post', 'EmployeeController@post_cash')->name('employees.post.cash');

    Route::get('employees-cash-edit/{id?}', 'EmployeeController@edit_cash')->name('employees.cash.edit');
    Route::patch('employees-cash-update/{id?}', 'EmployeeController@update_cash')->name('employees.cash.update');

    Route::delete('employees-cash-destroy', 'EmployeeController@destroy_cash')->name('employees.cash.destroy');

    Route::get('pos-create/', 'PosController@create')->name('client.pos.create');
    Route::post('/pos/get-subcategories-by-category-id', 'PosController@get_subcategories_by_category_id');
    Route::post('/pos/get-products-by-sub-category-id', 'PosController@get_products_by_sub_category_id');

    Route::post('add-serials-pos', 'PosController@add_serials')->name('add.serials.pos');
    Route::post('save-serials-pos', 'PosController@save_serials')->name('save.serials.pos');

    Route::post('/pos-open/post', 'PosController@save');
    Route::post('/pos-open/elements', 'PosController@get_pos_open_elements');
    Route::post('/pos-open/edit-quantity', 'PosController@edit_quantity');
    Route::post('/pos-open/edit-price', 'PosController@edit_price');
    Route::post('/pos-open/edit-quantity-price', 'PosController@edit_quantity_price');
    Route::post('/pos-open/delete-element', 'PosController@delete_element');

    Route::post('/change-product-element-unit', 'PosController@change_element_product_unit')
        ->name('change.product.element.unit');

    Route::post('/store-tax', 'SettingsController@store_tax')->name('store.tax');
    Route::delete('/delete-tax', 'SettingsController@delete_tax')->name('delete.tax');

    Route::post('/pos-open-store-discount', 'PosController@store_discount')->name('pos.open.store.discount');
    Route::post('/pos-open-store-tax', 'PosController@store_tax')->name('pos.open.store.tax');

    Route::post('/pos-open-delete', 'PosController@delete_pos_open')->name('pos.open.delete');
    Route::post('/pos-open-pending', 'PosController@pending_pos_open')->name('pos.open.pending');
    Route::post('/pos-open-done', 'PosController@done_pos_open')->name('pos.open.done');
    Route::post('/pos-open-finish-cash', 'PosController@finish_cash_pos_open')->name('pos.open.finish.cash');
    Route::post('/pos-open-finish-bank', 'PosController@finish_bank_pos_open')->name('pos.open.finish.bank');
    Route::post('/pos-open-check', 'PosController@check_pos_open')->name('pos.open.check');

    Route::post('/pos-shift-close', 'PosController@pos_shift_close')->name('pos.shift.close');
    Route::get('/client-pos-shift-close/{id}', 'PosController@client_pos_shift_close')->name('client.pos.shift.close');
    Route::post('/pos-shift-open', 'PosController@pos_shift_open')->name('pos.shift.open');

    Route::get('/show-shift-details/{id?}', 'PosController@show_shift_details')->name('show.shift.details');

    Route::post('/pos-open-restore', 'PosController@restore_pos_open')->name('pos.open.restore');
    Route::post('/shuffle-coupon-codes', 'PosController@shuffle_coupon_codes')->name('shuffle.coupon.codes');
    Route::post('/add-coupon-code', 'PosController@add_coupon_code')->name('add.coupon.code');

    Route::post('/pos-open/refresh', 'PosController@refresh');
    Route::get('/pos-sales-report', 'PosController@pos_sales_report')->name('pos.sales.report');
    Route::get('/pos-sales-report-print', 'PosController@pos_sales_report_print')->name('pos.sales.report.print');

    Route::post('/pos-edit', 'PosController@pos_edit')->name('pos.edit');
    Route::post('/pos-delete', 'PosController@pos_delete')->name('pos.delete');
    Route::post('/pay-delete', 'PosController@pay_delete')->name('pay.delete');
    Route::post('/get-coupon-codes', 'PosController@get_coupon_codes')->name('get.coupon.codes');

    Route::get('/pos-print/{pos_id?}', 'PosController@print')->name('pos.open.print');

    // coupons Routes
    Route::resource('coupons', 'CouponController')->names([
        'index' => 'client.coupons.index',
        'create' => 'client.coupons.create',
        'update' => 'client.coupons.update',
        'destroy' => 'client.coupons.destroy',
        'edit' => 'client.coupons.edit',
        'store' => 'client.coupons.store',
    ]);
    Route::post('/get-coupon-code', 'PosController@get_coupon_code')->name('get.coupon.code');
    Route::post('/clients-store-cash-clients-pos', 'PosController@store_cash_clients')
        ->name('client.store.cash.clients.pos');
// Maintenance Routes
    Route::get('get-maintenance-device', 'MaintenanceController@get_maintenance_device')->name('get.maintenance.device');
    Route::post('post-maintenance-device', 'MaintenanceController@post_maintenance_device')->name('post.maintenance.device');

    Route::get('maintenance-devices', 'MaintenanceController@maintenance_devices')->name('maintenance.devices');

    Route::get('maintenance-bill-create/{id?}', 'MaintenanceController@maintenance_bill_create')->name('maintenance.bill.create');
    Route::get('maintenance-bills', 'MaintenanceController@maintenance_bills')->name('maintenance.bills');

    Route::get('maintenance-settings-view', 'MaintenanceController@maintenance_settings_view')->name('maintenance.settings.view');

    Route::post('maintenance-device-post', 'MaintenanceController@maintenance_device_post')->name('maintenance.device.post');
    Route::delete('maintenance-device-delete', 'MaintenanceController@maintenance_device_delete')->name('maintenance.device.delete');

    Route::post('maintenance-issue-post', 'MaintenanceController@maintenance_issue_post')->name('maintenance.issue.post');
    Route::delete('maintenance-issue-delete', 'MaintenanceController@maintenance_issue_delete')->name('maintenance.issue.delete');

    Route::post('maintenance-delegate-post', 'MaintenanceController@maintenance_delegate_post')->name('maintenance.delegate.post');
    Route::delete('maintenance-delegate-delete', 'MaintenanceController@maintenance_delegate_delete')->name('maintenance.delegate.delete');
    Route::post('maintenance-place-post', 'MaintenanceController@maintenance_place_post')->name('maintenance.place.post');
    Route::delete('maintenance-place-delete', 'MaintenanceController@maintenance_place_delete')->name('maintenance.place.delete');
    Route::post('/maintenance-bills/get', 'MaintenanceController@get_product_price');
    Route::post('/maintenance-bills/post', 'MaintenanceController@save');
    Route::post('/maintenance-bills/saveAll', 'MaintenanceController@saveAll');
    Route::post('/maintenance-bills/elements', 'MaintenanceController@get_maintenance_bill_elements');
    Route::post('/maintenance-bills/element/delete', 'MaintenanceController@delete_element');
    Route::post('/maintenance-bills/delete-bill', 'MaintenanceController@delete_bill');
    Route::post('/maintenance-bills/total-cost', 'MaintenanceController@total_cost');
    Route::post('/maintenance-bills/total-cost-2', 'MaintenanceController@total_cost_2');
    Route::post('/maintenance-bills/refresh', 'MaintenanceController@refresh');
    Route::post('/maintenance-bills/engineer-percent', 'MaintenanceController@engineer_percent');
    Route::get('maintenance-devices/print/{id?}', 'MaintenanceController@print_device_receipt')->name('print.device.receipt');

// engineers Routes
    Route::resource('engineers', 'EngineerController')->names([
        'index' => 'client.engineers.index',
        'create' => 'client.engineers.create',
        'store' => 'client.engineers.store',
        'edit' => 'client.engineers.edit',
        'update' => 'client.engineers.update',
        'destroy' => 'client.engineers.destroy',
    ]);

});


Route::group(
    [
        'namespace' => 'Admin',
        'prefix' => LaravelLocalization::setLocale().'/admin',
        'middleware' => ['auth:admin-web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'HomeController@index')->name('admin.home');

    Route::get('profile/edit/{id}', 'AdminProfileController@edit')->name('admin.profile.edit');
    Route::patch('profile/edit/{id}', 'AdminProfileController@update')->name('admin.profile.update');
    Route::patch('profile/store/{id}', 'AdminProfileController@store')->name('admin.profile.store');


    Route::get('intro', 'HomeController@intro_movie')->name('intro');
    Route::post('intro-movie-post', 'HomeController@intro_movie_post')->name('admin.intro.movie.post');


    Route::get('/social-links', 'HomeController@social_links')->name('social.links');
    Route::post('/update-social-links', 'HomeController@update_social_links')->name('update.social.links');

    // Contacts Routes
    Route::resource('contacts', 'ContactController')->names([
        'index' => 'admin.contacts.index',
        'show' => 'admin.contacts.show',
        'destroy' => 'admin.contacts.destroy'
    ]);
    Route::patch('contacts-make-as-read', 'ContactController@makeAsRead')->name('admin.contacts.make.as.read');
    Route::patch('contacts-make-as-important', 'ContactController@makeAsImportant')->name('admin.contacts.make.as.important');
    Route::patch('contacts-make-as-destroy', 'ContactController@makeAsDestroy')->name('admin.contacts.make.as.destroy');
    Route::patch('contacts-print', 'ContactController@print')->name('admin.contacts.print');
    Route::get('contacts-important', 'ContactController@showImportant')->name('admin.contacts.important');

    // Companies Routes
    Route::resource('companies', 'CompanyController')->names([
        'index' => 'admin.companies.index',
        'update' => 'admin.companies.update',
        'edit' => 'admin.companies.edit',
        'destroy' => 'admin.companies.destroy',
    ]);


    // subscriptions Routes
    Route::resource('subscriptions', 'SubscriptionController')->names([
        'index' => 'admin.subscriptions.index',
        'create' => 'admin.subscriptions.create',
        'update' => 'admin.subscriptions.update',
        'destroy' => 'admin.subscriptions.destroy',
        'edit' => 'admin.subscriptions.edit',
        'store' => 'admin.subscriptions.store',
    ]);
    Route::get('subscriptions-filter-get', 'SubscriptionController@get_filter')->name('subscriptions.filter.get');
    Route::post('subscriptions-filter-post', 'SubscriptionController@post_filter')->name('subscriptions.filter.post');


    // types Routes
    Route::resource('types', 'TypeController')->names([
        'index' => 'admin.types.index',
        'create' => 'admin.types.create',
        'update' => 'admin.types.update',
        'destroy' => 'admin.types.destroy',
        'edit' => 'admin.types.edit',
        'store' => 'admin.types.store',
    ]);

    // payments Routes
    Route::resource('payments', 'PaymentController')->names([
        'index' => 'admin.payments.index',
        'create' => 'admin.payments.create',
        'update' => 'admin.payments.update',
        'destroy' => 'admin.payments.destroy',
        'edit' => 'admin.payments.edit',
        'store' => 'admin.payments.store',
    ]);
    Route::get('payments-report-get', 'PaymentController@get_report')->name('payments.report.get');

    // payments Routes
    Route::resource('packages', 'PackageController')->names([
        'index' => 'admin.packages.index',
        'create' => 'admin.packages.create',
        'update' => 'admin.packages.update',
        'destroy' => 'admin.packages.destroy',
        'edit' => 'admin.packages.edit',
        'store' => 'admin.packages.store',
    ]);

});
?>
