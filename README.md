geocalc
=======

Geolocation calculations

Calculate distance between two points on a globe, or get the closest places to a destination using the haversine formula.

The following assumptions are made:

You have a MySQL database with a 'cities_geolocation' table and columns: id, repo_id, repo_name, geolocation.

Table is a MyISAM engine, and the 'geolocation' column is of a POINT data type and has a SPATIAL index.

Location data is written into the 'geolocation' column in a POINT(lon, lat) format.

Related links:

http://mathworld.wolfram.com/Haversine.html

http://www.codecodex.com/wiki/Calculate_distance_between_two_points_on_a_globe#PHP
