<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Customers\Customer;
use App\Models\Schedules\Schedule;
use App\Models\Schedules\HistoricSchedule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(config('app.paginate_limit'));
        $hasCustomers = hasData($customers);

        return view('app.dashboard.customers.index', [
            'customers' => $customers, 'hasCustomers' => $hasCustomers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.dashboard.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data   = $request->all();

        $create = Customer::create($data);

        if(!$create){
            return redirect()
                     ->back()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->back()->with(['status' => Lang::get('Registered Customer')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('app.dashboard.customers.show',
        [
            'customer' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('app.dashboard.customers.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Customer::findOrFail($id)->update($request->all());

        if(!$update)
        {
            return redirect()->back()->withInput()->with(['error' => Lang::get('Something went wrong. Please try again!')]);
        }

        return redirect()->back()->with(['status' => Lang::get('Updated Customer')]);
    }

    /**
     * Confirm if really
     * want destroy the
     * customer :v 
     * 
     */
    public function confirmDestroy($id){
        $customer = Customer::findOrFail($id);

        $howManySchedulesWithThisCustomer = Schedule::where('customer_id', $customer->id)->count();

        return view('app.dashboard.customers.confirmDestroy', 
        [
            'customer' => $customer, 'howManySchedulesWithThisCustomer' => $howManySchedulesWithThisCustomer
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Customer::destroy($id);

        if(!$destroy)
        {
            return redirect()->back()->with(['error' -> Lang::get('Something went wrong. Please try again!')]);
        }

        $expiredSchedules = Schedule::withTrashed()->where('place_id', null)->orWhere('customer_id', $id)->get();

        $hasExpiredSchedules = hasData($expiredSchedules);

        if($hasExpiredSchedules){
            foreach($expiredSchedules as $schedule){
                $data = $schedule->getAttributes();
                HistoricSchedule::create($data);
                Schedule::where('id', $data["id"])->forceDelete();
            }
        }

        return redirect()->route('customers.index')->with(['status' => Lang::get('Customer permanently deleted')]);
    }
}
