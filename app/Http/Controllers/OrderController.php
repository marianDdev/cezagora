<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Traits\AuthUser;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class OrderController extends Controller
{
    use AuthUser;

    public function index(): Collection
    {
        return Order::all();
    }

    public function listMyOrders(): Collection
    {
        return $this->authUserCompany()->orders;
    }

    public function show(int $id)
    {
        $order = Order::find($id);

        if (is_null($order)) {
            abort(404, 'Order not found');
        }

        return $order;
    }

    public function create(): View
    {
        return view('orders.create');
    }

    public function store(StoreOrderRequest $orderRequest)
    {
        $validated = $orderRequest->validated();

        Order::create($validated);

    }
}
