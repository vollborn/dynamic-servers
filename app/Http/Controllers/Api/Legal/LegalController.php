<?php

namespace App\Http\Controllers\Api\Legal;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;

class LegalController extends Controller
{
    /**
     * @return View
     */
    public function getLegalNotice(): View
    {
        return view('legal.legal_' . App::getLocale());
    }

    /**
     * @return View
     */
    public function getPrivacyNotice(): View
    {
        return view('privacy.privacy_' . App::getLocale());
    }
}