<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ExecutePayment;
use PayPal\Api\Item;
use Illuminate\Support\Str;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Topic;
use App\topic_user;
use App\Setting;
use Razorpay\Api\Api;

class PaypalController extends Controller
{
   //test key
   private $razorpayId = "rzp_test_RQPmWIi3E6qNUc";
   private $razorpayKey = "9BqcbNQGRrE6275JUTAZUdQa";

   public function Complete(Request $request) {
    // Now verify the signature is correct . We create the private function for verify the signature
    $signatureStatus = $this->SignatureVerify(
            $request->razorpay_signature, $request->razorpay_payment_id, $request->razorpay_order_id
    );

    // If Signature status is true We will save the payment response in our database
    // In this tutorial we send the response to Success page if payment successfully made
    if ($signatureStatus == true) {
        $order = topic_user::where(["transaction_id" => $request->razorpay_order_id])->first();
        if ($order) {
                $order->status = 1;
                if ($order->save()) {
                }           
        }

        return redirect('/')->with('added', 'Payment successfully done');
        // You can create this page
//            return view('payment-success-page');
    } else {
      return redirect('/')->with('deleted', 'Payment Cancelled');;
        // You can create this page
//            return view('payment-failed-page');
    }
}

// In this function we return boolean if signature is correct
private function SignatureVerify($_signature, $_paymentId, $_orderId) {
    try {
        // Create an object of razorpay class
        $api = new Api($this->razorpayId, $this->razorpayKey);
        $attributes = array('razorpay_signature' => $_signature, 'razorpay_payment_id' => $_paymentId, 'razorpay_order_id' => $_orderId);
        $order = $api->utility->verifyPaymentSignature($attributes);
        return true;
    } catch (\Exception $e) {
        // If Signature is not correct its give a excetption so we use try catch
        return false;
    }
}
  public function paypal_post(Request $request)
  {

    $dbOrder = new topic_user();
                $dbOrder->user_id = auth()->user()->id;
                $dbOrder->topic_id = $request->topic_id;
                $dbOrder->status = 0;
                $dbOrder->amount = $request->topic_amt;
                $amount = $dbOrder->amount *100;
                $dbOrder->transaction_id = NULL;
       // Generate random receipt id
       $receiptId = Str::random(20);

       // Create an object of razorpay
       $api = new Api($this->razorpayId, $this->razorpayKey);

       // In razorpay you have to convert rupees into paise we multiply by 100
       // Currency will be INR
       // Creating order
       $order = $api->order->create([
           'receipt' => $receiptId,
           'amount' => $amount,
           'currency' => 'INR'
       ]);
       $dbOrder->transaction_id = $order['id'];
       $dbOrder->save();
       // Return response on payment page
       $response = [
           'orderId' => $order['id'],
           'razorpayId' => $this->razorpayId,
           'amount' => $amount,
           'name' => auth()->user()->name,
           'currency' => 'INR',
           'email' => auth()->user()->email,
           'contactNumber' => auth()->user()->mobile,
           'address' => 'patna',
           'description' => 'Testing description',
       ];
      // Let's checkout payment page is it working
        return view('payment-page', compact('response'));
  }

  // Paypal process payment after it is done
  public function paypal_success(Request $request)
  {

    // return Session::get('paypal_payment_id');
    // Get the payment ID before session clear
    $payment_id = Session::get('paypal_payment_id');
    $topic = Session::get('topic');
    $com_email = Session::get('wemail');

    $auth = Auth::user(); 
    $user_email = $auth->email;

    Session::put('user_email', $user_email);
    Session::put('com_email', $com_email);

    // clear the session payment ID
    Session::forget(['paypal_payment_id','topic','wemail']);  

    if (empty($request->input('PayerID')) || empty($request->input('token'))) {
      flash('Payment Failed')->error()->important();
      return redirect('/')->with('deleted', 'Payment failed');;
    }
    
    $payment = Payment::get($payment_id, $this->_api_context);
    /** PaymentExecution object includes information necessary **/
    /** to execute a PayPal account payment. **/
    /** The payer_id is added to the request query parameters **/
    /** when the user is redirected from paypal back to your site **/
    $execution = new PaymentExecution();
    $execution->setPayerId(request()->get('PayerID'));
    /**Execute the payment **/
    $result = $payment->execute($execution, $this->_api_context);

    /** dd($result);exit; /** DEBUG RESULT, remove it later **/
    if ($result->getState() == 'approved') { 
        /** it's all right **/
        /** Here Write your database logic like that insert record or value in database if you want **/
        $paypal_data = $auth->topic()->attach($topic->id, ['amount' => $topic->amount, 'transaction_id' => $payment_id, 'status' => 1]);

        if ($paypal_data) {
          if(env('MAIL_FROM_ADDRESS' != NULL) && env('MAIL_FROM_NAME') && env('MAIL_DRIVER') && env('MAIL_HOST') && env('MAIL_PORT'))
          {
            Mail::send('email.invoice', ['paypal' => $paypal_data, 'topic' => $topic], function($message) {
                $message->to(Session::get('user_email'))->from(Session::get('com_email'))->subject('Invoice');
            });
          }

            Session::forget('user_email');
            Session::forget('com_email');
        }  
        
        
        return redirect('/')->with('added', 'Payment successfully done');
    }
    
    Session::flash("deleted","Payment failed");
    return redirect('/')->with('deleted', 'Payment failed');
    
  }

  public function paypal_cancel()
  {
     flash('Payment Cancelled')->error()->important();
     return redirect('/')->with('deleted', 'Payment Cancelled');;
  }
}






