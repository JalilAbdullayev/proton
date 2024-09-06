<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewResponse;

class UserController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(): ViewResponse {
        $data = User::where('id', '!=', Auth::user()->id)->get();
        return View::make('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): ViewResponse {
        return View::make('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($request->password === $request->password_confirmation) {
            $user->save();
            return Redirect::route('admin.users.index')->withSuccess('İstifadəçi əlavə olundu.');
        }
        return Redirect::back()->withError('Şifrələr uyğun deyil.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): ViewResponse {
        $user = User::whereId($id)->first();
        return View::make('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password !== null) {
            if(!Hash::check($request->password_old, $user->password)) {
                return Redirect::back()->withError('Köhnə şifrə düzgün deyil.');
            }
            if(Hash::check($request->password, $user->password)) {
                return Redirect::back()->withError('Köhnə şifrə ilə yeni şifrə eynidir.');
            }
            if($request->password === $request->password_confirmation) {
                $user->password = Hash::make($request->password);
            } else {
                return Redirect::back()->withError('Şifrələr uyğun deyil.');
            }
        }
        $user->save();
        return Redirect::route('admin.users.index')->withSuccess('İstifadəçi məlumatları yeniləndi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse {
        User::whereId($id)->delete();
        return Response::json(['id' => $id]);
    }
}
