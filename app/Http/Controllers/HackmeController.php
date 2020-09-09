<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pawn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HackmeController extends Controller
{
    protected function hackme(Request $request)
    {
        if (Auth::check()) {
            $pawn = new Pawn();
            $pawn->save();
        }
    }
}
