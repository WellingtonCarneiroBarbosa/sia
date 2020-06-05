<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Customer;

class DeletedCustomer extends Controller
{
    public function index()
    {
        $customers = Customer::withTrashed()->paginate(config('app.paginate_limit'));

        $hasCustomers = hasData($customers);

        return view('app.dashboard.customers.deleted.index', [
            'customers' => $customers, 'hasCustomers' => $hasCustomers
        ]);
    }
}
