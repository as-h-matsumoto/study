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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'AllPutData' => \App\Http\Middleware\AllPutData::class,
        'AllSenMonTenPutData' => \App\Http\Middleware\AllSenMonTenPutData::class,
        'CheckContentExists' => \App\Http\Middleware\CheckContentExists::class,
        'CheckLoginOwner' => \App\Http\Middleware\CheckLoginOwner::class,
        'CheckOwner' => \App\Http\Middleware\CheckOwner::class,
        'CheckManager' => \App\Http\Middleware\CheckManager::class,
        'CheckOwnerDone' => \App\Http\Middleware\CheckOwnerDone::class,
        'CheckContentOwner' => \App\Http\Middleware\CheckContentOwner::class,
        'CheckPermitGolistEdit' => \App\Http\Middleware\CheckPermitGolistEdit::class,
        'CheckContentDateUserExists' => \App\Http\Middleware\CheckContentDateUserExists::class,
        'CheckOwnerSuperReturnAjax' => \App\Http\Middleware\CheckOwnerSuperReturnAjax::class,
        'CheckOwnerSuperReturnRedirect' => \App\Http\Middleware\CheckOwnerSuperReturnRedirect::class,
        'CheckExistRss' => \App\Http\Middleware\CheckExistRss::class,
        'CheckContentMenuExists' => \App\Http\Middleware\CheckContentMenuExists::class,
        'CheckLicense' => \App\Http\Middleware\CheckLicense::class,
        'CheckLicenseQuestion' => \App\Http\Middleware\CheckLicenseQuestion::class,
        'CheckLicenseQuestionOwner' => \App\Http\Middleware\CheckLicenseQuestionOwner::class,
        'CheckLicenseQuestionContents' => \App\Http\Middleware\CheckLicenseQuestionContents::class,
        'CheckLicenseQuestionContentsOwner' => \App\Http\Middleware\CheckLicenseQuestionContentsOwner::class,
        'CheckTryMasterExists' => \App\Http\Middleware\CheckTryMasterExists::class,
        'CheckLicenseQuestionTheme' => \App\Http\Middleware\CheckLicenseQuestionTheme::class,
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
