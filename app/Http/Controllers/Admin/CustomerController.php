<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->withCount('invitations')
            ->latest()
            ->paginate(10);

        return view('admin.customer.index', compact('customers'));
    }

    public function show(User $user)
    {
        abort_if($user->role !== 'customer', 404);

        $user->load([
            'invitations.template'
        ]);

        return view('admin.customer.show', compact('user'));
    }
}