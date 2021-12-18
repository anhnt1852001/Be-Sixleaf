<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']);
    }

    public function reset()
    {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(["msg" => "Invalid token provided"], 400);
        }

        return redirect('http://localhost:3001/signin');
    }

    public function change(Request $request)
    {
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'max:8|different:password',
        ]);
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();
            return response()->json('Mật khẩu của bạn đã được đổi');
        } else {
            return response()->json('Mật khẩu của bạn không đúng');
        }
    }
}
