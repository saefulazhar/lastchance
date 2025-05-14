<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
    <div class="d-flex min-vh-100">
        <!-- Sidebar -->
        <div class="bg-dark text-white" style="width: 250px;">
            <ul class="nav flex-column p-3">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#house"/></svg>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/profile'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#person"/></svg>
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/my_sewa'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#clock-history"/></svg>
                        Riwayat Sewa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/laporan'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#file-text"/></svg>
                        Laporan Saya
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('penyewa/riwayat_ulasan'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#chat-left-text"/></svg>
                        Riwayat Ulasan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center" href="<?php echo base_url('auth/logout'); ?>">
                        <svg class="bi me-2" width="20" height="20" fill="currentColor"><use xlink:href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css#box-arrow-left"/></svg>
                        Logout
                    </a>
                </li>
            </ul>
        </div>