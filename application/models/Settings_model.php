<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function getLoginHistory() {

        $this->db->where('user_id', $this->session->userdata('aiplUserId'))->order_by('id', 'desc')->limit(6);

        $this->db->where('user_role', '2');

        $data = $this->db->get('login_history');

        return $data->result();

    }

    public function changePassword($current, $new) {

        $this->db->where('user_id', $this->session->userdata('aiplUID'));

        $result = $this->db->get('user_master');

        foreach ($result->result() as $key) {

            $oldEncryptedPassword = $key->password;

        }

        $currentDecrypted = $this->encryption->decrypt($oldEncryptedPassword);

        if ($current == $currentDecrypted) {

            $newEncrypted = $this->encryption->encrypt($new);

            $updateData = [

                'password' => $newEncrypted

            ];

            $this->db->where('user_id', $this->session->userdata('aiplUID'));

            if ($this->db->update('user_master', $updateData)) {

                return "Password changed";

            } else {

                return "Something went wrong, please try again";

            }

        } else {

            return 'Access denied! Invalid password.';

        }

    }
    
    public function changeTransactionPassword($current, $new) {

        $this->db->where('user_id', $this->session->userdata('aiplUID'));

        $result = $this->db->get('user_master');

        foreach ($result->result() as $key) {

            $oldEncryptedPassword = $key->transaction_password;

        }

        $currentDecrypted = $this->encryption->decrypt($oldEncryptedPassword);

        if ($current == $currentDecrypted) {

            $newEncrypted = $this->encryption->encrypt($new);

            $updateData = [

                'transaction_password' => $newEncrypted

            ];

            $this->db->where('user_id', $this->session->userdata('aiplUID'));

            if ($this->db->update('user_master', $updateData)) {

                return "Password changed";

            } else {

                return "Something went wrong, please try again";

            }

        } else {

            return 'Access denied! Invalid password.';

        }

    }

}

?>