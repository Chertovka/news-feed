<?php

namespace App\Http\Controllers\LK;

use App\Http\Controllers\Controller;
use App\Http\Requests\LK\UserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return view('lk.profile.index', ["user" => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        return view('lk.users.show', ["user" => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('lk.profile.edit', ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validated();

        $user->update($data);

        return redirect(route("lk.users.index"))->with('success', 'Профиль успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect(route("lk.users.index"));
    }
}
