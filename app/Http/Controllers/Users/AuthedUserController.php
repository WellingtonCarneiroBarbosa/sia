<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth, Lang, Validator, Storage;
use App\User;

class AuthedUserController extends Controller
{
    public function showMyProfile()
    {
        return view('app.dashboard.my-profile.index');
    }

    public function editProfile()
    {
        return view('app.dashboard.my-profile.edit');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $data['cep'] = \sanitizeString($data['cep']);

        $validator = Validator::make($data, [
            'name'   => ['required', 'string', 'max:120'],
            'cep'     => ['required', 'string', 'min:8',  'max:9'],
            'complement_number' => ['required', 'string', 'max:8'],
            'profile_image' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        /**
         * Garants that cpf and email 
         * will not updatedes
         * 
         */
        $data['cpf'] = auth()->user()->cpf; 
        $data['email'] = auth()->user()->email;

        /**
         * If request has image... 
         * 
         */
        if($request['profile_image']) {
            /**
             * If user already has image
             * 
             */
            if(auth()->user()->profile_image != null) {
                $nameFile = auth()->user()->profile_image;
                Storage::delete("users/profile_image/{$nameFile}");
            }
            /**
             * Else, set a new name. 
             * 
             */
            else {
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
        }

        $user = User::findOrFail(auth()->user()->id)->update($data);

        \redirectBackIfThereIsAError($user);

        return redirect()->back()->with(['status' => Lang::get('Profile Updated')]);
    }
}
