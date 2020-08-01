<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function home() {
        return 'Teste Controller - Home';
    }

    public function dashboard() {
        return 'Teste Controller - Dashboard';
    }

    public function financeiro() {
        return 'Teste Controller - Financeiro';
    }

    public function produtos() {
        return 'Teste Controller - Produtos';
    }
}
