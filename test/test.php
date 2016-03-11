<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');
error_reporting(-1);

require '../vendor/autoload.php';


$rock = new RockRMS\Api('admin', 'admin', 'http://rock.rocksolidchurchdemo.com/api/');

### Authentication
// Calling the auth method will fetch a cookie from the API using the user credentials
// The auth only needs to be called once per object, but before consuming endpoints
// The auth method is chainable - $rock->auth()->get(...)

// $rock->auth();

### Working with data
// Consume the API using Guzzle 6 style requests making it easy as pie!
// However, we return a promise class that allows you to easily decode json
// or work directly with the Guzzle response body, headers, etc.

// Let's grab the campus list and then print the name to console.
$campuses = $rock->auth()->get('Campuses')->json();
foreach ($campuses as $campus) {
    echo "Campus: {$campus->Name}\n";
    // ...
}

// Need to check status codes and grab the response body? It's easy.
$promise = $rock->get('Campuses');
var_dump(
    $promise->response()->getHeaders(),
    $promise->response()->getStatusCode(),
    (string)$promise->response()->getBody()
);

// Let's search some data...
$people = $rock->get('People/Search?name=Smith')->json();
var_dump($promise);


// Easily consume the Rock RMS REST API resources with the following actions -

// Promise get($uri, array $options = [])
// Promise head($uri, array $options = [])
// Promise put($uri, array $options = [])
// Promise post($uri, array $options = [])
// Promise patch($uri, array $options = [])
// Promise delete($uri, array $options = [])
// Promise getAsync($uri, array $options = [])
// Promise headAsync($uri, array $options = [])
// Promise putAsync($uri, array $options = [])
// Promise postAsync($uri, array $options = [])
// Promise patchAsync($uri, array $options = [])
// Promise deleteAsync($uri, array $options = [])

// Happy coding!












