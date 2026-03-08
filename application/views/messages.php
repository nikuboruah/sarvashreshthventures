<?php
    if ($this->session->flashdata('danger')) {
        echo '<div class="alert bg-danger" role="alert">
                '.$this->session->flashdata('danger').'
            </div>';
    }
    unset($_SESSION['danger']);

    if ($this->session->flashdata('info')) {
        echo '<div class="alert bg-info" role="alert">
                '.$this->session->flashdata('info').'
            </div>';
    }
    unset($_SESSION['info']);

    if ($this->session->flashdata('warning')) {
        echo '<div class="alert bg-warning" role="alert">
                '.$this->session->flashdata('warning').'
            </div>';
    }
    unset($_SESSION['warning']);

    if ($this->session->flashdata('success')) {
        echo '<div class="alert bg-success" role="alert">
                '.$this->session->flashdata('success').'
            </div>';
    }
    unset($_SESSION['success']);
