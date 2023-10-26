<?php

use LDAP\Result;

session_start();
require "session.php";
@include 'koneksi.php';

?>

<html>

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width-device-width, initial-scale-1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/addproduct.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="./img/vmware.svg" alt="">
            </div>

            <span class="logo_name">Titu Laundry</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="index.php">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="product.php">
                        <i class="uil uil-box"></i>
                        <span class="link-name">Product</span>
                    </a></li>
                <li><a href="voucher.php">
                        <i class="uil uil-pricetag-alt"></i>
                        <span class="link-name">Voucher</span>
                    </a></li>
                <li><a href="adsbanner.php" style=" background-color: rgba(47, 128, 237, 0.16); border-radius: 8px;">
                        <i class="uil uil-layer-group" style="color: #2F80ED;"></i>
                        <span class="link-name" style="color: #2F80ED; font-weight: 500;">Ads banner</span>
                    </a></li>
                <li><a href="order.php">
                        <i class="uil uil-shopping-cart"></i>
                        <span class="link-name">Order</span>
                    </a></li>
                <li><a href="performance.php">
                        <i class="uil uil-tachometer-fast-alt"></i>
                        <span class="link-name">Performance</span>
                    </a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="login.php" onclick="return confirm('Apakah anda yakin ingin keluar?')">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
                <li class="mode" style="display: none;">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <img src="./img/profile.svg" alt="">
        </div>
        <?php
        $searchbox = "";
        if (isset($_POST['search-box'])) {
            $searchbox = htmlspecialchars($_POST['search-box']);
        }
        ?>

        <div class="form-input">
            <form method="POST" action="action_banner.php" enctype="multipart/form-data">
                <h5>Buat banner baru</h5>

                <span>Nama banner</span>
                <input type="text" class="form-control" id="nama_banner" placeholder="Nama banner" name="nama_banner">
                <span>Keterangan</span>
                <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan">
                <span>Gambar banner</span>
                <input class="file-input" type="file" id="img" name="banner_image">

                <style>
                    .form-input .image-preview {
                        width: auto;
                        min-height: 200px;
                        border: 1px solid #b3b3b3;
                        margin-top: 16px;
                        border-radius: 8px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-weight: 500;
                        color: #333333;
                    }

                    .form-input .image-preview .image-preview__image {
                        display: none;
                        width: 100%;
                    }
                </style>
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Image Preview" class="image-preview__image" style="border-radius: 8px;">
                    <span class="image-preview__default-text">Image Preview</span>
                </div>

                <script>
                    const inpFile = document.getElementById("img");
                    const previewContainer = document.getElementById("imagePreview");
                    const previewImage = previewContainer.querySelector(".image-preview__image");
                    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");

                    inpFile.addEventListener("change", function() {
                        const file = this.files[0];

                        if (file) {
                            const reader = new FileReader();

                            previewDefaultText.style.display = "none";
                            previewImage.style.display = "block";

                            reader.addEventListener("load", function() {
                                console.log(this);
                                previewImage.setAttribute("src", this.result);
                            });

                            reader.readAsDataURL(file);
                        }
                    });
                </script>

                <div class="tombol">
                    <button type="submit" class="simpan-btn" name="simpan-btn">Simpan</button>
                    <button type="button" class="kembali-btn" data-dismiss="modal" aria-label="Close" onclick="history.back()">
                        <span aria-hidden="true" style="color: #2F80ED;">Kembali</span>
                    </button>
                </div>

            </form>
        </div>
    </section>



    <script src="script.js"></script>
    <!-- <script src="product.js"></script> -->
</body>

</html>