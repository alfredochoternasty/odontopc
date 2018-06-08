CREATE VIEW listado_ventas (
id, res_id, fecha, cliente_id, cliente_apellido, cliente_nombre, tipo_id, tipo_cliente_nombre, cliente_genera_comision, resumen_id, producto_id, precio, cantidad, total, bonificado, producto_nombre, producto_genera_comision, grupoprod_id, grupo_nombre
) AS 
select
  FLOOR(1+(RAND()*999999999999)),
  resumen.id,
  resumen.fecha,
  resumen.cliente_id,
  cliente.apellido,
  cliente.nombre,
  cliente.tipo_id,
  tipo_cliente.nombre, 
  cliente.genera_comision,
  detalle_resumen.resumen_id,
  detalle_resumen.producto_id,
  detalle_resumen.precio,
  detalle_resumen.cantidad,
  detalle_resumen.total,
  detalle_resumen.bonificado,
  producto.nombre,
  producto.genera_comision,
  producto.grupoprod_id,
  grupoprod.nombre
from
  resumen
    left join cliente on resumen.cliente_id = cliente.id
    left join tipo_cliente on cliente.tipo_id = tipo_cliente.id
    left join detalle_resumen on resumen.id = detalle_resumen.resumen_id
    left join producto on detalle_resumen.producto_id = producto.id
    left join grupoprod on producto.grupoprod_id = grupoprod.id;

CREATE VIEW `cta_cte` (
id,
fecha,
cliente_id,
debe,
haber
) AS SELECT r.id, r.fecha, c.id, sum( d.total ) AS debe, '0' AS haber
FROM resumen r
JOIN detalle_resumen d ON r.id = d.resumen_id
JOIN cliente c ON r.cliente_id = c.id
GROUP BY r.id
UNION
SELECT c.id, c.fecha, cl.id, '0' AS debe, sum( c.monto ) AS haber
FROM cobro c
JOIN cliente cl ON c.cliente_id = cl.id
GROUP BY c.id
ORDER BY fecha ASC;

INSERT INTO banco (id, nombre) VALUES
(1, 'BN AMRO BANK'),
(2, 'BANCO B. I. CREDITANSTALT S.A.'),
(3, 'BANCO BISEL S.A.'),
(4, 'BANCO BRADESCO ARGENTINA S.A.'),
(5, 'BANCO C.M.F. S.A.'),
(6, 'BANCO CENTRAL DE LA REPUBLICA ARGENTINA'),
(7, 'BANCO CETELEM ARGENTINA S.A.'),
(8, 'BANCO CIUDAD DE BUENOS AIRES'),
(9, 'BANCO COLUMBIA S.A.'),
(10, 'BANCO COMAFI S.A.'),
(11, 'BANCO CREDICOOP COOPERATIVO LIMITADA'),
(12, 'BANCO DE CORRIENTES S.A.'),
(13, 'BANCO DE FORMOSA S.A.'),
(14, 'BANCO DE GALICIA Y BUENOS AIRES S.A.'),
(15, 'BANCO DE INVERSION Y COMERCIO EXTERIOR S.A.'),
(16, 'BANCO DE LA NACION ARGENTINA'),
(17, 'BANCO DE LA PAMPA'),
(18, 'BANCO DE LA PROVINCIA DE BUENOS AIRES'),
(19, 'BANCO DE LA PROVINCIA DE CORDOBA'),
(20, 'BANCO DE LA PROVINCIA DEL NEUQUEN S.A.'),
(21, 'BANCO DE LA PROVINCIA TIERRA DEL FUEGO'),
(22, 'BANCO DE SANTA CRUZ S.A.'),
(23, 'BANCO DE VALORES S.A.'),
(24, 'BANCO DEL CHUBUT S.A.'),
(25, 'BANCO DEL SOL S.A.'),
(26, 'BANCO DO BRASIL S.A.'),
(27, 'BANCO FINANSUR S.A.'),
(28, 'BANCO HIPOTECARIO S.A.'),
(29, 'BANCO INTERAMERICANO DE DESARROLLO EN ARGENTINA'),
(30, 'BANCO ITAU BUEN AYRE S.A.'),
(31, 'BANCO MACRO BANSUD S.A.'),
(32, 'BANCO MARIVA S.A.'),
(33, 'BANCO MERIDIEN S.A.'),
(34, 'BANCO MUNICIPAL DE ROSARIO'),
(35, 'BANCO PATAGONIA S.A.'),
(36, 'BANCO PIANO S.A.'),
(37, 'BANCO PRIVADO DE INVERSIONES S.A.'),
(38, 'BANCO REGIONAL DE CUYO S.A.'),
(39, 'BANCO ROELA S.A.'),
(40, 'BANCO ROELA S.A.'),
(41, 'BANCO SAENZ S.A.'),
(42, 'BANCO SAN JUAN S.A.'),
(43, 'BANCO SANTANDER RIO S.A.'),
(44, 'BANCO SANTIAGO DEL ESTERO S.A.'),
(45, 'BANCO SUPERVIELLE S.A.'),
(46, 'BBVA BANCO FRANCES S.A.'),
(47, 'BISEL GRUPO MACRO'),
(48, 'BNP PARIBAS'),
(49, 'CITIBANK N.A.'),
(50, 'DEUTSCHE BANK S.A.'),
(51, 'HSBC BANK ARGENTINA S.A.'),
(52, 'JP MORGAN'),
(53, 'M. B. A. BANCO DE INVERSIONES'),
(54, 'NUEVO BANCO DE ENTRE RIOS S.A.'),
(55, 'NUEVO BANCO DE LA RIOJA S.A.'),
(56, 'NUEVO BANCO DE SANTA FE S.A.'),
(57, 'NUEVO BANCO DEL CHACO S.A.'),
(58, 'NUEVO BANCO INDUSTRIAL DE AZUL S.A.'),
(59, 'STANDARD BANK ARGENTINA S.A.'),
(60, 'THE BANK OF TOKYO MITSUBISHI UFJ LTD.');

--
-- Volcar la base de datos para la tabla 'condicion_fiscal'
--

INSERT INTO condicion_fiscal (id, nombre) VALUES
(1, 'RESPONSABLE INSCRIPTO'),
(2, 'MOTRIBUTISTA'),
(3, 'EXENTO'),
(4, 'CONSUMIDOR FINAL');

--
-- Volcar la base de datos para la tabla 'grupoprod'
--

INSERT INTO grupoprod (id, nombre, color) VALUES
(1, 'Interno', NULL),
(2, 'Implate', NULL),
(3, 'Otros', NULL),
(4, 'Pilares Directos', NULL),
(5, 'Pilares Pasantes', NULL),
(6, 'Tapones Anchos', NULL),
(7, 'Tapones Cicatrizales', NULL);

--
-- Volcar la base de datos para la tabla 'lista_precio'
--

INSERT INTO lista_precio (id, nombre, aumento, descuento, precio) VALUES
(1, 'NORMAL', NULL, NULL, NULL);

--
-- Volcar la base de datos para la tabla 'pago'
--


--
-- Volcar la base de datos para la tabla 'producto'
--

INSERT INTO producto (id, codigo, nombre, grupoprod_id, precio_vta, genera_comision, mueve_stock, minimo_stock, stock_actual, ctr_fact_grupo) VALUES
(1, NULL, 'IVA Facturado', 1, NULL, 0, 1, NULL, NULL, 1),
(2, NULL, 'Implate Fusion ha 3,5x7', 2, NULL, 0, 1, NULL, NULL, 1),
(3, NULL, 'Implate Fusion ha 3,5x8,5', 2, NULL, 0, 1, NULL, NULL, 1),
(4, NULL, 'Implate Fusion ha 3,5x10', 2, NULL, 0, 1, NULL, NULL, 1),
(5, NULL, 'Implate Fusion ha 3,5x11,5', 2, NULL, 0, 1, NULL, NULL, 1),
(6, NULL, 'Implate Fusion ha 3,5x13', 2, NULL, 0, 1, NULL, NULL, 1),
(7, NULL, 'Implate Fusion ha 3,5x15', 2, NULL, 0, 1, NULL, NULL, 1),
(8, NULL, 'Implate Fusion ha 4x7', 2, NULL, 0, 1, NULL, NULL, 1),
(9, NULL, 'Implate Fusion ha 4x8,5', 2, NULL, 0, 1, NULL, NULL, 1),
(10, NULL, 'Implate Fusion ha 4x10', 2, NULL, 0, 1, NULL, NULL, 1),
(11, NULL, 'Implate Fusion ha 4x11,5', 2, NULL, 0, 1, NULL, NULL, 1),
(12, NULL, 'Implate Fusion ha 4x13', 2, NULL, 0, 1, NULL, NULL, 1),
(13, NULL, 'Implate Fusion ha 4x15', 2, NULL, 0, 1, NULL, NULL, 1),
(14, NULL, 'Implate Fusion ha 4,5x7', 2, NULL, 0, 1, NULL, NULL, 1),
(15, NULL, 'Implate Fusion ha 4,5x8,5', 2, NULL, 0, 1, NULL, NULL, 1),
(16, NULL, 'Implate Fusion ha 4,5x10', 2, NULL, 0, 1, NULL, NULL, 1),
(17, NULL, 'Implate Fusion ha 4,5x11,5', 2, NULL, 0, 1, NULL, NULL, 1),
(18, NULL, 'Implate Fusion ha 4,5x13', 2, NULL, 0, 1, NULL, NULL, 1),
(19, NULL, 'Implate Fusion ha 4,5x15', 2, NULL, 0, 1, NULL, NULL, 1),
(20, NULL, 'Analogos', 3, NULL, 0, 1, NULL, NULL, 1),
(21, NULL, 'Cofias de Impresi', 3, NULL, 0, 1, NULL, NULL, 1),
(22, NULL, 'Cofias de Impresi', 3, NULL, 0, 1, NULL, NULL, 1),
(23, NULL, 'Fresas Especifica 3,5', 3, NULL, 0, 1, NULL, NULL, 1),
(24, NULL, 'Fresas Especifica 4', 3, NULL, 0, 1, NULL, NULL, 1),
(25, NULL, 'Fresas Especifica 4,5', 3, NULL, 0, 1, NULL, NULL, 1),
(26, NULL, 'Hidroxiapatita 2g', 3, NULL, 0, 1, NULL, NULL, 1),
(27, NULL, 'Hueso 1CC', 3, NULL, 0, 1, NULL, NULL, 1),
(28, NULL, 'Fresa 2,5', 3, NULL, 0, 1, NULL, NULL, 1),
(29, NULL, 'Fresa 2,8', 3, NULL, 0, 1, NULL, NULL, 1),
(30, NULL, 'Membrana de hueso ', 3, NULL, 0, 1, NULL, NULL, 1),
(31, NULL, 'Osteotomo', 3, NULL, 0, 1, NULL, NULL, 1),
(32, NULL, ' disector juego', 3, NULL, 0, 1, NULL, NULL, 1),
(33, NULL, 'Membracel', 3, NULL, 0, 1, NULL, NULL, 1),
(34, NULL, ' cofias para mu', 3, NULL, 0, 1, NULL, NULL, 1),
(35, NULL, 'Destornillador Mango', 3, NULL, 0, 1, NULL, NULL, 1),
(36, NULL, 'Membracel G', 3, NULL, 0, 1, NULL, NULL, 1),
(37, NULL, 'Membrecel M', 3, NULL, 0, 1, NULL, NULL, 1),
(38, NULL, 'punta 0,48', 3, NULL, 0, 1, NULL, NULL, 1),
(39, NULL, 'adaptador para criket', 3, NULL, 0, 1, NULL, NULL, 1),
(40, NULL, ' adaptador para criket', 3, NULL, 0, 1, NULL, NULL, 1),
(41, NULL, 'transportador implante', 3, NULL, 0, 1, NULL, NULL, 1),
(42, NULL, 'Hueso 0,5gr', 3, NULL, 0, 1, NULL, NULL, 1),
(43, NULL, 'torquimetro', 3, NULL, 0, 1, NULL, NULL, 1),
(44, NULL, ' llave para pilar bola', 3, NULL, 0, 1, NULL, NULL, 1),
(45, NULL, 'Pilares Directos 3,3x2,5x5', 4, NULL, 0, 1, NULL, NULL, 1),
(46, NULL, 'Pilares Directos 3,3x3,5x5', 4, NULL, 0, 1, NULL, NULL, 1),
(47, NULL, 'Pilares Directos 3,3x4,5x5', 4, NULL, 0, 1, NULL, NULL, 1),
(48, NULL, 'Pilares Directos Ancho 4,5x3x4', 4, NULL, 0, 1, NULL, NULL, 1),
(49, NULL, 'Pilares Directos 3.3x5.5x5', 4, NULL, 0, 1, NULL, NULL, 1),
(50, NULL, ' Pilar bola', 4, NULL, 0, 1, NULL, NULL, 1),
(51, NULL, 'Pilares Pasantes 3,3x2,5x5', 5, NULL, 0, 1, NULL, NULL, 1),
(52, NULL, 'Pilares Pasantes 3,3x4,5x5', 5, NULL, 0, 1, NULL, NULL, 1),
(53, NULL, 'Pilares Pasantes 3,3x3,5x5', 5, NULL, 0, 1, NULL, NULL, 1),
(54, NULL, 'Pilar hombro variable', 5, NULL, 0, 1, NULL, NULL, 1),
(55, NULL, 'Pilares Pasantes 4,5x3', 5, NULL, 0, 1, NULL, NULL, 1),
(56, NULL, 'Tapones Anchos 4,5x3', 6, NULL, 0, 1, NULL, NULL, 1),
(57, NULL, 'Tapones Cicatrizales 3,3x2', 7, NULL, 0, 1, NULL, NULL, 1),
(58, NULL, 'Tapones Cicatrizales 3,3x3', 7, NULL, 0, 1, NULL, NULL, 1),
(59, NULL, 'Tapones Cicatrizales 3,3x4', 7, NULL, 0, 1, NULL, NULL, 1),
(60, NULL, 'Tapones Cicatrizales 3,3x5,5', 7, NULL, 1, 1, NULL, NULL, 1);

--
-- Volcar la base de datos para la tabla 'proveedor'
--


--
-- Volcar la base de datos para la tabla 'provincia'
--

INSERT INTO provincia (id, nombre) VALUES
(1, 'BUENOS AIRES'),
(2, 'CATAMARCA'),
(3, 'CORDOBA'),
(4, 'CORRIENTES'),
(5, 'ENTRE RIOS'),
(6, 'JUJUY'),
(7, 'MENDOZA'),
(8, 'LA RIOJA'),
(9, 'SALTA'),
(10, 'SAN JUAN'),
(11, 'SAN LUIS'),
(12, 'SANTA FE'),
(13, 'SANTIAGO DEL ESTERO'),
(14, 'TUCUMAN'),
(16, 'CHACO'),
(17, 'CHUBUT'),
(18, 'FORMOSA'),
(19, 'MISIONES'),
(20, 'NEUQUEN'),
(21, 'LA PAMPA'),
(22, 'RIO NEGRO'),
(23, 'SANTA CRUZ'),
(24, 'TIERRA DEL FUEGO'),
(25, 'CIUDAD AUTONOMA BUENOS AIRES');

--
-- Volcar la base de datos para la tabla 'resumen'
--


--
-- Volcar la base de datos para la tabla 'tipo_cliente'
--

INSERT INTO tipo_cliente (id, nombre) VALUES
(1, 'CLIENTE'),
(2, 'DISTRIBUIDOR');

--
-- Volcar la base de datos para la tabla 'tipo_cobro_pago'
--

INSERT INTO tipo_cobro_pago (id, nombre) VALUES
(1, 'EFECTIVO'),
(2, 'CHEQUE'),
(3, 'DEPOSITO BANCARIO'),
(4, 'TRANSFERENCIA BANCARIA');

--
-- Volcar la base de datos para la tabla 'tipo_factura'
--

INSERT INTO tipo_factura (id, nombre) VALUES
(1, 'FACTURA A'),
(2, 'FACTURA B'),
(3, 'FACTURA C'),
(4, 'REMITO');

--
-- Volcar la base de datos para la tabla 'localidad'
--

INSERT INTO localidad (id, nombre, provincia_id) VALUES
(1, 'PARANA', 5),
(2, 'SANTA FE', 12);


INSERT INTO cuenta_compras (id, nombre) VALUES
(1, 'NTI implantes'),
(2, 'Julio Garcia');