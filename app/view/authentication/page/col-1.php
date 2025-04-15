<!DOCTYPE html>
<html class="no-js" lang="en">
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
    <?php $this->getAdditionalBefore()?>
    <?php $this->getAdditional()?>
    <?php $this->getAdditionalAfter()?>
    <!-- END Stylesheets -->
</head>
<body>
    <div class="container">
        <?php $this->getThemeContent(); ?>
    </div>
    <?php $this->getJsFooter(); ?>
    <script>
        $(document).ready(function(e){
            $(document).foundation();
            <?php $this->getJsReady(); ?>
        });
        <?php $this->getJsContent(); ?>
    </script>
</body>
</html>
