<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LocalizationController extends Controller
{
    public function __invoke(string $locale): RedirectResponse
    {
        if(!in_array($locale, config('localization.locales'))) {
            abort(400);
        }

        session(['localization' => $locale]);

        return redirect()->back();
    }
}
