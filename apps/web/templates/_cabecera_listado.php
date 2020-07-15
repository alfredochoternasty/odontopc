<html>
<head>
<style type="text/css">
body {font-family:sans-serif; font-size:0.7em;}
#logo{position:absolute;left:0;top:-20}
#content {margin-top:1em;}
#content table{width:100%}
#content table tr th{background: #CCC;}
#titulo{style="width:100%;text-align:center;margin-top:2.5em"}
#filtro_utilizado {font-size:0.6em;}
.page-number {text-align: right;}
.page-number:before {content: "Página " counter(page);}
hr {page-break-after: always;border: 0;}
#footer1 {position:fixed; bottom:0; left:0; width:70%; font-size: 0.5em;}
#footer2 {position:fixed; bottom:0; right:0; width:20%}
</style>
</head>
<body>
<img src="images/logo_nti.png" width=204 height=77 id="logo">
<h2 id="titulo"><?php echo $titulo ?></h2>
<?php if ($hasFilters->count() > 0) include_partial('admins/filtro_usado', array('configuration' => $configuration, 'filters' => $filters, 'hasFilters' => $hasFilters)) ?>
<div id="content">