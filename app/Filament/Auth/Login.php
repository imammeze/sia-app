<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    public function getTitle(): string | Htmlable
    {
        return 'Login - PAUD Tunas Bangsa';
    }

    public function getHeading(): string | Htmlable | null
    {
        return 'Selamat Datang';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'Silakan masuk ke dashboard PAUD Tunas Bangsa';
    }

    protected function throwFailureValidationException(): never
    {
        $data = $this->form->getState();
        
        $user = \App\Models\User::where('email', $data['email'] ?? '')->first();

        if (!$user) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'data.email' => 'Email tidak terdaftar',
            ]);
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'data.password' => 'Password yang Anda masukkan salah',
        ]);
    }

    protected function getEmailFormComponent(): \Filament\Schemas\Components\Component
    {
        return parent::getEmailFormComponent()
            ->validationMessages([
                'required' => 'Form harus diisi',
            ])
            ->extraInputAttributes([
                'oninvalid' => "this.setCustomValidity('Form harus diisi')",
                'oninput' => "this.setCustomValidity('')",
            ]);
    }

    protected function getPasswordFormComponent(): \Filament\Schemas\Components\Component
    {
        return parent::getPasswordFormComponent()
            ->validationMessages([
                'required' => 'Form harus diisi',
            ])
            ->extraInputAttributes([
                'oninvalid' => "this.setCustomValidity('Form harus diisi')",
                'oninput' => "this.setCustomValidity('')",
            ]);
    }
}
