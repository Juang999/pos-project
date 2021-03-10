<?php

namespace App\Http\Controllers;

use App\User;
use App\Absensi;
use App\Tabungan;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class UserControllerAPI extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $role = Auth::user()->role;

        $kode = Auth::user()->kode_member;

        return response()->json(compact('token', 'role', 'kode'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nomor_telepon' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $code = explode("8", $request->nomor_telepon, 2);

        $member_code = implode("000", $code);

        $user = User::create([
            'name' => $request->get('name'),
            'nomor_telepon' => $request->get('nomor_telepon'),
            'email' => $request->get('email'),
            'kode_member' => $member_code,
            'password' => Hash::make($request->get('password')),
        ]);

            // dd($user->kode_member);tttt

        $tabungan = Tabungan::create([
            'user_id' => $user->id
        ]);

        try {
            $tabungan->save();

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return $this->sendResponse('gagal', 'gagal divalidasi', $validator->errors(), 500);
        }

        try {
            Password::sendResetLink(['email' => $request->email]);

            return response()->json('berhasil, reset password berhasil dikirim ke email mu');
        } catch (\Throwable $th) {
            return $this->sendResponse('gagal', 'reset password gagal dikirim', $th->getMessage(), 500);
        }
    }
}
