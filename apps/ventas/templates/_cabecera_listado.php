<html>
<head>
<style type="text/css">
body {font-family:sans-serif; font-size:0.7em;}
#logo{position:absolute;left:0;top:-20}
#content {margin-top:1em;}
#content table{width:100%}
#content table tr th{background: #CCC;}
#titulo {font-size:2em;width:100%;text-align:center;margin-bottom:-5px}
#filtro_utilizado {font-size:0.6em;}
.page-number {text-align: right;}
.page-number:before {content: "P?gina " counter(page);}
hr {page-break-after: always;border: 0;}
#footer1 {position:fixed; bottom:0; left:0; width:70%; font-size: 0.5em;}
#footer2 {position:fixed; bottom:0; right:0; width:20%}
</style>
</head>
<body>
<?php $logo_cabecera = $sf_user->getVarConfig('logo_cabecera'); ?>
<header><img id="logo" src="images/<?php echo $logo_cabecera ?>"></header>
<h2 id="titulo"><br><br><br><?php echo $titulo ?></h2>
<?php if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
<div id="content">