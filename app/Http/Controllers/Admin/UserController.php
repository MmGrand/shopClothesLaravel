<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::query()->with('orders')->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validator($request->all(), $user->id)->validate();
        /*
         * Обновляем пользователя
         */
        if ($request->change_password) { // если надо изменить пароль
            $request->merge(['password' => Hash::make($request->password)]);
            $user->update($request->except('_token', '_method', 'password_confirmation'));
        } else {
            $user->update($request->except('password', '_token', '_method', 'password_confirmation'));
        }
        /*
         * Возвращаемся к списку
         */
        return redirect()
            ->route('admin.user.index')
            ->with('success', 'Данные пользователя успешно обновлены');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    private function validator(array $data, int $id)
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // проверка на уникальность email, исключая
                // этого пользователя по идентифкатору
                'unique:users,email,' . $id . ',id',
            ],
        ];
        if (isset($data['change_password'])) {
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }
        return Validator::make($data, $rules);
    }
}
