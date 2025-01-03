<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\ApiLoginRequest;
    use App\Models\User;
    use App\traits\ApiResponses;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

    class AuthController extends Controller
    {
        use ApiResponses;

        public function login(ApiLoginRequest $request) {

            if (! Auth::attempt($request->only('email', 'password'))) {

                return $this->error('Credentials Do Not Match. Could not log you in.', 400, 400);
            }

            $user = User::firstWhere('email', $request->email);
            $request->session()->regenerate();
            return $this->ok(
                'Authenticated',
                [
                    'user' => $user
                ]
            );
        }

        public function logout(Request $request) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return $this->ok('Logged out');
        }
    }
