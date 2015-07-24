geocalc
=======

Geolocation calculations

Calculate distance between two points on a globe.

getDistance() method:

No dependencies, just pass sets of coordinates to calculate distance between places.

Installation:
 Add 'repositories' array to your composer.json:
 
    "repositories": [
       {
         "type": "git",
         "url": "https://github.com/emcodenet/geocalc.git"
       }
     ],


Add 

    "emcodenet/geocalc": "dev-larapack" 
    
to the "require" array.

Run "composer update".

Add

    "Emcodenet\\Geocalc\\": "vendor/emcodenet/geocalc/src"

to the "autoload" -> "psr-4" array.

Add
 
    Emcodenet\Geocalc\ServiceProvider::class,
    
to the 'providers' array in config/app.php.

Add
 
    'Geocalc' => Emcodenet\Geocalc\GeocalcFacade::class,
    
to the 'aliases' array in config/app.php.

Run "composer update".
Run "php artisan vendor:publish".

You can now use the class:

    $g = Geocalc::getDistance(
                [
                    'lon' => 25.3892,
                    'lat' => 35.3172
                ],
                [
                    'lon' => 28.3892,
                    'lat' => 37.3172
                ],
                'km'
            );
    
    dd($g);


It should be fairly easy to port this to different languages.

Related links:

http://mathworld.wolfram.com/Haversine.html

http://www.codecodex.com/wiki/Calculate_distance_between_two_points_on_a_globe#PHP
