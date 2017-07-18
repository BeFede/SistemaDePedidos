--Estados de pedido
INSERT INTO estados_pedidos (nombre) VALUES ('pendiente');
INSERT INTO estados_pedidos (nombre) VALUES ('procesando');
INSERT INTO estados_pedidos (nombre) VALUES ('enviando');

--Empaques
INSERT INTO empaques (nombre) VALUES ('bulto');
INSERT INTO empaques (nombre) VALUES ('unidad');

--grupos
INSERT INTO grupos (id,nombre) VALUES (0, 'root');
INSERT INTO grupos (id,nombre) VALUES (1, 'vendedores');
INSERT INTO grupos (id,nombre) VALUES (2, 'clientes');

--listas de precio
INSERT INTO listas_precio (id, descripcion) VALUES (1, 'lista 1');
INSERT INTO listas_precio (id, descripcion) VALUES (2, 'lista 2');

--Articulos
INSERT INTO articulos (nombre, alicuota_IVA, stock_actual)
VALUES ("La Republica", 10.5, 5);

INSERT INTO articulos (nombre, alicuota_IVA, stock_actual)
VALUES ("El Principe", 10.5, 2);

INSERT INTO articulos (nombre, alicuota_IVA, stock_actual)
VALUES ("Política", 21, 10);

INSERT INTO articulos (nombre, alicuota_IVA, stock_actual)
VALUES ("Utopia", 10.5, 6);

INSERT INTO articulos (nombre, alicuota_IVA, stock_actual)
VALUES ("El Discurso del método", 21, 10);

--precios de articulo por lista de precio y empaque
INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,1,1,55.6);
INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,1,2,100);

INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,2,1,80);
INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,2,2,90.33);


INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,3,1,32);
INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,3,2,35);


INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,4,1,60);
INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,4,2,78.5);


INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,5,1,80);
INSERT INTO precios_articulos_x_listas_precio_x_empaque (id_lista_precio, id_articulo, empaque, precio)
VALUES(1,5,2,80);
