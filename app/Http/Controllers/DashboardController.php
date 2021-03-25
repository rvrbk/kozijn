<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\OrderredCanvas;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $all_orders = OrderredCanvas::select('orders.order_nr', 'canvasses.name AS canvas_name', 'canvasses.order_delay', 'orderred_canvasses.*')
            ->join('orders', 'orders.id', '=', 'orderred_canvasses.order_id')
            ->join('canvasses', 'canvasses.id', '=', 'orderred_canvasses.canvass_id')
            ->orderBy('created_at')
            ->get();

        $canvasses_per_order = OrderredCanvas::select('orders.order_nr', DB::raw('COUNT(orderred_canvasses.id) AS canvas_count'))
            ->join('orders', 'orders.id', '=', 'orderred_canvasses.order_id')
            ->groupBy('orders.order_nr')
            ->get();

        $orders_less_10sq = OrderredCanvas::select('orders.order_nr', DB::raw('SUM(orderred_canvasses.width * orderred_canvasses.height) AS combined_sq2'))
            ->join('orders', 'orders.id', '=', 'orderred_canvasses.order_id')
            ->having('combined_sq2', '<', 1001)
            ->groupBy('orders.order_nr')
            ->get();

        return view('dashboard', [
            'all_orders' => $all_orders,
            'canvasses_per_order' => $canvasses_per_order,
            'orders_less_10sq' => count($orders_less_10sq)
        ]);
    }
}
