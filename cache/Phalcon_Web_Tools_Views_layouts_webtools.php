<?= $this->tag->getDoctype() ?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= $this->tag->getTitle() ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="<?= $phalcon_team ?>" name="author">
    <link rel="shortcut icon" href="/favicon.ico?v=<?= $ptools_version ?>">
    <?= $this->tag->stylesheetLink('https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&subset=latin,cyrillic-ext,cyrillic', false) ?>
    
        <?= $this->tag->stylesheetLink('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css', false) ?>
        <?= $this->tag->stylesheetLink('https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css', false) ?>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <?= $this->assets->outputJs('js_ie') ?>
    <![endif]-->
    <?= $this->assets->outputCss('main_css') ?>
    
    <?php if (isset($custom_css) && $custom_css == true) { ?><?= $this->assets->outputCss('custom_css') ?><?php } ?>

</head><body class="hold-transition skin-blue sidebar-mini"><div class="wrapper">
    <?php $head_title = '<span class="logo-mini"><strong>' . $app_mini . '</strong></span><span class="logo-lg"><strong>' . $app_name . '</strong></span>'; ?>

<header class="main-header">
    <?= $this->tag->linkTo([$webtools_uri, $head_title, 'class' => 'logo']) ?>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <?= $this->tag->linkTo(['https://github.com/phalcon/phalcon-devtools/issues', 'Did something go wrong? Try the Github Issues.', 'class' => 'dropdown-toggle', 'local' => false]) ?>
                </li>
            </ul>
        </div>
    </nav>
</header>


        
    <aside class="main-sidebar">
    <section class="sidebar">
        <?= $this->sidebar->render() ?>
    </section>
</aside>


        
    <div class="content-wrapper">
        <section class="content-header"><?php if (isset($page_title) && !empty($page_title)) { ?><h1><?= $page_title ?><?php if (isset($page_subtitle) && !empty($page_subtitle)) { ?><small><?= $page_subtitle ?></small><?php } ?></h1><?php } ?></section>

        <section class="content">
    <?= $this->getContent() ?>
</section>

    </div>

        
    <footer class="main-footer">
    <div class="row">
        <div class="col-sm-12">
            <div class="text-center hidden-xs">
                <strong><?= $app_name ?></strong>.
                Copyright &copy; <?= $copy_date ?> <?= $this->tag->linkTo([$phalcon_url, $phalcon_team, false]) ?>. All rights reserved.<br>
                <strong><?= $lte_name ?></strong>.
                Copyright &copy; <?= $lte_date ?> <?= $this->tag->linkTo([$lte_url, $lte_team, false]) ?>. All rights reserved.
            </div>
        </div>
    </div>
</footer>


        <div class="control-sidebar-bg"></div>
        </div>
    <?= $this->assets->outputJs('footer') ?>
</body></html>
