-- -------EJECUTANDO PRUEBAS		
-- -------- SELECT TODO
SELECT * FROM CATEGORIA;
SELECT * FROM CATALOGO;
SELECT * FROM PRODUCTO;
SELECT * FROM INVENTARIO;
SELECT * FROM USUARIO;
SELECT * FROM CUENTA;
SELECT * FROM DOMICILIO_CUENTA;
SELECT * FROM FACTURA;
SELECT * FROM ITEM_FACTURA ORDER BY FACTURA_ID_FACTURA;
SELECT * FROM PEDIDO_ENTREGA;

-- -------------joins-------------
SELECT u.ID_USUARIO, u.EMAIL, c.TIPO_DOCUMENTO, c.NUM_DOCUMENTO FROM
USUARIO u INNER JOIN CUENTA c
ON u.ID_USUARIO = c.USUARIO_ID_USUARIO
ORDER BY u.ID_USUARIO ASC; 
-- -----------------------
SELECT (NOMBRE, DESCRIPCION, CATEGORIA_ID_CATEGORIA) FROM CATEGORIA WHERE ID_CATEGORIA = ?;
SELECT * FROM CATALOGO WHERE ACTIVO = TRUE;
DELETE FROM CATEGORIA WHERE ID_CATEGORIA = 1;
UPDATE PRODUCTO SET NOMBRE = 'TOSTADAS FRANCESAS', PRECIO = 2500 WHERE ID_PRODUCTO = 'PRO#000010';

SELECT * FROM FACTURA WHERE DATE(FECHA) = '2015-04-04';

select convert('2010-10-10 22:30:10', datetime);
SELECT WEEK(f.FECHA) FROM FACTURA f;
DELETE FROM FACTURA WHERE ID_FACTURA = 'F#00000001';

SELECT COUNT(*) FROM producto;

SELECT c.NOMBRE, c.CATEGORIA_ID_CATEGORIA FROM CATEGORIA c -- LEFT JOIN CATEGORIA b ON b.ID_CATEGORIA = c.CATEGORIA_ID_CATEGORIA
WHERE c.ID_CATEGORIA != c.CATEGORIA_ID_CATEGORIA;

SELECT * FROM PRODUCTO WHERE ID_PRODUCTO = 'pro0000017';

SELECT * FROM CATEGORIA LIMIT 4 OFFSET 6;
SELECT * FROM CATEGORIA LIMIT 4 , 6;

-- ---------------PUEBas para iniciar la construccion de una funcion para autoincrementar un id de producto y logra que sea autoincremental y alfanumerico
SELECT ID_PRODUCTO FROM producto ORDER BY ID_PRODUCTO;

SELECT LEFT(p.ID_PRODUCTO, 3) FROM PRODUCTO p;

SELECT * FROM PRODUCTO LIMIT 0 , 10;
SELECT * FROM PRODUCTO LIMIT 1 , 5;
SELECT * FROM PRODUCTO LIMIT 10 , 10;
SELECT * FROM PRODUCTO LIMIT 12 , 10;
SELECT * FROM PRODUCTO LIMIT 18 , 10;
SELECT * FROM PRODUCTO LIMIT 2 , 12;
SELECT * FROM PRODUCTO LIMIT 0 , 12;

SELECT COUNT(p.ID_PRODUCTO) AS 'NPRO' FROM PRODUCTO p;

SELECT GET_NEW_ID_PRODUCTO();

