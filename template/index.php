<!DOCTYPE html>
<html lang="da">
<head>
    <title>Time Tracking Tool | Applesign</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="cache-control" content="no-cache">

    <link rel="stylesheet" media="screen" href="<?=TEMPLATE_URL;?>css/template.min.css?t=<?=time();?>" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Asap&display=swap" />
</head>
<body>
    <div class="topbar">
        <div class="topbar-center">
            <span class="logo"></span>
            <span class="applesign">Applesign</span>
            <span class="menuTrigger">
                <span class="hamburger" id="one"></span>
                <span class="hamburger" id="two"></span>
                <span class="hamburger" id="three"></span>
                <span class="x" id="one"></span>
                <span class="x" id="two"></span>
            </span>
            <ul class="topmenu">
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
                <li><a href="#">Start</a></li>
            </ul>
        </div>
    </div>
    <div class="pageWrapper">
        <?=$this->getPage(PAGE);?>
        <div class="clrBth"></div>
    </div>
    <div class="bottombar <?=(isset($this->FooterbarType) ? $this->FooterbarType : "");?>">
        <?php if (isset($this->FooterbarMsg)) { ?>
            <span class="FooterMsg"><?=$this->FooterbarMsg;?></span>
        <?php } ?>
    </div>
</body>
</html>