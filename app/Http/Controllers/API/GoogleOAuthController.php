<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleOAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                $user->update([
                    'google_access_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken,
                ]);
            } else {
                $existingUser = User::where('username', $googleUser->email)->first();

                if ($existingUser) {
                    $existingUser->update([
                        'google_id' => $googleUser->id,
                        'google_access_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                    ]);
                    $user = $existingUser;
                } else {
                    $user = User::create([
                        'full_name' => $googleUser->name,
                        'username' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'google_access_token' => $googleUser->token,
                        'google_refresh_token' => $googleUser->refreshToken,
                        'password' => bcrypt(\Illuminate\Support\Str::random(16)),
                        'registered_date' => now(),
                        'added_by' => 0,
                        'added_date' => now(),
                        'type' => 'Client',
                    ]);
                }
            }

            $token = $user->createToken('web')->plainTextToken;

            unset($user->google_access_token, $user->google_refresh_token, $user->password);

            return redirect()->away(
                env('FRONTEND_URL', 'http://localhost:3000') . '/login?token=' . $token .
                    '&user_info=' . urlencode(json_encode($user))
            );
        } catch (\Exception $e) {
            return redirect()->away(
                env('FRONTEND_URL', 'http://localhost:3000') . '/login?error=' . urlencode($e->getMessage())
            );
        }
    }
}
