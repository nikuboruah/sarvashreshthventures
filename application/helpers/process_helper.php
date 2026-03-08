<?php



function get_pair($customerid)
{ 
    
    $left=0;
    $right=0;

  
    $c=&get_instance();
    
    $sql="SELECT * FROM customer_master  WHERE   `dowline_id`='".$customerid."'";  
   
    $result = $c->db->query($sql)->result_array();

    foreach ($result as $rs) {   
        if($rs['position']==0)  $left=leg($rs['customer_id'])+($rs['status']==1?1:0);
        else  $right=leg($rs['customer_id'])+($rs['status']==1?1:0);


    }            

    return ($left<$right?$left:$right);
  
}   




function leg($customerid)
{ 
    $c=&get_instance();
   
    $pair=0;   
   
    $sql="SELECT * FROM customer_master  WHERE   `dowline_id`='".$customerid."' ";       
    $result = $c->db->query($sql)->result_array();   

    foreach ($result as $rs) {               
        $pair+=($rs['status']==1?1:0);           
        $pair+=leg($rs['customer_id']); 
    }                

   
    
    return $pair;
}   

function downline_no($customerid,$status)
{
    $c=&get_instance();
    $count_member=0;
    $sql="SELECT `customer_id`,`status` FROM `customer_master` WHERE  `dowline_id`='".$customerid."'";
    $result=$c->db->query($sql)->result_array();       
   
    foreach ($result as $rs) {                                                                     
        $count_member+=($rs['status'] == $status ? 1 : 0);
        $count_member+=downline_no($rs['customer_id'], $status); 
    }    
    
    return $count_member;
}   






//FOr reward


function sv($customerid)
{
    $c=&get_instance();
  
    $sv=0;
    $sql="SELECT c.customer_id, p.sv as jb,c.status FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id WHERE   `dowline_id`='".$customerid."'";       

    $result = $c->db->query($sql)->result_array();
   
        foreach ($result as $rs) {                                                                     
            $sv+= ($rs['status'] == 1 ? $rs['jb'] : 0);
            $sv+=sv($rs['customer_id']); 
        }                
    return $sv;
}

function get_sv($customerid)
{ 
    
    $left_sv=0;
    $right_sv=0;

  
    $c=&get_instance();
    
    $sql="SELECT c.customer_id, p.sv as jb,c.status,c.position FROM customer_master c LEFT JOIN package_master p on c.package_id=p.package_id  WHERE   `dowline_id`='".$customerid."'";  
   
    $result = $c->db->query($sql)->result_array();

    foreach ($result as $rs) {   
        if($rs['position']==0)  $left_sv=sv($rs['customer_id'])+($rs['status'] == 1 ? $rs['jb'] : 0);
        else    $right_sv=sv($rs['customer_id'])+($rs['status'] == 1 ? $rs['jb'] : 0);


    }            

    return ($left_sv<$right_sv?$left_sv:$right_sv);
  
}   

?>