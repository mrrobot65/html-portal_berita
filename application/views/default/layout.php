<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (isset($data['title']) ? $data['title'] : "News Portal") ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Josefin+Slab:400,700|Dancing+Script|Open+Sans:400,300italic,300,400italic' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="<?php echo assets_url('css/style.css'); ?>" type="text/css" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
 
</head>
<body>
<div class="wrapper">
    <header class="container header-wrapper " >
        <div class="row" >
            <div class="col-md-12" >
                <nav class="navbar navbar-default navbar-fixed-top" style="padding: 20px; background-color: #20B2AA; color:black">
                    <div class="container">
                        <div class="navbar-header" >
                            <?php if(!isset($data['pdf']) || $data['pdf'] == FALSE): ?>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#new-portal-navbar" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <?php endif; ?>
                            <a style="color:black" href="<?php echo base_url(); ?>" class="navbar-brand cursive logo">Berita 86</a>
                        </div>
                        <?php if(!isset($data['pdf']) || $data['pdf'] == FALSE): ?>
                        <div class="collapse navbar-collapse" id="new-portal-navbar">
                            <ul class="nav navbar-nav">
                                <li <?php if(uri_string() == ''): ?> class="active" <?php endif; ?>>
                                    <a style="color:black" href="<?php echo base_url(); ?>">
                                        <i class="fa fa-fw fa-home"></i> Beranda
                                    </a>
                                </li>
                                <li class="dropdown <?php if(strstr(uri_string(), 'category/') !== FALSE): ?> active <?php endif; ?>">
                                    <a  style="color:black" class="dropdown-toggle" data-toggle="dropdown" href="javascript:" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i  class="fa fa-fw fa-filter"></i> Kategori <span style="color:black" class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php
                                        $categories = get_categories();
                                        if($categories):
                                            foreach($categories as $category):
                                        ?>
                                                <li>
                                                    <a href="<?php echo base_url('news/category/' . $category->idcategory); ?>">
                                                        <?php echo $category->title; ?>
                                                    </a>
                                                </li>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a style="color:black" class="dropdown-toggle" data-toggle="dropdown" href="javascript:" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-fw fa-user"></i> Admin <span style="color:black" class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php if(!is_logged_in()): ?>
                                            <li><a href="<?php echo base_url('account/login'); ?>">Masuk</a></li>
                                        <?php else: ?>
                                            <li><a href="<?php echo base_url('account'); ?>">Kelola Akun</a></li>
                                            <li><a href="<?php echo base_url('post'); ?>">Terbitan Saya</a></li>
                                            <li><a href="<?php echo base_url('account/logout'); ?>">Keluar</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-right" role="search" method="post" action="<?php echo base_url('news/search'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="keyword" />
                                </div>
                                <button style="color:black" type="submit" class="btn btn-default">Cari</button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
        <?php if(isset($data['sidebar']) && $data['sidebar'] == FALSE): ?>
            <div class="col-md-12">
                <?php $this->load->view($data['template_name'] . '/partials/alerts', $data); ?>
                <?php $this->load->view($view, $data); ?>
            </div>
        <?php else: ?>
            <div class="col-md-9 main-content">
                <?php $this->load->view($data['template_name'] . '/partials/alerts', $data); ?>
                <?php $this->load->view($view, $data); ?>
            </div>
            <br>
            <br>
            <br>
            <div class="col-md-3" >
                <div style="background-color: #D3D3D3" class="sidebar clearfix">
                    <?php $this->load->view($data['template_name'] . '/partials/sidebar', $data); ?>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>
    <hr />
    <hr />
    <hr />
    <hr />
    <hr />
    

    <!-- Experience -->
        <div id="experience">
            <div class="bg-color-sky-light" data-auto-height="true">
                <div class="container content-lg">
                    <div class="row">
                        <div style="background-color:#20B2AA; padding: 10px" class="col-sm-3 sm-margin-b-30">
                            <div class="text-right sm-text-left">
                                <h2 class="margin-b-0">Pengalaman</h2>
                                <p>Batman would be jealous.</p>
                            </div>
                        </div>
                        <div class="col-sm-8 col-sm-offset-1">
                            <div class="row row-space-2 margin-b-4">
                                <div style="padding: 54px; background-color: #D3D3D3" class="col-md-4 md-margin-b-4">
                                    <div class="service" data-height="height" >
                                        <div class="service-element">
                                            <i class="service-icon icon-chemistry"></i>
                                        </div>
                                        <div class="service-info">
                                            <h3>Mobile Legend</h3>
                                            <p class="margin-b-5">Top local 1 hero grock dengan winrate 90% dengan winstreak 52x. Tapi, gb hehe</p>
                                        </div>
                                          
                                    </div>
                                </div>
                                <div style="padding:35px; background-color:#20B2AA " class="col-md-4 md-margin-b-4">
                                    
                                        <div class="service-element">
                                            <i class="service-icon color-white icon-screen-tablet"></i>
                                        </div>
                                        <div class="service-info">
                                            <h3 class="color-white">ROS</h3>
                                            <p class="color-white margin-b-5">Chicken dinner tanpa cheat. Bukan hanya itu saja kawan, lebih dari sekedar prestasi ialah mendapat kill streak 3x dengan frying fan. Bangga main bersih!!!</p>
                                        </div>
                                         
                                    
                                </div>
                                <div style="padding: 17px; background-color: #D3D3D3" class="col-md-4">
                                    <div class="service" data-height="height">
                                        <div class="service-element">
                                            <i class="service-icon icon-badge"></i>
                                        </div>
                                        <div class="service-info">
                                            <h3>Buzzer</h3>
                                            <p class="margin-b-5">Pernah ikut meramaikan dunia pergosipan indonesia di media sosial. Berkat usaha bersama teman dan rekan saya yaitu, lambe turah kami berhasil memecahkan rekor komentar instagram terbanyak hingga saat ini.Tapi, boong heheh</p>
                                        </div>
                                           
                                    </div>
                                </div>
                            </div>
                            <!--// end row -->
                        </div>
                    </div>
                    <!--// end row -->
                </div>
            </div>
        </div>
        <!-- End Experience -->

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

    <!-- Contact -->
        <div id="contact" style="padding: 40px; background-color:  #696969">
            <div class="bg-color-sky-light" >
                <div class="container content-lg">
                    <div class="row">
                        <div class="col-sm-3 sm-margin-b-30">
                            <div style="color:white" class="text-right sm-text-left">
                                <h2 class="margin-b-0">Kontak</h2>
                                <p>Hubungi saya</p>
                            </div>
                        </div>
                        <div class="col-sm-8 col-sm-offset-1">
                            <div class="row">
                                <div class="col-md-3 col-xs-6 md-margin-b-30 " style="color:white">
                                    <h5>Lokasi</h5>
                                    <p>Belakang Unsri, jauh dari Senai</p>
                                </div>
                                <div class="col-md-3 col-xs-6 md-margin-b-30" style="color:white">
                                    <h5>Telepon</h5>
                                    <p>+62814531453</p>
                                </div>
                                <div class="col-md-3 col-xs-6" style="color:white">
                                    <h5>Email</h5>
                                    <p>apaya@gmail.com</p>
                                </div>
                                <div class="col-md-3 col-xs-6" style="color:white">
                                    <h5>Web</h5>
                                    <p>coretanzikry.wordpress.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--// end row -->
                </div>
            </div>
        </div>
        <!-- End Contact -->
        <!--========== END PAGE LAYOUT ==========-->
    <div class="container-fluid" >
        
        <div class="container" style="padding:20px; background-color: #20B2AA;">
            <div class="row">
                <div class="col-md-6 text-left">
                    <p>
                        <i class="fa fa-rss-square" style="color:black;"></i> <a style="color:black" href="<?php echo base_url('news/rss'); ?>"> Subscribe to the rss feed</a>.
                    </p>
                </div>
                <div class="col-md-6 text-right " style="color:black">
                    <p>
                        &copy; <?php echo date('Y'); ?> Zikry and teams. All rights reserved.<br />
                        Application developed by <a style="color:black">Zikry Kurniawan</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


</body>
</html>

