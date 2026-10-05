<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\invitation;
use App\Models\order;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
    // Total customer 
    $totalCustomer = User::where('role', 'customer')->count(); 
    // Total undangan 
    $totalInvitation = invitation::count(); 
    // Total template 
    $totalTemplate = Template::count(); 
    // Total pesanan 
    $totalOrder = order::count(); 
    // Pesanan pending 
    $pendingOrder = order::where('payment_status', 'pending')->count(); 
    // Total pendapatan dari pesanan yang sudah dibayar 
    $totalRevenue = order::where('payment_status', 'paid') ->sum('total'); 
    // Pesanan terbaru 
    $latestOrders = order::with([ 'user', 'package' ]) 
    ->latest() 
    ->take(5) 
    ->get(); 
    return view('admin.dashboard', 
    compact( 'totalCustomer', 'totalInvitation', 'totalTemplate', 'totalOrder', 'pendingOrder', 'totalRevenue', 'latestOrders' ));
    
    }
}
