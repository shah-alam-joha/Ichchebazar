<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

     public function render($request, Throwable $e){

        $class = get_class($e);

        switch ($class) {
            case 'Illuminate\Auth\AuthenticationException':
                // $guard = array_get( $e->guards(), 0)
            $guard = \Arr::get($e->guards(), 0);
            
                switch ($guard) {
                    case 'admin':
                        $login = "admin.login";
                        break;

                    case 'web':
                        $login = "login";
                        break;
                    
                    default:
                        $login = "login";
                        break;
                }
                return redirect()->route($login);
                break;
            
         
        }
        return parent::render($request, $e);
     }
}
