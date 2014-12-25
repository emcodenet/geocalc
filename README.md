geocalc
=======

Geolocation calculations

Calculate distance between two points on a globe, or get the closest places to a destination using the haversine formula.

get_closest() method: 

The following assumptions are made:

You have a MySQL database with a 'geolocation_table' table and columns: id, name, geolocation.

Table is a MyISAM engine, and the 'geolocation' column is of a POINT data type and has a SPATIAL index.

Location data is written into the 'geolocation' column in a POINT(lon, lat) format.

In this example I have an activerecord model 'DB_City_geolocation' representing the 'geolocation_table' table.

get_distance() method:

No dependencies, just pass sets of coordinates to calculate distance between places.



It should be fairly easy to port this in different languages.

Related links:

http://mathworld.wolfram.com/Haversine.html

http://www.codecodex.com/wiki/Calculate_distance_between_two_points_on_a_globe#PHP
