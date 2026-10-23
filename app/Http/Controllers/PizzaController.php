<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\View\View;

class PizzaController extends Controller
{
    public function index(): View
    {
        $pizzas = Pizza::query()
            ->where('is_available', true)
            ->orderBy('name')
            ->get();

        return view('pizzas.index', compact('pizzas'));
    }
}
