<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rules\CPFRule;
use App\Rules\PasswordRule;
use Auth, Lang, Validator, Storage;

class CompleteProfileController extends Controller
{
    public function index()
    {
        return view('auth.complete-profile.index');
    }

    public function stageOne()
    {
        return view('auth.complete-profile.stageOne');
    }

    public function stageTwo()
    {
        return view('auth.complete-profile.stageTwo');
    }

    public function stageThree()
    {
        return view('auth.complete-profile.stageThree');
    }

    public function storeStageOne(Request $request)
    {
        /**
         * Validate request
         * 
         */
        $data = request()->all();

        $data['cpf']  = sanitizeString($data['cpf']);
        $data['cep']  = sanitizeString($data['cep']);

        $validator = Validator::make($data, [
            'cpf'     => ['required', 'string', 'min:11', 'max:15', new CPFRule()],
            'cep'     => ['required', 'string', 'min:8', 'max:9'],
        ]);
      
        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        

        /**
         * Validated
         * 
         */
        $update = User::findOrFail(auth()->user()->id)->update($data);

        if(!$update)
        {
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()->back()->withInput()->withErrors($error);
        }

        return redirect()->route('complete.profile.stageTwo');
    }

    public function storeStageTwo(Request $request)
    {
        /**
         * Validate request
         * 
         */
        $data = request()->all();

        $validator = Validator::make($data, [
            'profile_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
      
        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if(auth()->user()->profile_image != null)
        {
            $nameFile = auth()->user()->profile_image;

            Storage::delete("users/profile_image/{$nameFile}");
        }
        else
        {
            /**
             * Set a random for the file based
             * on current timestamps
             * 
             */
            $name = uniqid(date('HisYmd'));

            $extension = $request->profile_image->extension();

            $nameFile = "{$name}.{$extension}";
        }

        /**
         * if it worked, the file was stored in
         * storage/app/public/users/profile_image/file_name.extension
         * 
         */
        $upload = $request->profile_image->storeAs('users/profile_image', $nameFile);

        /**
         * If not worked,
         * go back
         * 
         */
        if (!$upload)
        {
            $errors = Lang::get('Something went wrong. Please try again!');
            return redirect()
                        ->back()
                        ->withErrors($errors)
                        ->withInput();
        }

        $data['profile_image'] = $nameFile;
        

        /**
         * Validated
         * 
         */
        $update = User::findOrFail(auth()->user()->id)->update($data);

        if(!$update)
        {
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()->back()->withInput()->withErrors($error);
        }

        return redirect()->route('complete.profile.stageThree');
    }

    public function storeStageThree(Request $request)
    {
        $data = request()->all();


        /**
         * Validate password
         * 
         */
        $data = request()->all();

        $validator = Validator::make($data, [
            'password' => ['required', 'confirmed', 'min:8', 'max:18', new PasswordRule()],
        ]);
      
        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * Validated
         * 
         */
        $data['profile_completed_at'] = now()->toDateTimeString();

        $data['password'] = bcrypt($data['password']);

        $update = User::findOrFail(auth()->user()->id)->update($data);

        if(!$update)
        {
            $error = Lang::get('Something went wrong. Please try again!');
            return redirect()->back()->withInput()->withErrors($error);
        }

        return redirect()->route('home')->with(['status' => Lang::get('Welcome again. You now have access to the system. If you need help, check out our manual by clicking on your name and then manual. Or, request support by clicking support')]);
    }
}
