<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=$this->getTitle()?></title>
    <meta name="description" content="<?=$this->getDescription()?>">
    <meta name="keyword" content="<?=$this->getKeyword()?>"/>
    <meta name="author" content="<?=$this->getAuthor()?>">
    <meta name="robots" content="<?=$this->getRobots()?>" />
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?=$this->getIcon()?>" />
    <!-- END Icons -->
    <!-- Stylesheets -->
    <!-- END Stylesheets -->
    <?php $this->getAdditionalBefore()?>
    <?php $this->getAdditional()?>
    <?php $this->getAdditionalAfter()?>
    <!-- Modernizr (browser feature detection library) -->
    <script src="<?=$this->cdn_url("skin/admin/")?>js/vendor/modernizr.min.js"></script>
</head>