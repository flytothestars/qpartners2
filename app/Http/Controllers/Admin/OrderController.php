<?php
namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Packet;
use App\Models\Product;
use App\Models\UserPacket;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('profile');
    }

    public function index(Request $request)
    {
        $request = Order::select('*')
            ->orderBy('created_at', 'desc')            
            ->paginate(20);
        return view('admin.orders.index', [
            'row' => $request
        ]);
    }    
}
?>