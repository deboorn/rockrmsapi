### Rock RMS Api Helper
---

The Rock RMS Api for PHP 5+ allows your church PHP project to easily integrate against the RockRMS.com. Built on top of Guzzle 6, the Rock RSM Api helper for PHP will bootstrap your integration allowing you to easily authenticate and consume all RockRMS REST API resources. Authenticate easily with credential based authentication. 

- PHP 5+ Rock RMS Api Helper
- Easily integrate your church PHP project against RockRMS.com.
- License: Creative Commons Attribution-NonCommercial 3.0 Unported (CC BY-NC 3.0)
- Please respect the license above (CC BY-NC 3.0), it's strictly non commercial.
- If you are a church staff member or volunteer this package is licensed for you.
- Questions regarding this software should be directed to daniel.boorn@gmail.com.
- Files are Not officially supported by Rock RMS.


### Brought to you by:
> Funding for this projected was provided by **OnlineGiving.org**.

How to Install
---------------

Install the `deboorn/rockrmsapi` package

```shell
$ composer require deboorn/rockrmsapi
```

Example of Usage
---------------

```php
require 'vendor/autoload.php';

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

//  $rock->get($uri, array $options = []) : Promise
//  $rock->head($uri, array $options = []) : Promise
//  $rock->put($uri, array $options = []) : Promise
//  $rock->post($uri, array $options = []) : Promise
//  $rock->patch($uri, array $options = []) : Promise
//  $rock->delete($uri, array $options = []) : Promise
//  $rock->getAsync($uri, array $options = []) : Promise
//  $rock->headAsync($uri, array $options = []) : Promise
//  $rock->putAsync($uri, array $options = []) : Promise
//  $rock->postAsync($uri, array $options = []) : Promise
//  $rock->patchAsync($uri, array $options = []) : Promise
//  $rock->deleteAsync($uri, array $options = []) : Promise

// See Rock RMS demo for full list of REST API endpoints/resources.
// More documentation coming soon...










