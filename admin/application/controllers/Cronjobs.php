<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobs extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
        $this->load->helper('process_helper');
	}

	public function process()
    {
        $this->clear_cache();
        $this->weekly_closing();
    }

    public function clear_cache()
    {
        $folderPath =APPPATH."session/cache/";
        $webcache=str_replace("admin/","",$folderPath);

        // Get all the files in the folder
        $files = glob($folderPath . '*');       
        foreach ($files as $file)
        {          
            unlink($file);              
        }

        $files = glob($webcache . '*');       
        foreach ($files as $file)
        {          
            unlink($file);              
        }
    }

    public function weekly_closing()
    {
        $users = $this->Crud->ciRead("customer_master","status=1");

        foreach($users as $user){

            $userid = $user->customer_id;

            $left_total  = $user->left_activation_bv + $user->left_repurchase_bv;
            $right_total = $user->right_activation_bv + $user->right_repurchase_bv;

            $left_paid  = $user->left_paid_bv;
            $right_paid = $user->right_paid_bv;

            $left_available  = $left_total - $left_paid;
            $right_available = $right_total - $right_paid;

            $weak_leg = min($left_available,$right_available);

            if($weak_leg <= 0){
                continue;
            }

            $this->calculate_team_bonus($userid,$weak_leg);
        }
    }

    public function calculate_team_bonus($userid,$weak_leg)
    {
        $package = $this->db->query("
            SELECT *
            FROM package_master
            WHERE lesserleg_volume <= '$weak_leg'
            ORDER BY lesserleg_volume DESC
            LIMIT 1
        ")->row();

        if(empty($package)){
            return;
        }

        $percent = $package->matching_income_percentage;
        $cap = $package->weekly_capping;

        $bonus = ($weak_leg * $percent) / 100;

        if($bonus > $cap){
            $bonus = $cap;
        }

        $status = "PAID";
        $income = $bonus;

        // eligibility check
        if(!$this->check_income_eligibility($userid,$package->id)){
            $status = "FLUSHED";
            $income = 0;
        }else{
            // flush record
            $this->Crud->ciCreate("bv_flush_history",[
                'customer_id'=>$userid,
                'flush_bv'=>$weak_leg,
                'remark'=>"Not eligible for income",
                'date'=>date('Y-m-d H:i:s')
            ]);

        }

         // Credit wallet
        if($status == "PAID"){

            $this->db->query("
                UPDATE customer_master
                SET main_wallet = main_wallet + $bonus
                WHERE customer_id='$userid'
            ");

            // transaction entry
            $this->Crud->ciCreate("customer_transaction_master",[
                'customer_id'=>$userid,
                'credit'=>$bonus,
                'remark'=>"Team Sales Bonus ($percent%)",
                'vc_date'=>date('Y-m-d H:i:s')
            ]);
        }

        // deduct matched BV
        $this->db->query("
            UPDATE customer_master
            SET
            left_paid_bv = left_paid_bv + $weak_leg,
            right_paid_bv = right_paid_bv + $weak_leg
            WHERE customer_id='$userid'
        ");
    }

    public function check_income_eligibility($userid,$required_package)
    {
        $user = $this->Crud->ciRead("customer_master","customer_id='$userid'")[0];

        if($user->status != 1){
            return false;
        }

        if($user->package_id < $required_package){
            return false;
        }

        return true;
    }

    public function credit_wallet($userid,$amount,$percent)
    {
        $data = [
            'customer_id'=>$userid,
            'credit'=>$amount,
            'remark'=>"Team Sales Bonus $percent%",
            'vc_date'=>date('Y-m-d H:i:s'),
            'income_type_id' => 5
        ];

        $this->Crud->ciCreate("customer_transaction_master",$data);
    }
}