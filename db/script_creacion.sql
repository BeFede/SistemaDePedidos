CREATE DATABASE sistema_pedidos;

USE sistema_pedidos;

CREATE TABLE tipos_documentos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(10)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE condiciones_frente_a_IVA(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE barrios(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE zonas(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE ciudades(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20),
  id_provincia INT REFERENCES provincias(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE provincias(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20),
  id_pais INT REFERENCES paises(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE paises(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE listas_precio(
  id INT AUTO_INCREMENT PRIMARY KEY,
  descripcion VARCHAR(20)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE articulos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(50),
  alicuota_IVA DOUBLE,
  stock_actual INT,
  foto VARCHAR(100)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE empaques(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(10)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE precios_articulos_x_listas_precio_x_empaque(
  id_lista_precio INT NOT NULL,
  id_articulo INT NOT NULL,
  empaque INT REFERENCES empaques(id),
  precio DOUBLE,
  CONSTRAINT pk_precios_articulos_x_listas_precio
  PRIMARY KEY (id_lista_precio, id_articulo, empaque)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


--Usuarios y grupos del sistema
CREATE TABLE grupos(
  id INT PRIMARY KEY,
  nombre VARCHAR(15)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE usuarios(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre_usuario VARCHAR(20),
  password VARCHAR(80),
  grupo INT REFERENCES grupos(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE clientes(
  nro_cliente INT AUTO_INCREMENT PRIMARY KEY,
  tipo_doc INT REFERENCES tipos_documentos(id),
  nro_documento VARCHAR(10),
  cuit VARCHAR(14),
  nombre VARCHAR(50),
  direccion VARCHAR(50),
  tel_movil VARCHAR(15),
  tel_fijo VARCHAR(15),
  email VARCHAR(30),
  id_ciudad INT REFERENCES ciudades(id),
  id_barrio INT REFERENCES barrios(id),
  id_zona INT REFERENCES zonas(id),
  cond_IVA INT REFERENCES condiciones_frente_a_IVA(id),
  limite_credito DOUBLE,
  id_lista_precio INT REFERENCES listas_precio(id),
  id_usuario INT REFERENCES usuarios(id),
  observaciones TEXT
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE estados_pedidos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(15)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;



CREATE TABLE pedidos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha_hora DATETIME NOT NULL,
  nro_cliente INT REFERENCES clientes(id),
  id_usuario INT REFERENCES usuarios(id),
  id_estado_pedido INT REFERENCES estados_pedidos(id),
  porcentaje_descuento DOUBLE,
  monto DOUBLE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE detalles_pedidos(
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_pedido INT REFERENCES pedidos(id),
  cantidad INT,
  monto DOUBLE,
  porcentaje_descuento DOUBLE,
  IVA DOUBLE,
  empaque INT REFERENCES empaque(id)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE historiales_estados_pedido(
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_pedido INT REFERENCES pedidos(id),
  fecha_hora_inicio DATETIME,
  fecha_hora_fin DATETIME,
  estado INT REFERENCES estados_pedidos(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE vendedores(
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(30) NOT NULL,
  id_usuario INT REFERENCES  usuarios(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE vendedores_x_zona(
  id_zona INT REFERENCES zonas(id),
  id_vendedor INT REFERENCES vendedores(id),
  CONSTRAINT pk_vendedores_x_zona
  PRIMARY KEY(id_zona, id_vendedor)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE itinerarios(
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha DATE,
  id_vendedor INT REFERENCES vendedores(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE visitas(
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha_hora DATETIME,
  nro_cliente INT REFERENCES clientes(nro_cliente),
  latitud DOUBLE,
  longitud DOUBLE,
  id_itinerario INT REFERENCES itinerarios(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;
