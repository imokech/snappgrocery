<?php

namespace App\Http\Controllers;

use App\Traits\Responsive;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(protected Request $request)
    {
    }
}
