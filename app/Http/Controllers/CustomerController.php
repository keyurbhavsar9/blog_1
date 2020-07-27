<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Events\NewCustomerHasRegisteredEvent;
use App\Mail\WelcomeNewUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;


class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('test');
    }
    public function index()
    {

        //$activeCustomers = Customer::active()->get();

        //$inactiveCustomers = Customer::inactive()->get();

        $customers = Customer::with('company')->paginate(15);
        return view('customers.index', compact('customers'));


        /*return view('internals.customers', [
            'activeCustomers' => $activeCustomers,
            'inactiveCustomers' => $inactiveCustomers
        ]);*/
    }

    public function create()
    {
        $customer = new Customer();
        $companies = Company::all();
        return view('customers.create', compact('companies', 'customer'));
    }

    public function store(Request $request)
    {
        $this->authorize('cerate', Customer::class);
        //leave validation empty for optional fields

        $customer = Customer::create($this->validateRequest());

        $this->storeImage($customer);

        event(new NewCustomerHasRegisteredEvent($customer));


        return redirect('customers');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $companies = Company::all();
        return view('customers.edit', compact('customer', 'companies'));
    }


    public function update(Customer $customer)
    {
        $customer->update($this->validateRequest());
        $this->storeImage($customer);
        return redirect('customers/' . $customer->id);
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);
        $customer->delete($customer);
        return redirect('customers/');
    }

    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required | min:3',
            'email' => 'required | email',
            'active' => 'required',
            'company_id' => 'required',
            'image' => 'sometimes|file|image|max:5000', //sometimes required
        ]);

        //         'email' => 'required | email',
        //         'active' => 'required',
        //         'company_id' => 'required',

        //     ]);

        //     if (request()->hasFile('image')) {
        //         dd(request()->image);
        //         request()->validate([
        //             'image' => 'file|image|max:5000',
        //         ]);
        //     }

        //     return $validatedData;
    }

    private function storeImage($customer)
    {
        if (request()->has('image')) {

            $customer->update([
                'image' => request()->image->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $customer->image))->fit(300, 300);
            $image->save();
        }
    }
}
