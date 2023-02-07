<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'userdetail_id' => User::find(1)->id,
            // 'status'        => '1',
            // 'message'       => 'hello world',
            'total_price'   => '2000',
            'tracking_no'   =>  'tracker' . rand(1111,9999),
        ];
    }
}
