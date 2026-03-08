<?php
function get_bv($customerid)
{ 
    
    $left_bv=0;
    $right_bv=0;

  
    $c=&get_instance();
    
    $sql="SELECT * FROM `customer_master` WHERE `customer_id`='".$customerid."'";  
    $result = $c->db->query($sql)->result_array();

    if (!empty($result)) {
        $left_bv = $result[0]['left_pv'];
        $right_bv = $result[0]['right_pv'];

        $min_bv = ($left_bv < $right_bv) ? $left_bv : $right_bv;

        return $min_bv;
    }

    return 0;
  
}   


