<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">

  <table>
    <caption class="fg-toolbar ui-widget-header ui-corner-top">
            <h1><span class="ui-icon ui-icon-triangle-1-s"></span>Cantidad de Ventas - Historico</h1>
    </caption>

    <thead class="ui-widget-header">
      <tr>
        <th class="sf_admin_text ui-state-default ui-th-column">Categoria</th>
        <?php 
          $nombre_mes[1] = 'Ene';
          $nombre_mes[2] = 'Feb';
          $nombre_mes[3] = 'Mar';
          $nombre_mes[4] = 'Abr';
          $nombre_mes[5] = 'May';
          $nombre_mes[6] = 'Jun';
          $nombre_mes[7] = 'Jul';
          $nombre_mes[8] = 'Ago';
          $nombre_mes[9] = 'Sep';
          $nombre_mes[10] = 'Oct';
          $nombre_mes[11] = 'Nov';
          $nombre_mes[12] = 'Dic';
          for($i=6;$i>=1;$i--){
            list($anio, $mes) = explode('-', date("Y-n", strtotime("-$i months")));
            $x_labels[] = $nombre_mes[$mes].'-'.$anio;
            echo '<th class="sf_admin_text ui-state-default ui-th-column">'.$nombre_mes[$mes].'-'.$anio.'</th>';
          }
        ?>
      </tr>
    </thead>

    <tfoot><tr><th colspan="3"></th></tr></tfoot>

    <tbody>
      <?php foreach ($pager->getResults() as $categoria): ?>
        <tr class="sf_admin_row ui-widget-content">
        <?php
          echo '<td>'.$categoria->nombre.'</td>';
          $historico = $categoria->getCantVendidaHist();
          foreach($historico as $fila) {
            $data[$categoria->nombre][] = $fila['cantidad'];
            echo '<td class="sf_admin_text">'.$fila['cantidad'].'</td>';
          }
        ?>
        </tr>
      <?php endforeach;?>
    </tbody>
  </table>
<?php
// require 'jpgraph.php';
// require 'jpgraph_line.php';

// Setup the graph
$graph = new Graph(1000,400);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Cantidad de Ventas - Historico');
$graph->SetBox(false);

$graph->SetMargin(40,20,36,100); //left, top, rigth, bottom 

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($x_labels);
$graph->xgrid->SetColor('#dfdfd0');
 
foreach($data as $cat => $linea) {
  $p1 = new LinePlot($linea);
  $p1->SetWeight(10);
  $p1->SetColor("#".dechex(rand(0,10000000)));
  $p1->SetLegend($cat);
  $graph->Add($p1);
}

$graph->legend->SetFrameWeight(1);

// Output line
// echo '<img src="'.$graph->Stroke().'">';
$gdImgHandler = $graph->Stroke(_IMG_HANDLER);
 
// Stroke image to a file and browser
 
// Default is PNG so use ".png" as suffix
$fileName = "imagefile.png";
$graph->img->Stream($fileName);
 
// Send it back to browser
// $graph->img->Headers();
// $graph->img->Stream();
echo '<img src="/odontopc/web/imagefile.png">';

?>
</div>
