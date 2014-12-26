<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Geolocation calculations
 *
 * @author Ivan Ciric
 */
class Geocalc {

    /**
     * 
     * @param array $coords (lon and lat elements as floats Default: array('lon' => 25.3892, 'lat' => 35.3172))
     * @param int $distance_radius (distance in km or m, see $units. Default: 100)
     * @param string $units (m || km Default: km)
     * @param int $limit (num of results Default: 10)
     * @return object results
     */
    public function get_closest($coords = array('lon' => 25.3892, 'lat' => 35.3172), $distance_radius = 100, $units = 'km', $limit = 10) {

        if(is_array($coords) 
                && isset($coords['lon']) 
                && isset($coords['lat']) 
                && ( is_int($coords['lat']) || is_float($coords['lat']) ) 
                && ( is_int($coords['lon']) || is_float($coords['lon']) ) 
                )
            {
            $lon = $coords['lon'];
            $lat = $coords['lat'];
            
        }else{
            throw new Exception('<b>Geocalc Exception:</b> Invalid coordinates supplied');
        }
        
        if(!is_int($distance_radius)){
            throw new Exception('<b>Geocalc Exception:</b> Invalid distance radius supplied: '. htmlentities($distance_radius) . ' (integer expected)');
        }
        
        if(!is_int($limit)){
            throw new Exception('<b>Geocalc Exception:</b> Invalid limit supplied: '. htmlentities($limit) . ' (integer expected)');
        }
        
        if($units != 'km' && $units != 'm'){
            throw new Exception('<b>Geocalc Exception:</b> Invalid distance units supplied: '. htmlentities($units) . ' (km or m expected)');
        }

        $earth_radius = ($units == 'km') ? 6371 : (($units == 'm') ? 6371000 : 6371); // km 6371, m 6371000
        
        $geolocation_data_table = 'geolocation_table';
        $point_data_column = 'geolocation';
        $select_other_columns = 'id, name';
        
        $haversine_query = "SELECT $select_other_columns, X($point_data_column) as lon, Y($point_data_column) as lat,
                ROUND(($earth_radius * 
                        acos( 
                          cos( radians($lat) )
                        * cos( radians( Y($point_data_column) ) ) 
                        * cos( radians( X($point_data_column) ) - radians($lon))
                        + sin( radians($lat) ) 
                        * sin( radians( Y($point_data_column) ) ) ) ) ) AS distance 
                FROM $geolocation_data_table
                HAVING distance < $distance_radius               
                ORDER BY distance ASC 
                LIMIT 0 , $limit;";
        
        $results = DB_City_geolocation::query($haversine_query);

        return ($results) ? $results : false;
    }
    
    /**
     * 
     * @param array $from (lon and lat elements as floats)
     * @param array $to (lon and lat elements as floats)
     * @param string $units (m || km Default: km)
     * @return int
     */
    public function get_distance($from = array(), $to = array(), $units = 'km'){
        
        if(is_array($from) 
                && isset($from['lon']) 
                && isset($from['lat']) 
                && ( is_int($from['lat']) || is_float($from['lat']) ) 
                && ( is_int($from['lon']) || is_float($from['lon']) ) 
                && is_array($to) 
                && isset($to['lon']) 
                && isset($to['lat']) 
                && ( is_int($to['lat']) || is_float($to['lat']) ) 
                && ( is_int($to['lon']) || is_float($to['lon']) ) 
                )
            {
            $coords = true;
        }else{
            throw new Exception('<b>Geocalc Exception:</b> Invalid coordinates supplied');
        }
        
        if($units != 'km' && $units != 'm'){
            throw new Exception('<b>Geocalc Exception:</b> Invalid distance units supplied: '. htmlentities($units) . ' (km or m expected)');
        }
        
        
        $earth_radius = ($units == 'km') ? 6371 : (($units == 'm') ? 6371000 : 6371); // km 6371, m 6371000

        $dLat = deg2rad($to['lat'] - $from['lat']);  
        $dLon = deg2rad($to['lon'] - $from['lon']);  

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($from['lat'])) * cos(deg2rad($to['lat'])) * sin($dLon/2) * sin($dLon/2);  
        $c = 2 * asin(sqrt($a));  
        $d = $earth_radius * $c;  

        return ceil($d);  
    }
    
}
