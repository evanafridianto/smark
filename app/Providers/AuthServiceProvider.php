<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Roas;
use App\Models\Sale;
use App\Policies\RoasPolicy;
use App\Models\Advertisement;
use App\Policies\SalesPolicy;
use Illuminate\Support\Facades\Lang;
use App\Policies\AdvertisementPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Sale::class => SalesPolicy::class,
        Advertisement::class => AdvertisementPolicy::class,
        Roas::class => RoasPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email')
                ->line('Klik tombol dibawah untuk memverifikasi alamat email Anda!')
                ->action('Verifikasi Email', $url);
        });

        // ResetPassword::toMailUsing(function ($notifiable, $url2) {
        //     return (new MailMessage)
        //         ->subject('Reset Password')
        //         ->line('Anda menerima email ini karena sistem menerima permintaan reset password untuk akun Anda.')
        //         ->action('Reset Password', $url2)
        //         ->line('Link reset password ini akan kedaluwarsa dalam 60 menit.')
        //         ->line('Jika Anda tidak meminta untuk mereset password, abaikan!');
        // });
    }
}