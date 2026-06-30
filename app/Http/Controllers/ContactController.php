<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }
}
