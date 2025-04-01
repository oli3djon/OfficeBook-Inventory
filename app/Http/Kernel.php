<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'IPAccess' => \App\Http\Middleware\IPAccess::class,
        'AdminPanel' => \App\Http\Middleware\AdminPanel::class,
        'History' => \App\Http\Middleware\History::class,
        'Root' => \App\Http\Middleware\Root::class,
        'User' => \App\Http\Middleware\User::class,
        'People' => \App\Http\Middleware\People::class,
        'PeopleEdit' => \App\Http\Middleware\PeopleEdit::class,
        'PeopleDel' => \App\Http\Middleware\PeopleDel::class,
        'Inventory' => \App\Http\Middleware\Inventory::class,
        'InventoryEdit' => \App\Http\Middleware\InventoryEdit::class,
        'InventoryDel' => \App\Http\Middleware\InventoryDel::class,
        'Position' => \App\Http\Middleware\Position::class,
        'PositionEdit' => \App\Http\Middleware\PositionEdit::class,
        'PositionDel' => \App\Http\Middleware\PositionDel::class,
        'Mailwork' => \App\Http\Middleware\Mailwork::class,
        'MailworkEdit' => \App\Http\Middleware\MailworkEdit::class,
        'MailworkDel' => \App\Http\Middleware\MailworkDel::class,
        'Addresses' => \App\Http\Middleware\Addresses::class,
        'AddressesEdit' => \App\Http\Middleware\AddressesEdit::class,
        'AddressesDel' => \App\Http\Middleware\AddressesDel::class,
        'Point' => \App\Http\Middleware\Point::class,
        'PointEdit' => \App\Http\Middleware\PointEdit::class,
        'PointDel' => \App\Http\Middleware\PointDel::class,
        'Group' => \App\Http\Middleware\Group::class,
        'GroupEdit' => \App\Http\Middleware\GroupEdit::class,
        'GroupDel' => \App\Http\Middleware\GroupDel::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces non-global middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
