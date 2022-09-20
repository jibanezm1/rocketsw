-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-04-2022 a las 09:48:01
-- Versión del servidor: 5.6.41-84.1
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `educare_cotizador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE `banco` (
  `idbanco` int(11) NOT NULL,
  `nombreBanco` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `tipoCTA` int(11) NOT NULL,
  `nombreEjecutivo` varchar(300) COLLATE utf8_spanish2_ci NOT NULL,
  `direccionEjecutivo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `correoEjecutivo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `telefonoEjecutivo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `banco`
--

INSERT INTO `banco` (`idbanco`, `nombreBanco`, `tipoCTA`, `nombreEjecutivo`, `direccionEjecutivo`, `correoEjecutivo`, `telefonoEjecutivo`) VALUES
(1, 'Banco BCI', 1, 'Ejecutivo 1', 'Casablanca 2536', 'correo@ejecutivo.cl', '+569 40184459');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cajaChica`
--

CREATE TABLE `cajaChica` (
  `idCajachica` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `rutUsuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `saldo` int(11) NOT NULL,
  `Mes` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cajaChica`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catProductos`
--

CREATE TABLE `catProductos` (
  `idCat` int(11) NOT NULL,
  `nombreCat` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `rutCliente` int(11) NOT NULL,
  `nombreCliente` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionCliente` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giroCliente` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoCliente` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regionCliente` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comunaCliente` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correoCliente` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactoCliente`
--

CREATE TABLE `contactoCliente` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `correoCliente` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `numeroCliente` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `rutCliente` int(11) NOT NULL,
  `oldID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `contactoCliente`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion`
--

CREATE TABLE `cotizacion` (
  `idcotizacion` int(11) NOT NULL,
  `fecha` timestamp(6) NULL DEFAULT NULL,
  `totalNeto` decimal(10,0) DEFAULT NULL,
  `IVA` decimal(10,0) DEFAULT NULL,
  `Total` decimal(10,0) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rutCliente` int(11) NOT NULL,
  `rutUsuario` int(11) NOT NULL,
  `mail` int(11) DEFAULT NULL,
  `evento` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validez` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entrega` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formaDePago` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipoDeMoneda` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  `leida` int(11) NOT NULL,
  `flete` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `comentarios` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rutContacto` int(11) NOT NULL,
  `idProyecto` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cotizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleCotizacion`
--

CREATE TABLE `detalleCotizacion` (
  `iddetalleCotizacion` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `tiempo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `precio` decimal(19,0) DEFAULT NULL,
  `iva` decimal(19,0) NOT NULL,
  `total` decimal(19,0) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idcotizacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalleCotizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleNota`
--

CREATE TABLE `detalleNota` (
  `iddetalleNota` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `tiempo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `precio` int(11) DEFAULT NULL,
  `iva` decimal(19,0) NOT NULL,
  `total` decimal(19,0) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idNota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalleNota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleNotaVenta`
--

CREATE TABLE `detalleNotaVenta` (
  `iddetallenotaventa` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `idproducto` int(11) NOT NULL,
  `idNotaVenta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleOrdenIngreso`
--

CREATE TABLE `detalleOrdenIngreso` (
  `iddetalleordeningreso` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(19,0) DEFAULT NULL,
  `idproducto` int(11) NOT NULL,
  `idordenIngreso` int(11) NOT NULL,
  `total` decimal(19,0) NOT NULL,
  `iva` decimal(19,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalleOrdenIngreso`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `rutEmpresa` int(11) DEFAULT NULL,
  `dv` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreEmpresa` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `rutEmpresa`, `dv`, `nombreEmpresa`) VALUES
(1, 188888, '1', 'Nombre de Empresa'),
(2, 28888, '1', 'Aqui va el rubro de la empresa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factoring`
--

CREATE TABLE `factoring` (
  `idFactoring` int(11) NOT NULL,
  `nombreFactoring` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `factoring`
--

INSERT INTO `factoring` (`idFactoring`, `nombreFactoring`) VALUES
(1, 'Sin Factoring'),
(2, 'Factoring 1'),
(3, 'Factoring 2\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotosProductos`
--

CREATE TABLE `fotosProductos` (
  `idfotosProductos` int(11) NOT NULL,
  `ruta` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipoFotografia` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fotosProductos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastosCajaChica`
--

CREATE TABLE `gastosCajaChica` (
  `id_gastoCajaChica` int(11) NOT NULL,
  `documento` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `idCajachica` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `fechaGasto` date NOT NULL,
  `idProyecto` int(11) NOT NULL DEFAULT '0',
  `idGasto` int(11) NOT NULL DEFAULT '0',
  `motivo` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `gastosCajaChica`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_proyecto`
--

CREATE TABLE `gastos_proyecto` (
  `idGastos` int(11) NOT NULL,
  `fechaGasto` date DEFAULT NULL,
  `Titulo` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `motivoGasto` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rutUsuario` int(11) DEFAULT NULL,
  `idProyecto` int(11) DEFAULT NULL,
  `fotoGasto` varchar(300) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `monto` int(11) NOT NULL,
  `tipoDocumento` int(11) NOT NULL,
  `tipoRecibo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `gastos_proyecto`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `NotaVenta`
--

CREATE TABLE `NotaVenta` (
  `idNotaVenta` int(11) NOT NULL,
  `fecha` timestamp(6) NULL DEFAULT NULL,
  `totalNeto` decimal(10,0) DEFAULT NULL,
  `IVA` decimal(10,0) DEFAULT NULL,
  `Total` decimal(10,0) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rutCliente` int(11) NOT NULL,
  `rutUsuario` int(11) NOT NULL,
  `evento` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validez` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entrega` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formaDePago` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipoDeMoneda` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idempresa` int(11) NOT NULL,
  `flete` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comentarios` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idCotizacion` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `NotaVenta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenIngreso`
--

CREATE TABLE `ordenIngreso` (
  `idordenIngreso` int(11) NOT NULL,
  `fechaIngreso` timestamp(6) NULL DEFAULT NULL,
  `forma` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `medio` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `terminos` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `observaciones` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `rutProveedor` int(11) NOT NULL,
  `totalNeto` decimal(10,0) NOT NULL,
  `IVA` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `pago` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `idProyecto` int(11) NOT NULL DEFAULT '1',
  `rutUsuario` int(11) NOT NULL DEFAULT '18008165'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ordenIngreso`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_venta`
--

CREATE TABLE `pago_venta` (
  `idPago` int(11) NOT NULL,
  `idNotaVenta` int(11) NOT NULL,
  `forma` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idbanco` int(11) NOT NULL,
  `factorizada` int(11) NOT NULL,
  `idFactoring` int(11) NOT NULL,
  `porcentajePago` int(11) NOT NULL,
  `imagen` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `pago_venta`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `SKU` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreProducto` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcionProducto` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precioLista` decimal(10,0) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `producto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productoDocumentos`
--

CREATE TABLE `productoDocumentos` (
  `idproductoDocumentos` int(11) NOT NULL,
  `ruta` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descripcionArchivo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productoDocumentos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `rutProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `direccionProveedor` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `giroProveedor` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefonoProveedor` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regionProveedor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comunaProveedor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correoProveedor` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contacto` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proveedor`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE `proyectos` (
  `idproyecto` int(11) NOT NULL,
  `fechaCreacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `nombreProyecto` varchar(500) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `estadoProyecto` int(11) DEFAULT NULL,
  `rutCliente` int(11) DEFAULT NULL,
  `descripcionProyecto` varchar(400) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `rutUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `proyectos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoUsuario`
--

CREATE TABLE `tipoUsuario` (
  `idTipoUsuario` int(11) NOT NULL,
  `nombreTipo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipoUsuario`
--

INSERT INTO `tipoUsuario` (`idTipoUsuario`, `nombreTipo`) VALUES
(1, 'Adminstrador'),
(2, 'Cotizador'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `rutUsuario` int(11) NOT NULL,
  `dv` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nombreUsuario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apellidosUsuario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fechaIngreso` timestamp(6) NULL DEFAULT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  `clave` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`rutUsuario`, `dv`, `nombreUsuario`, `apellidosUsuario`, `fechaIngreso`, `idTipoUsuario`, `clave`, `correo`, `telefono`) VALUES
(1, '1', 'Usuario ', 'Administrador', '2020-04-16 05:00:00.000000', 1, 'Sibotec2020', 'admin@sibotec.cl', '+56 9 40184459');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `banco`
--
ALTER TABLE `banco`
  ADD PRIMARY KEY (`idbanco`);

--
-- Indices de la tabla `cajaChica`
--
ALTER TABLE `cajaChica`
  ADD PRIMARY KEY (`idCajachica`);

--
-- Indices de la tabla `catProductos`
--
ALTER TABLE `catProductos`
  ADD PRIMARY KEY (`idCat`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`rutCliente`);

--
-- Indices de la tabla `contactoCliente`
--
ALTER TABLE `contactoCliente`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD PRIMARY KEY (`idcotizacion`,`rutCliente`,`rutUsuario`,`idempresa`),
  ADD KEY `fk_cotizacion_proveedor1` (`rutCliente`),
  ADD KEY `fk_cotizacion_empresa1` (`idempresa`),
  ADD KEY `fk_cotizacion_Usuario1` (`rutUsuario`);

--
-- Indices de la tabla `detalleCotizacion`
--
ALTER TABLE `detalleCotizacion`
  ADD PRIMARY KEY (`iddetalleCotizacion`,`idproducto`,`idcotizacion`),
  ADD KEY `fk_detalleCotizacion_producto1` (`idproducto`),
  ADD KEY `fk_detalleCotizacion_cotizacion1` (`idcotizacion`);

--
-- Indices de la tabla `detalleNota`
--
ALTER TABLE `detalleNota`
  ADD PRIMARY KEY (`iddetalleNota`,`idproducto`,`idNota`),
  ADD KEY `fk_detalleCotizacion_producto1` (`idproducto`),
  ADD KEY `fk_Nota` (`idNota`);

--
-- Indices de la tabla `detalleNotaVenta`
--
ALTER TABLE `detalleNotaVenta`
  ADD PRIMARY KEY (`iddetallenotaventa`,`idproducto`),
  ADD KEY `fk_detalleCotizacion_producto10` (`idproducto`),
  ADD KEY `fk_detalleNotaVenta_NotaVenta1` (`idNotaVenta`);

--
-- Indices de la tabla `detalleOrdenIngreso`
--
ALTER TABLE `detalleOrdenIngreso`
  ADD PRIMARY KEY (`iddetalleordeningreso`,`idproducto`,`idordenIngreso`),
  ADD KEY `fk_detalleCotizacion_producto100` (`idproducto`),
  ADD KEY `fk_detalleOrdenIngreso_ordenIngreso1` (`idordenIngreso`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`);

--
-- Indices de la tabla `factoring`
--
ALTER TABLE `factoring`
  ADD PRIMARY KEY (`idFactoring`);

--
-- Indices de la tabla `fotosProductos`
--
ALTER TABLE `fotosProductos`
  ADD PRIMARY KEY (`idfotosProductos`,`idproducto`),
  ADD KEY `fk_fotosProductos_producto1` (`idproducto`);

--
-- Indices de la tabla `gastosCajaChica`
--
ALTER TABLE `gastosCajaChica`
  ADD PRIMARY KEY (`id_gastoCajaChica`);

--
-- Indices de la tabla `gastos_proyecto`
--
ALTER TABLE `gastos_proyecto`
  ADD PRIMARY KEY (`idGastos`);

--
-- Indices de la tabla `NotaVenta`
--
ALTER TABLE `NotaVenta`
  ADD PRIMARY KEY (`idNotaVenta`,`rutCliente`,`rutUsuario`,`idempresa`),
  ADD KEY `fk_cotizacion_proveedor10` (`rutCliente`),
  ADD KEY `fk_cotizacion_empresa10` (`idempresa`),
  ADD KEY `fk_cotizacion_Usuario10` (`rutUsuario`);

--
-- Indices de la tabla `ordenIngreso`
--
ALTER TABLE `ordenIngreso`
  ADD PRIMARY KEY (`idordenIngreso`,`rutProveedor`),
  ADD KEY `fk_ordenIngreso_proveedor1` (`rutProveedor`);

--
-- Indices de la tabla `pago_venta`
--
ALTER TABLE `pago_venta`
  ADD PRIMARY KEY (`idPago`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`);

--
-- Indices de la tabla `productoDocumentos`
--
ALTER TABLE `productoDocumentos`
  ADD PRIMARY KEY (`idproductoDocumentos`,`idproducto`),
  ADD KEY `fk_productoDocumentos_producto1` (`idproducto`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`rutProveedor`);

--
-- Indices de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD PRIMARY KEY (`idproyecto`);

--
-- Indices de la tabla `tipoUsuario`
--
ALTER TABLE `tipoUsuario`
  ADD PRIMARY KEY (`idTipoUsuario`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`rutUsuario`,`idTipoUsuario`),
  ADD KEY `fk_Usuario_tipoUsuario` (`idTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `banco`
--
ALTER TABLE `banco`
  MODIFY `idbanco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cajaChica`
--
ALTER TABLE `cajaChica`
  MODIFY `idCajachica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `catProductos`
--
ALTER TABLE `catProductos`
  MODIFY `idCat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactoCliente`
--
ALTER TABLE `contactoCliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=676;

--
-- AUTO_INCREMENT de la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  MODIFY `idcotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4549;

--
-- AUTO_INCREMENT de la tabla `detalleCotizacion`
--
ALTER TABLE `detalleCotizacion`
  MODIFY `iddetalleCotizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2072;

--
-- AUTO_INCREMENT de la tabla `detalleNota`
--
ALTER TABLE `detalleNota`
  MODIFY `iddetalleNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT de la tabla `detalleNotaVenta`
--
ALTER TABLE `detalleNotaVenta`
  MODIFY `iddetallenotaventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalleOrdenIngreso`
--
ALTER TABLE `detalleOrdenIngreso`
  MODIFY `iddetalleordeningreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factoring`
--
ALTER TABLE `factoring`
  MODIFY `idFactoring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fotosProductos`
--
ALTER TABLE `fotosProductos`
  MODIFY `idfotosProductos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=446;

--
-- AUTO_INCREMENT de la tabla `gastosCajaChica`
--
ALTER TABLE `gastosCajaChica`
  MODIFY `id_gastoCajaChica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `gastos_proyecto`
--
ALTER TABLE `gastos_proyecto`
  MODIFY `idGastos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `NotaVenta`
--
ALTER TABLE `NotaVenta`
  MODIFY `idNotaVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `ordenIngreso`
--
ALTER TABLE `ordenIngreso`
  MODIFY `idordenIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3405;

--
-- AUTO_INCREMENT de la tabla `pago_venta`
--
ALTER TABLE `pago_venta`
  MODIFY `idPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;

--
-- AUTO_INCREMENT de la tabla `productoDocumentos`
--
ALTER TABLE `productoDocumentos`
  MODIFY `idproductoDocumentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de la tabla `proyectos`
--
ALTER TABLE `proyectos`
  MODIFY `idproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `tipoUsuario`
--
ALTER TABLE `tipoUsuario`
  MODIFY `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizacion`
--
ALTER TABLE `cotizacion`
  ADD CONSTRAINT `fk_cotizacion_Usuario1` FOREIGN KEY (`rutUsuario`) REFERENCES `Usuario` (`rutUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotizacion_empresa1` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotizacion_proveedor1` FOREIGN KEY (`rutCliente`) REFERENCES `cliente` (`rutCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleCotizacion`
--
ALTER TABLE `detalleCotizacion`
  ADD CONSTRAINT `fk_detalleCotizacion_cotizacion1` FOREIGN KEY (`idcotizacion`) REFERENCES `cotizacion` (`idcotizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleCotizacion_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleNota`
--
ALTER TABLE `detalleNota`
  ADD CONSTRAINT `fk_Nota` FOREIGN KEY (`idNota`) REFERENCES `NotaVenta` (`idNotaVenta`);

--
-- Filtros para la tabla `detalleNotaVenta`
--
ALTER TABLE `detalleNotaVenta`
  ADD CONSTRAINT `fk_detalleCotizacion_producto10` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleNotaVenta_NotaVenta1` FOREIGN KEY (`idNotaVenta`) REFERENCES `NotaVenta` (`idNotaVenta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleOrdenIngreso`
--
ALTER TABLE `detalleOrdenIngreso`
  ADD CONSTRAINT `fk_detalleCotizacion_producto100` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalleOrdenIngreso_ordenIngreso1` FOREIGN KEY (`idordenIngreso`) REFERENCES `ordenIngreso` (`idordenIngreso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fotosProductos`
--
ALTER TABLE `fotosProductos`
  ADD CONSTRAINT `fk_fotosProductos_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `NotaVenta`
--
ALTER TABLE `NotaVenta`
  ADD CONSTRAINT `fk_cotizacion_Usuario10` FOREIGN KEY (`rutUsuario`) REFERENCES `Usuario` (`rutUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotizacion_empresa10` FOREIGN KEY (`idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cotizacion_proveedor10` FOREIGN KEY (`rutCliente`) REFERENCES `cliente` (`rutCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ordenIngreso`
--
ALTER TABLE `ordenIngreso`
  ADD CONSTRAINT `fk_ordenIngreso_proveedor1` FOREIGN KEY (`rutProveedor`) REFERENCES `proveedor` (`rutProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productoDocumentos`
--
ALTER TABLE `productoDocumentos`
  ADD CONSTRAINT `fk_productoDocumentos_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_Usuario_tipoUsuario` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipoUsuario` (`idTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
