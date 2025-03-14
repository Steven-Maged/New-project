<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Courses;
use App\Models\CourseUser;

class StripeController extends Controller
{
    public function credit(Request $request, $courseId)
    {
        // Set up Stripe using the secret key
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Get the course from the database using the ID
        $course = Courses::findOrFail($courseId);

        // Create a Stripe Checkout session
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd', // Currency
                        'product_data' => [
                            'name' => $course->courseName, // Course name
                            'description' => $course->courseDescription, // Course description
                            'images' => [$course->coursePhoto], // Course image
                        ],
                        'unit_amount' => $course->Price * 100, // Price in cents
                    ],
                    'quantity' => 1, // Quantity
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('callback') . '?success=true&course_id=' . $course->id, // Add course_id to the URL
            'cancel_url' => route('callback') . '?canceled=true&course_id=' . $course->id, // Add course_id to the URL
        ]);

        // Redirect the user to the payment page
        return redirect($session->url);
    }

    public function callback(Request $request)
    {
        // Get the course ID from the query string
        $courseId = $request->query('course_id');
        
        // Get the course and the current user
        $course = Courses::findOrFail($courseId);
        $user = auth()->user(); // Get the current user

        // Check if the payment was successful
        if ($request->has('success')) {

            // Add data to the course_user table
            CourseUser::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'purchase_date' => now(), // Current purchase date
                'payment_status' => 'paid', // Payment status
            ]);

            // Handle successful payment here
        return redirect()->route('courses.index')->with('success', 'Course paid successfully,thank you!');
        } elseif ($request->has('canceled')) {
            // Handle canceled payment here
            CourseUser::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'purchase_date' => now(), // Current purchase date
                'payment_status' => 'pending', // Payment status
            ]);
            return view('payment.cancelled');
        }

        return redirect()->route('home');
    }
}