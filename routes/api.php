<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Bank;
use App\Models\Logistic;
use App\Models\Productcomments;
use App\Models\Storecomments;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->get('/getTokens', function (Request $request) {
    return $request;
});

//Get user using email address
Route::post("/getUser", [RegisteredUserController::class, "getUser"]);

// Get the currently logged in user
Route::middleware('auth:sanctum')->get('/currentUser', function (Request $request) {
    return $request->user();
});

// Get the currently logged in user using post request
Route::middleware('auth:sanctum')->post('/currentUser', function (Request $request) {
    return ["status" => true, "message" => "Successfully retrieved user details.", "data" => $request->user()];
});

//Generate passcode for user to reset their password
Route::post("/sendCode", [UserController::class, "sendCode"]);

//Verify the code entered by the user for updating their password
Route::post("/verifyCode", [UserController::class, "verifyCode"]);

//Update the user's password
Route::post("/updatePassword", [UserController::class, "updatePassword"]);

// Get all users in the system
Route::middleware('auth:sanctum')->get('/getUsers/{id}', [UserController::class, "index"]);

// Get user with ID
Route::middleware('auth:sanctum')->get('/getUser/{id}', [UserController::class, "index"]);

//Update user profile from admin
Route::post("/adminUpdateUser", [UserController::class, "update"]);

// Get all the stores on the application
Route::middleware('auth:sanctum')->get('/getStores', [StoreController::class, "index"]);

// Get store for the currently logged in user
Route::middleware('auth:sanctum')->get('/getStores/{user_id}', [StoreController::class, "index"]);

// Get all Products
Route::get('/getProducts', [ProductController::class, "index"]);

// Get all Products in a certain category
Route::post('/getProducts', [ProductController::class, "index"]);

// Get a Product
Route::get('/getProduct/{id}', [ProductController::class, "index"]);

// Get Products for store
Route::get('/getStoreProducts/{store_id}', [ProductController::class, "index"]);

// Get Products in a certain category for store
Route::post('/getStoreProducts', [ProductController::class, "index"]);

// Get Store likes
Route::post('/getStoreLikes', [StorelikesController::class, "index"]);

// Get Product likes
Route::post('/getProductLikes', [ProductlikesController::class, "index"]);

// Save Store likes
Route::post('/likeStore', [StorelikesController::class, "store"]);

// Save Product likes
Route::post('/likeProduct', [ProductlikesController::class, "store"]);

// Get Store Rating
Route::post('/getStoreRating', [StoreratingsController::class, "index"]);

// Save Store Rating
Route::post('/rateStore', [StoreratingsController::class, "store"]);

// Get Product Rating
Route::post('/getProductRating', [ProductratingsController::class, "index"]);

// Save Store Rating
Route::post('/rateProduct', [ProductratingsController::class, "store"]);

//Update product from admin
Route::post("/adminUpdateProduct", [ProductController::class, "update"]);

//Add product
Route::post("/addProduct", [ProductController::class, "store"]);

//Add product
Route::post("/addProductSize", [ProductSizeController::class, "store"]);

//Add product
Route::post("/addProductColor", [ProductColorController::class, "store"]);

//Add product
Route::post("/addProductDrawing", [ProductDrawingController::class, "store"]);

//Add product
Route::post("/addProductFabric", [ProductFabricController::class, "store"]);

//Add product
Route::post("/addProductLocation", [ProductLocationController::class, "store"]);

//Add product
Route::post("/addProductSize", [ProductSizeController::class, "store"]);

//Delete product
Route::post("/deleteProduct", [ProductController::class, "destroy"]);

//Add product media
Route::post("/addProductMedia", [MediaController::class, "store"]);

//Add Store Boomerang media
Route::post("/createBoomerang", [StorevideosController::class, "store"]);

//Get all Boomerang videos
Route::post("/getBoomerangs", [StorevideosController::class, "index"]);

//Get Store Boomerang videos
Route::get("/getStoreBoomerangs/{store_id}", [StorevideosController::class, "index"]);

// Upload file
Route::post('/uploadFile', [UserController::class, "uploadFile"]);

// Upload Base64 file
Route::post('/uploadMessageFile', [UserController::class, "uploadMessageFile"]);

// Get all Categories
Route::get('/getCategories', [CategoryController::class, "index"]);

// Get all Product Categories
Route::get('/getProductCategories', [ProductCategoryController::class, "index"]);

//Create Store
Route::post('/createStore', [StoreController::class, "store"]);

//Edit/Update Store Details
Route::post('/editStore', [StoreController::class, "update"]);

// Get all Stores
Route::get('/getStores', [StoreController::class, "index"]);

// Get all Stores
Route::post('/getStores', [StoreController::class, "getAllStores"]);

// Get all Stores in a category given the category
Route::get('/getStores/{category_id}', [StoreController::class, "index"]);

// Get Store from ID
Route::get('/getStore/{id}', [StoreController::class, "index"]);

// Get Store from ID along with followers
Route::get('/getStoreWithFollowers/{id}', [StoreController::class, "getStoreWithFollowers"]);

// Get Store from user ID
Route::get('/getUserStore/{user_id}', [StoreController::class, "index"]);

// Get user Orders
Route::post('/getUserOrders', [OrderController::class, "index"]);

// Get store Orders
Route::post('/getStoreOrders', [OrderController::class, "index"]);

// Update Order
Route::post('/updateOrder', [OrderController::class, "update"]);

// Get all Orders
Route::get('/getOrders', [OrderController::class, "index"]);

// Add new subscription
Route::post('/storeSubscription', [SubscriptionController::class, "store"]);

// Add new transaction
Route::post('/storeTransaction', [TransactionController::class, "store"]);

// Get all transactions
Route::get('/getTransactions/{id}', [TransactionController::class, "index"]);

// Get my transactions
Route::post('/getMyTransactions', [TransactionController::class, "index"]);

// Update transaction settlement status
Route::post('/updateTransaction', [TransactionController::class, "update"]);

// Get User's Messages and Get message using message ID
Route::post('/getMessages', [MessageController::class, "index"]);

// Get User's Messages for a particular user
Route::post('/getUserMessages', [MessageController::class, "index"]);

// Create/Send Message
Route::post('/createMessage', [MessageController::class, "store"]);

// Update Message
Route::post('/updateMessage', [MessageController::class, "update"]);

// Delete Message
Route::post('/deleteMessage', [MessageController::class, "delete"]);

// Get all subscription Plans
Route::get('/getPlans', [PlansController::class, "index"]);

// Get one subscription Plan given plan ID
Route::post('/getPlan', [PlansController::class, "index"]);

//Get all store videos
Route::get('/getStoreVideos', [StoreController::class, "getStoreVideos"]);

//Get all store stories
Route::get('/getStoreStories', [StoreController::class, "getStoreStories"]);

//Delete a store video
Route::post('/deleteBoomerang', [StorevideosController::class, "destroy"]);

// Get User's events for a particular user
Route::post('/getUserEvents', [EventController::class, "index"]);

// Get all events or an event given the event ID
Route::post('/getEvents', [EventController::class, "index"]);

// Get all store events
Route::post('/getStoreEvents', [EventController::class, "index"]);

// Get all user events
Route::post('/getMyEvents', [EventRegisterController::class, "index"]);

// Create new event
Route::post('/createEvent', [EventController::class, "store"]);

// Update Event
Route::post('/updateEvent', [EventController::class, "update"]);

// Delete Event
Route::post('/deleteEvent', [EventController::class, "destroy"]);

//Add event media
Route::post("/addEventMedia", [EventMediaController::class, "store"]);

//Get event media
Route::post("/getEventMedia", [EventMediaController::class, "index"]);

//Delete event media
Route::post("/deleteEventMedia", [EventMediaController::class, "destroy"]);

//Register a user for an event
Route::post("/registerEvent", [EventRegisterController::class, "store"]);

//Unregister a user for an event
Route::post("/deregisterEvent", [EventRegisterController::class, "deregister"]);

//Get Store visits/views
Route::post("/incrementStoreVisits", [StoreController::class, "incrementStoreVisits"]);

//Get product comments
Route::post("/getProductComments", [ProductcommentsController::class, "index"]);

//Save product comment
Route::post("/saveProductComment", [ProductcommentsController::class, "store"]);

//Get store comments
Route::post("/getStoreComments", [StorecommentsController::class, "index"]);

//Save store comment
Route::post("/saveStoreComment", [StorecommentsController::class, "store"]);

//Save Follower
Route::post("/storeFollower", [FollowController::class, "store"]);

//Get store Follower
Route::post("/getFollowers", [FollowController::class, "index"]);

//Get Following
Route::post("/getFollowing", [FollowController::class, "index"]);

//Delete Follower
Route::post("/deleteFollower", [FollowController::class, "destroy"]);

//Delete Following
Route::post("/deleteFollowing", [FollowController::class, "destroy"]);

//Add Store story
Route::post("/addStory", [StoryController::class, "store"]);

//Get all story videos
Route::post("/getStories", [StoryController::class, "index"]);

//Get Store story videos
Route::get("/getStories/{store_id}", [StoryController::class, "index"]);

//Get Store Bank accounts
Route::post("/getMyBanks", [BankController::class, "index"]);

//Get Store Transfers
Route::post("/getMyTransfers", [TransferController::class, "index"]);

//Get Flutterwave link
Route::post("/getFlutterwaveLink", function (Request $request) {
    $response = Http::withHeaders([
        "Content-Type" => "application/json",
        "Accept" => "application/json",
        "Authorization" => "Bearer FLWSECK_TEST-91ed0dddd984e1e62d0e0b030ee95091-X"
    ])->withToken($request->token)->post(
        'https://api.flutterwave.com/v3/payments',
        $request
    );

    return $response;
});

//Verify Paystack payment
Route::post("/verifyPaystackPayment", function (Request $request) {
    $response = Http::withHeaders([
        "Content-Type" => "application/json",
        "Accept" => "application/json",
        "Authorization" => "Bearer sk_test_46d9854f1ca26a3ed11210d3a6edf9b35829bf4e"
    ])->get(
        'https://api.paystack.co/transaction/verify/'.$request->reference,
        $request
    );

    return $response;
});

//Get Paystack banks
Route::get("/getPaystackBanks", [BankController::class, "getPaystackBanks"]);

//Resolve recepient account number
Route::post("/resolveAccountDetails", [BankController::class, "resolveAccountDetails"]);

//Create Recepient
Route::post("/createRecepient", [BankController::class, "createRecepient"]);

//Initiate Paystack transfer
Route::post("/initiatePaystackTransfer", [TransferController::class, "initiatePaystackTransfer"]);

//Finalize Paystack transfer
Route::post("/finalizePaystackTransfer", [TransferController::class, "finalizePaystackTransfer"]);

//Verify Paystack Transfer
Route::post("/verifyPaystackTransfer", [TransferController::class, "verifyPaystackTransfer"]);

//List Paystack Transfers
Route::post("/listPaystackTransfer", [TransferController::class, "listPaystackTransfer"]);

//Fetch Paystack Transfer details
Route::post("/fetchPaystackTransfer", [TransferController::class, "fetchPaystackTransfer"]);

//Add Paystack Bank
Route::post("/addBank", [BankController::class, "store"]);

//Delete Paystack Bank
Route::post("/deleteBank", [BankController::class, "destroy"]);

//Get all states
Route::get("/getStates", [StateController::class, "index"]);

//Get all Logistic companies
Route::get("/getLogistics", [LogisticController::class, "index"]);

//Get one Logistic company using ID
Route::post("/getLogistic", [LogisticController::class, "index"]);

//Add Logistic company
Route::post("addLogistic", [LogisticController::class, "store"]);

//Update Logistic company
Route::post("updateLogistic", [LogisticController::class, "update"]);

//Delete a Logistic company
Route::post("/deleteLogistic", [LogisticController::class, "destroy"]);

//Get all Logistic company destinations
Route::get("/getLogisticDestinations", [LogisticDestinationController::class, "index"]);

//Get one Logistic company destination using ID or Logistic ID
Route::post("/getLogisticDestination", [LogisticDestinationController::class, "index"]);

//Add Logistic company destination
Route::post("addLogisticDestination", [LogisticDestinationController::class, "store"]);

//Update Logistic company
Route::post("updateLogisticDestination", [LogisticDestinationController::class, "update"]);

//Delete a Logistic company destination
Route::post("/deleteLogisticDestination", [LogisticDestinationController::class, "destroy"]);

//Google Callback
Route::post("/googleCallback", [AuthenticatedSessionController::class, "google"]);

//Twitter Callback
Route::post("/twitterCallback", [AuthenticatedSessionController::class, "twitter"]);

//Facebook Callback
Route::post("/facebookCallback", [AuthenticatedSessionController::class, "facebook"]);

//LinkedIn Callback
Route::post("/linkedinCallback", [AuthenticatedSessionController::class, "linkedin"]);

//Twitter Callback
Route::get("/getTwitterToken", [AuthenticatedSessionController::class, "getTwitterToken"]);

//Redirect to Home page after getting token
Route::post("/twitterRedirect", [AuthenticatedSessionController::class, "twitterRedirect"]);

//Add to cart
Route::post("/addToCart", [CartController::class, "store"]);

//Remove Item from cart
Route::post("/removeFromCart", [CartController::class, "removeFromCart"]);

//Update cart
Route::post("/updateCart", [CartController::class, "update"]);

//Delete cart
Route::post("/deleteCart", [CartController::class, "deleteCart"]);

//Get cart
Route::post("/getCart", [CartController::class, "index"]);

//Get cart item
Route::post("/getCartItem", [CartController::class, "getCartItem"]);