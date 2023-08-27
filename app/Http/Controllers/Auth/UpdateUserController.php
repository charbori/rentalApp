<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Image\ImageManager;

class UpdateUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        return view('auth.update');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = Auth::user();

        $user_model = User::where('id', $user->id)->find(1);
        $user_model->name = $request->name;
        $user_model->password = Hash::make($request->password);
        $user_updated = $user_model->save();

        Log::debug($request->name . ' ' . Hash::make($request->password));
        Log::debug("---------------");

        if ($user_updated > 0) {
            $imageManager = new ImageManager();

            $photo_data = $request->file('photos');
            Log::debug($photo_data);

            $result = $imageManager->store($photo_data, $user->id);
            Log::debug($result);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
