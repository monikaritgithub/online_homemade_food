<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = Payment::select('payments.*', 'products.food_name', 'users.name as chef_name')
            ->join('products', 'payments.product_id', '=', 'products.id')
            ->join('users', 'products.chief_id', '=', 'users.id')
            ->where('payments.customer_id', $user->id)
            ->latest()
            ->get();
    
        return view('common.payments', compact('payments'));
    }
    
    

    public function verifyPayment(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'token' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Extract request data
        $token = $request->token;
        $amount = $request->amount;

        // Build API request parameters
        $args = http_build_query([
            'token' => $token,
            'amount'  => $amount
        ]);

        // Khalti API endpoint
        $url = "https://khalti.com/api/v2/payment/verify/";

        // Make the API call using cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $secret_key = 'test_secret_key_688a8049e51d494b9b52ea9a0248075d';
        $headers = ["Authorization: Key $secret_key"];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        // Execute the cURL request
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Check if API request was successful
        if ($status_code != 200) {
            return response()->json(['error' => 'Failed to verify payment'], $status_code);
        }

        // Return API response
        return response()->json($response, $status_code);
    }

 
        public function storePayment(Request $request)
{
    $request->validate([
        'response' => 'required|array',
        'response.idx' => 'required',
        'response.product_identity' => 'required',
        'response.merchant.name' => 'required',
        'response.state.name' => 'required',
        'response.type.name' => 'required',
    ]);

    $responseData = $request->input('response');
    $customerId = Auth::id();
    $payment = Payment::create([
        'transaction_id' => $responseData['idx'],
        'product_id' => $responseData['product_identity'],
        'paid_by' => $responseData['user']['name'],
        'status' => $responseData['state']['name'],
        'payment_type' => $responseData['type']['name'],
        'amount' => $responseData['amount']/100,
        'customer_id' => $customerId,
    ]);

    return response()->json(['message' => 'Payment information stored successfully', 'payment_id' => $payment->id]);
}

}
