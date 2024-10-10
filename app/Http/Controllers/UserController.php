<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function login()
    {
        $validator = Validator::make(request()->input(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'fcm_token'=> 'required'
        ]);

        if (!$validator->passes()) {
            return response()->json(["status" => false, "message" => $validator->errors()->first()]);
        }

        $user = User::role(['Coach', 'Student'])
            ->with(['roles', 'level'])
            ->where('email', request('username'))
            ->orWhere('mobile', request('username'))
            ->orWhere('username', request('username'))
            ->first();

        if ($user) {

            $user->update([
                'fcm_token' => request('fcm_token'),
                ]);
            if (Hash::check(request('password'), $user->password)) {

                if ($user->status != 1) {
                    return response()->json(["status" => false, "message" => "الحساب قيد المراجعة"]);
                } else {
                    $token = $user->createToken("api");
                    $user->api_token = $token->plainTextToken;
                    $user->save();
                    return response()->json(["status" => true, "message" => "success", 'data' => $user]);
                }

            } else {
                return response()->json(["status" => false, "message" => "كلمة السر التي أدخلتها غير صحيحة"]);
            }
        } else {
            return response()->json(["status" => false, "message" => "البريد الإلكتروني الذي أدخلته غير مرتبط بحساب"]);
        }
    }

    public function update()
    {
        $user = User::where('id', auth('sanctum')->id())->first();

        if (request('mobile')) {
            $validator = Validator::make(request()->input(), [
                'mobile' => 'nullable|numeric|digits_between:10,15'
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->mobile = request('mobile');
        }

        if (request('address')) {
            $validator = Validator::make(request()->input(), [
                'address' => 'nullable|string|max:255'
            ]);

            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            $user->address = request('address');
        }

        $user->save();

        return response()->json([
            "status" => true,
            "message" => "تم التحديث بنجاح",
            'data' => $user
        ]);
    }

    public function change_password()
    {

        $user = User::where('id', auth('sanctum')->id())->first();


        if (request('password') != null and request('password') != "") {

            $validator = Validator::make(request()->input(), ['current_password' => 'required|string|min:8',]);
            if (!$validator->passes()) {
                return response()->json(["status" => false, "message" => $validator->errors()->first()]);
            }

            if (!Hash::check(request('current_password'), auth()->user()->password)) {
                return response()->json(["status" => false, "message" => 'كلمة السر الحالية غير متطابقة !']);
            } else {

                $validator = Validator::make(request()->input(), ['password' => 'required|confirmed|string|min:8',]);
                if (!$validator->passes()) {
                    return response()->json(["status" => false, "message" => $validator->errors()->first()]);
                }

                if (strcmp(request('current_password'), request('password')) == 0) {
                    return response()->json(["status" => false, "message" => 'لا يمكن أن تكون كلمة السر الجديدة هي نفسها كلمة السر الحالية']);
                } else {
                    $user->password = Hash::make(request('password'));
                    $user->save();
                    $password = request('password');
                    $current_password = request('current_password');
                    unset($current_password);
                    unset($password);
                }

            }

        } else {
            $current_password = request('current_password');
            unset($current_password);
            $password = request('password');
            unset($password);
            return response()->json([
                "status" => false,
                "message" => "عذرا , كلمة المرور فارغة ",
                'data' => null
            ]);
        }

        $user->save();

        return response()->json([
            "status" => true,
            "message" => "تم التحديث كلمة السر بنجاح",
            'data' => $user
        ]);

    }

}
