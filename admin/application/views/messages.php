<?php
    if ($this->session->flashdata('danger')) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('danger').'</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    unset($_SESSION['danger']);

    if ($this->session->flashdata('info')) {
        echo '<div class="alert alert-info alert-dismissible fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('info').'</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    unset($_SESSION['info']);

    if ($this->session->flashdata('warning')) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('warning').'</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    unset($_SESSION['warning']);

    if ($this->session->flashdata('success')) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="alert-text">'.$this->session->flashdata('success').'</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    unset($_SESSION['success']);
