<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public $username, $password, $remember;


    public function mount()
    {

        if (request()->route()->getName() == "admin.logout") {
            auth()->logout();
            redirect()->route('admin.home');
        }

        if (auth()->check()) {
            redirect()->route('admin.home');
        }


    }


    public function login()
    {

        $validate = $this->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|max:255',
        ]);


        $user = User::role('Admin')
            ->where('email', $this->username)
            ->orWhere('mobile', $this->username)
            ->orWhere('username', $this->username)
            ->first();

        if ($user) {
            if (Hash::check($this->password, $user->password)) {

                if ($user->status != 1) {

                    $this->addError('username', __("Account status disabled"));
                } else {
                    auth()->login($user);
                    return redirect()->route('admin.home');
                }

            } else {
                $this->addError('username', __("login error"));
            }

        } else {
            $this->addError('username', __("login error"));
        }

    }

    public function render()
    {
        return view('livewire.admin.login')->layout('layouts.admins.app');
    }
}
