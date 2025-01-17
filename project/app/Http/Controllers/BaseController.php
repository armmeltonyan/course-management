<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BaseController extends Controller
{
    public static function sendResponse(
        string $route,
        string $message,
    ): RedirectResponse {

        return redirect()->route($route)->with('success', $message);
    }

    public static function sendError(
        string $error,
    ): RedirectResponse {

        return back()->with('error',$error);
    }

    public static function sendView(
        string $view,
        array $data
    ): View
    {
        return view($view, $data);
    }

    public static function sendUnauthorized(
        string $view,
        array $data
    ): View
    {
        abort(403, 'Unauthorized');
    }
}
