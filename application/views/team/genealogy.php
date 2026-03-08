<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content-tab">
        <div class="body genealogy-body genealogy-scroll">
            <div class="genealogy-tree">
                <div class="d-flex justify-content-between">
                    <h4 class="text-danger">LEFT</h4>
                    <h4 class="text-success">RIGHT</h4>
                </div>
                <ul>
                    <li>
                        <a href="javascript:void(0);">
                            <div class="member-view-box">
                                <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                    <img src="<?=base_url('uploads/profile/').($profile?$cid:"images").".png" ?>"
                                        alt="Member" style="border-radius:50%">

                                </div>
                                <div class="member-details text-center">
                                    <?=$cname?><br>
                                    <?=$cid?>
                                    <br><span
                                        class="badge badge-<?=($status==1?"success":($status==0?"warning":($status==2?"dark":"danger")))?>"><?=($status==1?"Active":($status==0?"Inactive":($status==2?"Block":"Reject")))?></span>
                                </div>


                            </div>
                        </a>

                        <ul class="active">
                            <?php 

                    function check_tree($customerid)
                    {
                        $c = &get_instance();                      
                        $sql="SELECT * FROM `customer_master` WHERE `dowline_id`='".$customerid."' ORDER BY `position` ASC";
                        $query = $c->db->query($sql);
                        return $c->db->affected_rows();
                    }
                  function customerTree($customerId,$k)
                  {
                                     $k+=1;  
                    $chk=check_tree($customerId);
                  
                      $c = &get_instance();
                      if($k<3)  $uc ='<ul class="active">';
                      else 
                        $uc ='<ul>';

                      if($chk==0)
                                {
                                   $uc.='<li><a href="javascript:void(0);">
                                   <div class="member-view-box" >
                                   <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                       <img src="'.base_url("uploads/profile/images.png").'" alt="Member" style="border-radius:50%">
                                      
                                   </div>
                                   <div class="member-details text-center" >'.
                                     ' [<span class="text-danger">L</span>]<br><br>'.
                                      '<span class="badge badge-primary">Vacancy</span>'.

                                   '</div>
                                   </div></a>';
                                   $uc.='<li><a href="javascript:void(0);">
                                    <div class="member-view-box" >
                                   <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                       <img src="'.base_url("uploads/profile/images.png").'" alt="Member" style="border-radius:50%">
                                      
                                   </div>
                                   <div class="member-details text-center" >'.
                                     ' [<span class="text-success">R</span>]<br><br>'.
                                      '<span class="badge badge-primary">Vacancy</span>'.

                                   '</div>
                                   </div></a>';
                                  $t='</li></li>';
                                }
                                
                      $sql="SELECT c.*, u.user_name FROM `customer_master` c JOIN user_master u ON u.customer_id = c.customer_id WHERE c.dowline_id='".$customerId."' ORDER BY `position` ASC";
                      $query = $c->db->query($sql);
                      $result = $query->result_array();
                    
                          foreach ($result as $rs) {      
                               
                                if($chk==1)
                                {
                                    if($rs['position'] == 1)
                                    {
                                        $uc.='<li><a href="javascript:void(0);">
                                     <div class="member-view-box" >
                                    <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                        <img src="'.base_url("uploads/profile/images.png") .'" alt="Member" style="border-radius:50%">
                                       
                                    </div>
                                    <div class="member-details text-center" >'.
                                      ' [<span class="text-danger">L</span>]<br><br>'.
                                      '<span class="badge badge-primary">Vacancy</span>'.                        '</div>
                                    </div>
                                 </a>'; 
                                        $uc.='<li><a href="javascript:void(0);">
                                         <div class="member-view-box" >
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="'.base_url("uploads/profile/".($rs['profile']!=''?$rs['customer_id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                                           
                                        </div>
                                        <div class="member-details text-center" >'.
                                           $rs['user_name'].' [<span class="text-success">R</span>]<br>'.
                                           $rs['customer_id'].'<br>'.
                                           '<span class="badge badge-'.($rs['status']==1?"success":($rs['status']==0?"warning":($rs['status']==2?"dark":"danger"))).'">'.($rs['status']==1?"Active":($rs['status']==0?"Inactive":($rs['status']==2?"Block":"Reject"))).'</span>'.

                                        '</div>
                                        </div>
                                     </a>';  
                                     $t='</li>';
                                     $uc.= customerTree($rs['customer_id'],$k).$t;  
                                     
                               
                                    }
                                    else  
                                    {
                                        
                                     $uc.='<li><a href="javascript:void(0);">
                                     <div class="member-view-box" >
                                    <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                        <img src="'.base_url("uploads/profile/images.png") .'" alt="Member" style="border-radius:50%">
                                       
                                    </div>
                                    <div class="member-details text-center" >'.
                                           $rs['user_name'].' [<span class="text-danger">L</span>]<br>'.
                                           $rs['customer_id'].'<br>'.
                                           '<span class="badge badge-'.($rs['status']==1?"success":($rs['status']==0?"warning":($rs['status']==2?"dark":"danger"))).'">'.($rs['status']==1?"Active":($rs['status']==0?"Inactive":($rs['status']==2?"Block":"Reject"))).'</span>'.

                                        '</div>
                                    </div>
                                 </a>'; 
                                 $t='</li></li>';
                                 $uc.= customerTree($rs['customer_id'],$k).$t;  
                                 $uc.='<li><a href="javascript:void(0);">
                                 <div class="member-view-box" >
                                <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                <img src="'.base_url("uploads/profile/images.png") .'" alt="Member" style="border-radius:50%">
                                   
                                </div>
                                <div class="member-details text-center" >'.
                                  ' [<span class="text-success">R</span>]<br>'.
                                  '<br>'.
                                  '<span class="badge badge-primary">Vacancy</span>'.
                                '</div>
                                </div>
                             </a>';  
                                    }                              

                                    
                                }
                                else
                                {
                                    $uc.='<li>';
                                    $uc.='<a href="javascript:void(0);">
                                    <div class="member-view-box" >
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="'.base_url("uploads/profile/".($rs['profile']!=''?$rs['customer_id']:"images").".png") .'" alt="Member" style="border-radius:50%">
                                           
                                        </div>
                                        <div class="member-details text-center" >'.
                                           $rs['user_name'].' ['. ($rs['position'] == 1 ? '<span class="text-success">R</span>' : ($rs['position'] == 0 ? '<span class="text-danger">L</span>' : '')).']<br>'.
                                           $rs['customer_id'].'<br>'.
                                           '<span class="badge badge-'.($rs['status']==1?"success":($rs['status']==0?"warning":($rs['status']==2?"dark":"danger"))).'">'.($rs['status']==1?"Active":($rs['status']==0?"Inactive":($rs['status']==2?"Block":"Reject"))).'</span>'.

                                        '</div>
                                    </div>
                            </a>';  
                            $t='</li>';
                            $uc.= customerTree($rs['customer_id'],$k).$t;  
                            
                                }
                            
                                                                          
                           
                            
                          }
                                         
                     
                      return $uc."</ul>";
                  }
                $k=0;
                foreach($tree as $t)
                {
                    $k=0;
                    $customerId=$t['dowline_id'];
                    $chk=check_tree($customerId);
                               
                        if($chk==1)
                                {
                                    if($t['position'] == 0)
                                    { ?>
                            <li><a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="<?=base_url("uploads/profile/".($t['profile']!=''?$t['customer_id']:"images").".png")?>"
                                                alt="Member" style="border-radius:50%">

                                        </div>
                                        <div class="member-details text-center">
                                            <?=$t['name']?> [<span class="text-danger">L</span>]<br>
                                            <?=$t['customer_id']?><br>
                                            <span
                                                class="badge badge-<?=($t['status']==1?"success":($t['status']==0?"warning":($t['status']==2?"dark":"danger")))?>"><?=($t['status']==1?"Active":($t['status']==0?"Inactive":($t['status']==2?"Block":"Reject")))?></span>

                                            '
                                        </div>
                                    </div>
                                </a>
                                <?=customerTree($t['customer_id'],$k)?>
                            <li><a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="<?= base_url("uploads/profile/images.png") ?>" alt="Member"
                                                style="border-radius:50%">

                                        </div>
                                        <div class="member-details text-center">
                                            [<span class="text-success">R</span>]<br><br>
                                            <span class="badge badge-primary">Vacancy</span>
                                        </div>
                                    </div>
                                </a>

                                <?php   }
                                    else  
                                    { ?>
                            <li><a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="<?php echo base_url("uploads/profile/images.png") ?>" alt="Member"
                                                style="border-radius:50%">

                                        </div>
                                        <div class="member-details text-center">
                                            [<span class="text-success">R</span>]<br>
                                            <br>
                                            <span class="badge badge-primary">Vacancy</span>
                                        </div>
                                    </div>
                                </a>
                            <li><a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="<?=base_url("uploads/profile/".($t['profile']!=''?$t['customer_id']:"images").".png") ?>"
                                                alt="Member" style="border-radius:50%">

                                        </div>
                                        <div class="member-details text-center">
                                            <?=$t['name']?> [<span class="text-danger">L</span>]<br>
                                            <?=$t['customer_id']?><br>
                                            <span
                                                class="badge badge-<?=($t['status']==1?"success":($t['status']==0?"warning":($t['status']==2?"dark":"danger")))?>"><?=($t['status']==1?"Active":($t['status']==0?"Inactive":($t['status']==2?"Block":"Reject")))?></span>

                                        </div>
                                    </div>
                                </a>
                                <?=customerTree($t['customer_id'],$k)?>
                                <?php //  $t='</li></li>';
                                    }                              

                                    
                                }
                                else { ?>
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image" style="margin-left:auto;margin-right:auto;">
                                            <img src="<?=base_url('uploads/profile/images.png') ?>" alt="Member"
                                                style="border-radius:50%">

                                        </div>
                                        <div class="member-details text-center">
                                            <?php
                                        $customerid = $t['customer_id'];
                                        $details = $this->Crud->ciRead("user_master", "`customer_id` = '$customerid'");
                                    ?>
                                            <?=$details[0]->user_name?>
                                            <?= $t['position'] == '1' ? '<span class="text-success">[R]</span>' : ($t['position'] == '0' ? '<span class="text-danger">[L]</span>' : '' ) ?><br>
                                            <?=$t['customer_id']?><br>
                                            <span
                                                class="badge badge-<?=($t['status']==0?"warning":($t['status']==1?"success":"dark"))?>"><?=($t['status']==0?"Inactive": ($t['status']==1?"Active":"Blocked"))?></span>

                                        </div>
                                    </div>
                                </a>
                                <?=customerTree($t['customer_id'],$k)?>

                                <?php } ?>

                            </li>
                    </li>
                    </li>

                    <?php } ?>
                </ul>


                </li>
                </ul>
            </div>
        </div>
        <style>
        /*----------------genealogy-scroll----------*/

        .genealogy-scroll::-webkit-scrollbar {
            width: 5px;
            height: 8px;
        }

        .genealogy-scroll::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #e4e4e4;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb {
            background: #212121;
            border-radius: 10px;
            transition: 0.5s;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb:hover {
            background: #d5b14c;
            transition: 0.5s;
        }


        /*----------------genealogy-tree----------*/
        .genealogy-body {
            white-space: nowrap;
            overflow-y: hidden;
            padding: 50px;
            min-height: 500px;
            padding-top: 10px;
            text-align: center;
        }

        .genealogy-tree {
            display: inline-block;
        }

        .genealogy-tree ul {
            padding-top: 20px;
            position: relative;
            padding-left: 0px;
            display: flex;
            justify-content: center;
        }

        .genealogy-tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
        }

        .genealogy-tree li::before,
        .genealogy-tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #ccc;
            width: 50%;
            height: 18px;
        }

        .genealogy-tree li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #ccc;
        }

        .genealogy-tree li:only-child::after,
        .genealogy-tree li:only-child::before {
            display: none;
        }

        .genealogy-tree li:only-child {
            padding-top: 0;
        }

        .genealogy-tree li:first-child::before,
        .genealogy-tree li:last-child::after {
            border: 0 none;
        }

        .genealogy-tree li:last-child::before {
            border-right: 2px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .genealogy-tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        .genealogy-tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #ccc;
            width: 0;
            height: 20px;
        }

        .genealogy-tree li a {
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
        }

        .genealogy-tree li a:hover+ul li::after,
        .genealogy-tree li a:hover+ul li::before,
        .genealogy-tree li a:hover+ul::before,
        .genealogy-tree li a:hover+ul ul::before {
            border-color: #fbba00;
        }

        /*--------------memeber-card-design----------*/
        .member-view-box {
            padding: 0px 20px;
            text-align: center;
            border-radius: 4px;
            position: relative;
        }

        .member-image {
            width: 60px;
            position: relative;
        }

        .member-image img {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            background-color: #000;
            z-index: 1;
        }
        </style>
        <script>
        $(function() {

            // alert($('.genealogy-tree ul').length );
            // var $lis = $('.genealogy-tree ul').hide();
            // $lis.slice(0,12).show();



            $('.genealogy-tree ul').hide();
            $('.genealogy-tree>ul').show();

            $('.genealogy-tree ul.active').show();


            $('.genealogy-tree li').on('click', function(e) {
                var children = $(this).find('> ul');
                if (children.is(":visible")) children.hide('fast').removeClass('active');
                else children.show('fast').addClass('active');
                e.stopPropagation();
            });
        });
        </script>