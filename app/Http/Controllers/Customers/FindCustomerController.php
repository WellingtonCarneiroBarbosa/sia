<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers\Customer;
use Lang;

class FindCustomerController extends Controller
{
    /**
     * Find a customer by his corporation
     * name
     * 
     */
    public function corporation(Request $request)
    {
        $data = $request->all();

        $customers = Customer::where('corporation', 'LIKE', '%' . $data['corporation'] . '%')
                                                   ->paginate(config('app.paginate_limit'));

        $hasCustomers = hasData($customers);

        if(!$hasCustomers)
        {
            $error = Lang::get("We did not find any customer with this enterprise");
            return redirect()->back()->withInput()->withErrors($error);
        }

        return view('app.dashboard.customers.index', 
        [  
            'customers' => $customers, 'hasCustomers' => $hasCustomers
        ]);
    }
}
