<html>
<head>
<style type="text/css">
body {font-family:sans-serif; font-size:0.6em;}
#logo{position:absolute;left:0;top:-20}
table{width:100%}
table tr th{background: #CCC;}
#titulo{width:100%;text-align:center;}
.page-number {text-align: right;}
.page-number:before {content: "Página " counter(page);}
hr {page-break-after: always;border: 0;}
#footer2 {position:fixed; bottom:0; right:0; width:20%}

@page { margin: 100px 40px 40px 80px;}
header { position: fixed; top: -60px; left: 0px; right: 0px; height: 80px; }
footer { position: fixed; bottom: -60px; left: 0px; right: 0px; height: 50px; }
p { page-break-after: always; }
p:last-child { page-break-after: never; }
</style>
</head>
<body>
<?php $logo_cabecera = $sf_user->getVarConfig('logo_cabecera'); ?>
<header><img src="images/<?php echo $logo_cabecera ?>" id="logo"></header>
<footer><div class="page-number"></div></footer>