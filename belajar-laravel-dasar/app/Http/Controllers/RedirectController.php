<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    // membuat fungsi redirect To
    public function redirectTo(): string
    {
        return "Redirect To";
    }

    public function redirectFrom(): RedirectResponse
    {
        return redirect("/redirect/to");
    }

    // membuat redirect pada router dengan parameter
    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    public function redirectName(): RedirectResponse
    {
        return redirect()->route('redirect-hello', ['name' => 'wahyu']);
    }

    // membuat redirect action
    public function redirectAction(): RedirectResponse
    {
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'wahyu']);
    }

    // redirect luar domain
    public function redirectAway(): RedirectResponse
    {
        $alamat = "https://www.google.com";
        // return redirect()->to($alamat);
        return redirect()->away($alamat);
    }
}
