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
        $users = $this->Crud->ciRead("customer_master","id<>0");
        foreach($users as $user){

            echo $userid = $user->customer_id;

            $left_total  = $user->left_activation_pv + $user->left_repurchase_bv;
            $right_total = $user->right_activation_pv + $user->right_repurchase_bv;

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
        $user = $this->Crud->ciRead("customer_master","customer_id='$userid'")[0];

        /* =============================
        CASE 1: Weak leg below 1000
        ============================== */
        if($weak_leg < 1000){

            // ❌ No income
            $this->flush_bv($userid,$weak_leg,"Below 1000 BV - No Income");

            return;
        }

         /* =============================
        CASE 2: 1000 to 5000 → Flat 8%
        ============================== */
        if($weak_leg >= 1000 && $weak_leg <= 5000){

            $percent = 8;
            $bonus = ($weak_leg * $percent) / 100;

            // Credit wallet
            $this->credit_wallet($userid,$bonus,$percent);

            // Deduct BV
            $this->deduct_bv($userid,$weak_leg);

            return;
        }

        /* =============================
        CASE 3: Above 5000 → Package Wise
        ============================== */

        // Get ALL eligible slabs based on BV
        $packages = $this->db->query("
            SELECT *
            FROM package_master
            WHERE lesserleg_volume <= '$weak_leg'
            ORDER BY lesserleg_volume ASC
        ")->result();

        if(empty($packages)){
            $this->flush_bv($userid,$weak_leg,"No package slab found");
            return;
        }

        $eligible_package = null;

        foreach($packages as $pkg){

            // Check package eligibility
            if($user->package_id >= $pkg->package_id){
                $eligible_package = $pkg; // keep upgrading
            }else{
                break; // stop if package not eligible
            }
        }

        if(empty($eligible_package)){
            // ❌ No eligible package → flush BV
            $this->flush_bv($userid,$weak_leg,"Package not eligible");
            return;
        }

        $percent = $eligible_package->matching_income_percentage;
        $cap = $eligible_package->weekly_capping;

        $bonus = ($weak_leg * $percent) / 100;

        if($bonus > $cap){
            $bonus = $cap;
        }

        // ✅ Credit wallet
        $this->credit_wallet($userid,$bonus,$percent);

        // ✅ Deduct BV
        $this->db->query("
            UPDATE customer_master
            SET
            left_paid_bv = left_paid_bv + $weak_leg,
            right_paid_bv = right_paid_bv + $weak_leg
            WHERE customer_id='$userid'
        ");
    }

    public function flush_bv($userid,$bv,$reason)
    {
        $this->Crud->ciCreate("bv_flush_history",[
            'customer_id'=>$userid,
            'flush_bv'=>$bv,
            'remark'=>$reason,
            'date'=>date('Y-m-d H:i:s')
        ]);

        // Still deduct BV (important)
        $this->db->query("
            UPDATE customer_master
            SET
            left_paid_bv = left_paid_bv + $bv,
            right_paid_bv = right_paid_bv + $bv
            WHERE customer_id='$userid'
        ");
    }

    public function credit_wallet($userid,$amount,$percent)
    {
        $this->db->query("
			UPDATE customer_master 
			SET main_wallet = main_wallet + $amount
			WHERE customer_id='$userid'
		");

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