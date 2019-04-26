SELECT 
	r.id, r.fecha,
	dr.producto_id, 
	dr.nro_lote, 
	sum(dr.cantidad) as cant_remito, 
	(select sum(cantidad) from detalle_resumen dr2 where dr.id = dr2.det_remito_id) AS vendidos,
	sum(dr.cantidad) - (select sum(cantidad) from detalle_resumen dr2 where dr.id = dr2.det_remito_id)	AS quedan
from resumen r 
	left outer join detalle_resumen dr on r.id = dr.resumen_id
where tipofactura_id = 4
group by r.id, r.fecha, dr.producto_id, dr.nro_lote



select concat('update detalle_resumen set det_remito_id = ', (
	select det_remito.id
	from resumen remito
	join detalle_resumen det_remito on remito.id = det_remito.resumen_id
	where remito.id = vta.remito_id
		and det_remito.producto_id = dr.producto_id
		and det_remito.nro_lote = dr.nro_lote
), ' where id = ', dr.id, ';')
from resumen vta
	join detalle_resumen dr on vta.id = dr.resumen_id
where remito_id is not null

update detalle_resumen set det_remito_id = 10435 where id = 11724;
update detalle_resumen set det_remito_id = 10436 where id = 11723;
update detalle_resumen set det_remito_id = 10440 where id = 11651;
update detalle_resumen set det_remito_id = 10441 where id = 11652;
update detalle_resumen set det_remito_id = 10442 where id = 12385;
update detalle_resumen set det_remito_id = 10446 where id = 11424;
update detalle_resumen set det_remito_id = 10450 where id = 11387;
update detalle_resumen set det_remito_id = 10458 where id = 10922;
update detalle_resumen set det_remito_id = 10458 where id = 11368;
update detalle_resumen set det_remito_id = 10466 where id = 11419;
update detalle_resumen set det_remito_id = 10468 where id = 11367;
update detalle_resumen set det_remito_id = 10468 where id = 11420;
update detalle_resumen set det_remito_id = 10475 where id = 10921;
update detalle_resumen set det_remito_id = 10475 where id = 11067;
update detalle_resumen set det_remito_id = 10475 where id = 11993;
update detalle_resumen set det_remito_id = 10500 where id = 11327;
update detalle_resumen set det_remito_id = 10500 where id = 11606;
update detalle_resumen set det_remito_id = 10500 where id = 11816;
update detalle_resumen set det_remito_id = 10500 where id = 12384;
update detalle_resumen set det_remito_id = 10501 where id = 11177;
update detalle_resumen set det_remito_id = 10501 where id = 11815;
update detalle_resumen set det_remito_id = 10502 where id = 11326;
update detalle_resumen set det_remito_id = 10502 where id = 11418;
update detalle_resumen set det_remito_id = 10502 where id = 11605;
update detalle_resumen set det_remito_id = 10521 where id = 11604;
update detalle_resumen set det_remito_id = 10521 where id = 12382;
update detalle_resumen set det_remito_id = 10522 where id = 11425;
update detalle_resumen set det_remito_id = 10522 where id = 11603;
update detalle_resumen set det_remito_id = 10525 where id = 10913;
update detalle_resumen set det_remito_id = 10526 where id = 12016;
update detalle_resumen set det_remito_id = 10528 where id = 11369;
update detalle_resumen set det_remito_id = 10528 where id = 11416;
update detalle_resumen set det_remito_id = 10528 where id = 11698;
update detalle_resumen set det_remito_id = 10528 where id = 11799;
update detalle_resumen set det_remito_id = 10528 where id = 11880;
update detalle_resumen set det_remito_id = 10529 where id = 11370;
update detalle_resumen set det_remito_id = 10530 where id = 11029;
update detalle_resumen set det_remito_id = 10530 where id = 11371;
update detalle_resumen set det_remito_id = 10530 where id = 12379;
update detalle_resumen set det_remito_id = 10531 where id = 11030;
update detalle_resumen set det_remito_id = 10531 where id = 11798;
update detalle_resumen set det_remito_id = 10531 where id = 12381;
update detalle_resumen set det_remito_id = 10536 where id = 11417;
update detalle_resumen set det_remito_id = 10536 where id = 11879;
update detalle_resumen set det_remito_id = 10537 where id = 11800;
update detalle_resumen set det_remito_id = 10538 where id = 11617;
update detalle_resumen set det_remito_id = 10538 where id = 11618;
update detalle_resumen set det_remito_id = 10539 where id = 11428;
update detalle_resumen set det_remito_id = 10539 where id = 11616;
update detalle_resumen set det_remito_id = 10540 where id = 11729;
update detalle_resumen set det_remito_id = 10541 where id = 11730;
update detalle_resumen set det_remito_id = 10542 where id = 11731;
update detalle_resumen set det_remito_id = 10543 where id = 11648;
update detalle_resumen set det_remito_id = 10543 where id = 12380;
update detalle_resumen set det_remito_id = 10544 where id = 11422;
update detalle_resumen set det_remito_id = 10544 where id = 11423;
update detalle_resumen set det_remito_id = 10544 where id = 11649;
update detalle_resumen set det_remito_id = 10545 where id = 11650;
update detalle_resumen set det_remito_id = 10556 where id = 11066;
update detalle_resumen set det_remito_id = 10558 where id = 11065;
update detalle_resumen set det_remito_id = 10559 where id = 11725;
update detalle_resumen set det_remito_id = 10569 where id = 10923;
update detalle_resumen set det_remito_id = 10570 where id = 11801;
update detalle_resumen set det_remito_id = 10574 where id = 11697;
update detalle_resumen set det_remito_id = 10575 where id = 11726;
update detalle_resumen set det_remito_id = 10588 where id = 11421;
update detalle_resumen set det_remito_id = 10589 where id = 11728;
update detalle_resumen set det_remito_id = 10591 where id = 11727;
update detalle_resumen set det_remito_id = 11488 where id = 11696;
update detalle_resumen set det_remito_id = 11745 where id = 11814;
update detalle_resumen set det_remito_id = 11748 where id = 12386;
update detalle_resumen set det_remito_id = 11749 where id = 11817;
update detalle_resumen set det_remito_id = 11749 where id = 12383;
update detalle_resumen set det_remito_id = 9574 where id = 10949;
update detalle_resumen set det_remito_id = 9604 where id = 10497;
update detalle_resumen set det_remito_id = 9604 where id = 10630;
update detalle_resumen set det_remito_id = 9605 where id = 10495;
update detalle_resumen set det_remito_id = 9605 where id = 10631;
update detalle_resumen set det_remito_id = 9606 where id = 10496;
update detalle_resumen set det_remito_id = 9606 where id = 10632;
update detalle_resumen set det_remito_id = 9607 where id = 10633;
update detalle_resumen set det_remito_id = 9608 where id = 10634;
update detalle_resumen set det_remito_id = 9609 where id = 10635;
update detalle_resumen set det_remito_id = 9610 where id = 10636;
update detalle_resumen set det_remito_id = 9612 where id = 10638;
update detalle_resumen set det_remito_id = 9613 where id = 10639;
update detalle_resumen set det_remito_id = 9614 where id = 10640;
update detalle_resumen set det_remito_id = 9615 where id = 10309;
update detalle_resumen set det_remito_id = 9615 where id = 10641;
update detalle_resumen set det_remito_id = 9616 where id = 10498;
update detalle_resumen set det_remito_id = 9616 where id = 10642;
update detalle_resumen set det_remito_id = 9617 where id = 10494;
update detalle_resumen set det_remito_id = 9618 where id = 10637;
