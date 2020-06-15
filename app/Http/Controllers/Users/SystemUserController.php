<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\FullNameRule;
use App\Rules\EmailDomainRule;
use App\Rules\RegisterUserAccessRule;
use Illuminate\Auth\Events\Verified;
use App\Notifications\NewUserNotification;
use App\User;
use Lang;

class SystemUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->where('id', '!=', auth()->user()->id)->orderBy('name')->paginate(config('app.paginate_limit'));
        
        $hasUsers = hasData($users);

    	return view('app.dashboard.users.index',
    	[
    		'users' => $users, 'hasUsers' => $hasUsers
    	]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /**
         * Custom messages for 
         * exceptions
         * 
         */
        $messages  = [
            'unique' => Lang::get('This user has already been registered. Enter a different email')
        ];

        /**
         * Validate request
         * 
         */
        $data = $request->except('_token');

        $validator = Validator::make($data, [
            'name'   => ['required', 'string', 'max:255', new FullNameRule()],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => ['required', new RegisterUserAccessRule()]
        ], $messages);
      

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * generate default password
         *
         */

        $password = bcrypt("12345678");
        $data['password'] = $password;

        $create = User::create($data);

        redirectBackIfThereIsAError($create);

        $sendEmailVerification = $create->sendEmailVerificationNotification();

        return redirect()->back()->with(['status' => Lang::get('Registered User')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        return view('app.dashboard.users.show',
        [
            'user' => $user
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
        $user = User::findOrFail($id);

        return view('app.dashboard.users.edit', [
            'user' => $user
        ]);
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
        /**
         * Validate request
         * 
         */
        $data = $request->all();

        $validator = Validator::make($data, [
            'role_id' => ['required', new RegisterUserAccessRule()]
        ]);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $dataUpdate['role_id'] = $data['role_id'];

        $update = User::findOrFail($id)->update($dataUpdate);

        redirectBackIfThereIsAError($update);

        return redirect()->back()->with(['status' => Lang::get('Updated User')]);
    }

    /**
     * Confirm before disable
     * a user
     * 
     */
    public function confirmDestroy($id)
    {
        $user = User::findOrFail($id);

        return view('app.dashboard.users.confirmDestroy',
        [
            'user' => $user
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
        $disable = User::destroy($id);

        redirectBackIfThereIsAError($disable);

        return redirect()->route('users.index')->with(['status' => Lang::get('Disabled User') . ". " . Lang::get('The user has been notified via email')]);
    }

    /**
     * Confirm before restore
     * 
     */
    public function confirmRestore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        return view('app.dashboard.users.confirmRestore',
        [
            'user' => $user
        ]);
    }

    /**
     * Restore a disabled user
     * 
     */
    public function restore($id){
        $activate = User::onlyTrashed()->findOrFail($id)->restore();

        redirectBackIfThereIsAError($activate);

        return redirect()->route('users.index')->with(['status' => Lang::get('Activated User') . ". " . Lang::get('The user has been notified via email')]);
    }
}