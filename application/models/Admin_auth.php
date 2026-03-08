<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_auth extends CI_Model {

    public function checkLogin($email, $password, $operatingSystem, $browser) {

        $sql="SELECT * FROM `user_master` WHERE (`user_email`='".$email."' or `customer_id`='".$email."') and `user_type`=2";
        $query=$this->db->query($sql);
        $result=$query->result_array();

        if ($this->db->affected_rows() > 0) {

            foreach ($result as $key) {

                $decPassword = $this->encryption->decrypt($key['password']);

                if ($decPassword == $password) {

                    if ($key['status'] == 1) {

                        $loginData = [

                            'user_id' => $key['user_id'],

                            'user_role' => $key['user_type'],

                            'os' => $operatingSystem,

                            'browser' => $browser,

                            'ip' => $_SERVER['REMOTE_ADDR'],
                            'login_time' => date('H:i:s')


                        ];

                        $this->db->insert('login_history', $loginData);
                        $this->session->set_userdata('aiplUID', $key['user_id']);


                        $this->session->set_userdata('aiplUserId', $key['customer_id']);

                        $this->session->set_userdata('aiplUserEmail', $key['user_email']);

                        $this->session->set_userdata('role', $key['user_type']);

                        $this->session->set_userdata('aiplUserName', $key['user_name']);
                   

                    } else {

                        return "Your ID was blocked by admin";

                    }

                } else {
                    

                    return 'Incorrect password!';

                }

            }

        } else {
            
            return "Invalid username!";

        }

    }

}

?>