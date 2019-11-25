<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestMailController extends Controller
{
    public function send()
    {
        return Mail::to('tohru.no.ink@gmail.com')->send(new TestMail());
    }
}
