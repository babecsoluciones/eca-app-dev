-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-06-2019 a las 02:47:09
-- Versión del servidor: 5.7.23
-- Versión de PHP: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `impresion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BitPedidos`
--

CREATE TABLE `BitPedidos` (
  `eCodPedido` int(11) NOT NULL,
  `eCodCliente` int(11) NOT NULL,
  `tCodEstatus` char(2) NOT NULL,
  `eCodEtapa` int(11) NOT NULL,
  `fhFechaPedido` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `BitPedidos`
--

INSERT INTO `BitPedidos` (`eCodPedido`, `eCodCliente`, `tCodEstatus`, `eCodEtapa`, `fhFechaPedido`) VALUES
(1, 1, 'NU', 1, '2019-06-15 19:29:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BitTransacciones`
--

CREATE TABLE `BitTransacciones` (
  `eCodTransaccion` int(11) NOT NULL,
  `eCodUsuario` int(11) NOT NULL,
  `eCodEvento` int(11) NOT NULL,
  `fhFecha` datetime NOT NULL,
  `dMonto` double NOT NULL,
  `eCodTipoPago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatClientes`
--

CREATE TABLE `CatClientes` (
  `eCodCliente` int(11) NOT NULL,
  `tNombres` varchar(100) DEFAULT NULL,
  `tApellidos` varchar(100) DEFAULT NULL,
  `tCorreo` varchar(100) DEFAULT NULL,
  `tPassword` varchar(60) DEFAULT NULL,
  `tTelefonoFijo` varchar(15) DEFAULT NULL,
  `tTelefonoMovil` varchar(15) DEFAULT NULL,
  `fhFechaCreacion` datetime DEFAULT NULL,
  `eCodEstatus` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatClientes`
--

INSERT INTO `CatClientes` (`eCodCliente`, `tNombres`, `tApellidos`, `tCorreo`, `tPassword`, `tTelefonoFijo`, `tTelefonoMovil`, `fhFechaCreacion`, `eCodEstatus`) VALUES
(1, 'mario ernesto', 'Basurto Medrano', 'babes.soluciones@gmail.com', '280291', '3146882012', '5541444146', '2019-06-14 00:00:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatEstatus`
--

CREATE TABLE `CatEstatus` (
  `eCodEstatus` int(11) NOT NULL,
  `tCodEstatus` varchar(2) DEFAULT NULL,
  `tNombre` varchar(15) DEFAULT NULL,
  `tIcono` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatEstatus`
--

INSERT INTO `CatEstatus` (`eCodEstatus`, `tCodEstatus`, `tNombre`, `tIcono`) VALUES
(1, 'NU', 'Nuevo', 'far fa-question-circle'),
(2, 'PR', 'En proceso...', 'fas fa-cogs'),
(3, 'AC', 'Activo', 'fa fa-check'),
(4, 'CA', 'Cancelado', 'fas fa-ban'),
(5, 'RE', 'Rechazado', 'fas fa-minus-circle'),
(6, 'BL', 'Bloqueado', 'fas fa-lock'),
(7, 'EL', 'Eliminado', 'far fa-trash-alt'),
(8, 'FI', 'Finalizado', 'fas fa-check-double');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatEtapas`
--

CREATE TABLE `CatEtapas` (
  `eCodEtapa` int(11) NOT NULL,
  `tClase` varchar(50) NOT NULL,
  `tNombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatEtapas`
--

INSERT INTO `CatEtapas` (`eCodEtapa`, `tClase`, `tNombre`) VALUES
(1, 'alert alert-primary', 'Orden Recibida'),
(2, 'alert alert-secondary', 'Confirmando Pago'),
(3, 'alert alert-success', 'Orden Pagada'),
(4, 'alert alert-info', 'En proceso...'),
(5, 'alert alert-warning', 'En camino'),
(6, 'alert alert-success', 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatProductos`
--

CREATE TABLE `CatProductos` (
  `eCodProducto` int(11) NOT NULL,
  `tNombre` varchar(50) NOT NULL,
  `tDescripcion` text NOT NULL,
  `tImagen` varchar(200) NOT NULL,
  `dPrecio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `CatProductos`
--

INSERT INTO `CatProductos` (`eCodProducto`, `tNombre`, `tDescripcion`, `tImagen`, `dPrecio`) VALUES
(1, 'Prueba', 'Descripción de prueba', 'inv/5d0586cf056a0.jpg', 120);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CatTiposPagos`
--

CREATE TABLE `CatTiposPagos` (
  `eCodTipoPago` int(11) NOT NULL,
  `tNombre` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `CatTiposPagos`
--

INSERT INTO `CatTiposPagos` (`eCodTipoPago`, `tNombre`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta'),
(3, 'Cheque'),
(4, 'Transferencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RelPedidosProductos`
--

CREATE TABLE `RelPedidosProductos` (
  `eCodRegistro` int(11) NOT NULL,
  `eCodEvento` int(11) NOT NULL,
  `eCodProducto` int(11) NOT NULL,
  `eCantidad` int(11) NOT NULL,
  `tDimensiones` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RelPedidosProductosArchivos`
--

CREATE TABLE `RelPedidosProductosArchivos` (
  `eCodArchivo` int(11) NOT NULL,
  `eCodRegistro` int(11) NOT NULL,
  `tArchivo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `RelPedidosSeguimiento`
--

CREATE TABLE `RelPedidosSeguimiento` (
  `eCodRegistro` int(11) NOT NULL,
  `eCodPedido` int(11) NOT NULL,
  `eCodEtapa` int(11) NOT NULL,
  `fhFecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisBotones`
--

CREATE TABLE `SisBotones` (
  `tCodBoton` varchar(2) NOT NULL,
  `tTitulo` varchar(20) DEFAULT NULL,
  `tFuncion` varchar(25) DEFAULT NULL,
  `tAccion` varchar(25) NOT NULL,
  `tIcono` varchar(45) DEFAULT NULL,
  `tId` varchar(15) NOT NULL,
  `tClase` varchar(50) NOT NULL,
  `tHTML` varchar(255) DEFAULT NULL,
  `bDeshabilitado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisBotones`
--

INSERT INTO `SisBotones` (`tCodBoton`, `tTitulo`, `tFuncion`, `tAccion`, `tIcono`, `tId`, `tClase`, `tHTML`, `bDeshabilitado`) VALUES
('CO', 'Listado', 'window.location=\'url\';', '', '<i class=\"fas fa-table\"></i>', '', 'btn btn-primary', NULL, NULL),
('EL', 'Eliminar', 'eliminar();', '', '<i class=\"far fa-trash-alt\"></i>', '', 'btn btn-danger', NULL, NULL),
('GU', 'Guardar', 'validar();', '', '<i class=\"fa fa-floppy-o\"></i>', 'btnGuardar', 'btn btn-primary', NULL, 1),
('IM', 'Imprimir', 'imprimir();', '', '<i class=\"fas fa-print\"></i>', '', 'btn btn-success', NULL, NULL),
('NU', 'Nuevo', 'window.location=\'url\';', '', '<i class=\"fa fa-plus\"></i>', 'btnNuevo', 'btn btn-primary', NULL, NULL),
('PD', 'Descargar PDF', 'window.location=\'url\';', 'generar/pdf', '<i class=\"fas fa-file-pdf\"></i>', '', 'btn btn-danger', NULL, NULL),
('RE', 'Rechazar', 'rechazar();', '', '<i class=\"far fa-trash-alt\"></i>', '', 'btn btn-danger', NULL, NULL),
('SR', 'Consultar', 'consultarFecha();', '', '<i class=\"fas fa-search\"></i>', '', 'btn btn-info', '<form id=\"Datos\" method=\"post\" action=\"<?=$_SERVER[\'REQUEST_URI\']?>\"><input type=\"text\" id=\"datepicker\"><input type=\"hidden\" name=\"fhFechaConsulta\" id=\"datepicker1\"></form>', NULL),
('VA', NULL, 'activarValidacion();', '', '<i class=\"fa fa-key\" ></i>', 'btnValidar', 'btn btn-primary', '<input type=\"password\" class=\"form-control col-md-3\" onkeyup=\"validarUsuario()\"  id=\"tPasswordOperaciones\"  style=\"display:none;\" size=\"8\">', NULL),
('XL', 'Descargar XLS', 'window.location=\'url\';', 'exportar/xls', '<i class=\"fas fa-file-excel\"></i>', '', 'btn btn-success', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisLogs`
--

CREATE TABLE `SisLogs` (
  `eCodEvento` int(11) NOT NULL,
  `eCodUsuario` int(11) NOT NULL,
  `fhFecha` datetime NOT NULL,
  `tDescripcion` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisPerfiles`
--

CREATE TABLE `SisPerfiles` (
  `eCodPerfil` int(11) NOT NULL,
  `tNombre` varchar(15) DEFAULT NULL,
  `tCodEstatus` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisPerfiles`
--

INSERT INTO `SisPerfiles` (`eCodPerfil`, `tNombre`, `tCodEstatus`) VALUES
(1, 'Administrador', 'AC'),
(2, 'Ventas', 'AC'),
(3, 'Pagos', 'AC'),
(4, 'Clientes', 'AC'),
(5, '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSecciones`
--

CREATE TABLE `SisSecciones` (
  `tCodSeccion` varchar(20) NOT NULL,
  `tCodPadre` varchar(20) DEFAULT NULL,
  `tDirectorio` varchar(5) DEFAULT NULL,
  `tTitulo` varchar(60) DEFAULT NULL,
  `eCodEstatus` int(11) DEFAULT NULL,
  `ePosicion` int(11) DEFAULT NULL,
  `bFiltro` int(11) NOT NULL,
  `tIcono` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSecciones`
--

INSERT INTO `SisSecciones` (`tCodSeccion`, `tCodPadre`, `tDirectorio`, `tTitulo`, `eCodEstatus`, `ePosicion`, `bFiltro`, `tIcono`) VALUES
('cata-ped-con', 'inicio', 'ped', 'Pedidos', 3, 2, 0, 'fa fa-file-text-o'),
('cata-ped-det', 'cata-ped-con', 'ped', 'Detalles de Pedidos', 3, 1, 0, 'fa fa-file-text-o'),
('cata-per-reg', 'cata-per-sis', 'cof', '+ Perfiles', 3, 2, 0, 'fa fa-file-text-o'),
('cata-per-sis', 'inicio', 'cof', 'Perfiles', 3, 3, 0, 'fa fa-file-text-o'),
('cata-pro-con', 'inicio', 'pro', 'Productos', 3, 1, 0, 'fa fa-file-text-o'),
('cata-pro-det', 'cata-pro-con', 'pro', 'Detalles de Producto', 3, 3, 0, 'fa fa-file-text-o'),
('cata-pro-reg', 'cata-pro-con', 'pro', '+ Productos', 3, 2, 0, 'fa fa-file-text-o'),
('cata-usr-reg', 'cata-usr-sis', 'cof', '+ Usuarios', 3, 1, 0, 'fa fa-file-text-o'),
('cata-usr-sis', 'inicio', 'cof', 'Usuarios', 3, 4, 0, 'fa fa-file-text-o'),
('inicio', NULL, NULL, 'Inicio', 3, 1, 1, 'fa-tachometer-alt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesBotones`
--

CREATE TABLE `SisSeccionesBotones` (
  `eCodRegistro` int(11) NOT NULL,
  `tCodPadre` varchar(15) DEFAULT NULL,
  `tCodSeccion` varchar(15) DEFAULT NULL,
  `tCodBoton` varchar(2) DEFAULT NULL,
  `tFuncion` varchar(25) DEFAULT NULL,
  `tEtiqueta` varchar(30) DEFAULT NULL,
  `ePosicion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSeccionesBotones`
--

INSERT INTO `SisSeccionesBotones` (`eCodRegistro`, `tCodPadre`, `tCodSeccion`, `tCodBoton`, `tFuncion`, `tEtiqueta`, `ePosicion`) VALUES
(1, 'cata-usr-sis', 'cata-usr-reg', 'NU', NULL, 'Nuevo', 1),
(2, 'cata-per-reg', 'cata-per-reg', 'VA', NULL, NULL, 1),
(3, 'cata-per-reg', 'cata-per-reg', 'GU', 'guardar();', NULL, 2),
(4, 'cata-per-reg', 'sis-per-con', 'CO', NULL, NULL, 3),
(5, 'cata-usr-reg', 'cata-usr-reg', 'VA', NULL, NULL, 1),
(6, 'cata-usr-reg', 'cata-usr-reg', 'GU', NULL, NULL, 2),
(7, 'cata-usr-reg', 'sis-usr-con', 'CO', NULL, NULL, 3),
(8, 'cata-pro-con', 'cata-pro-reg', 'NU', NULL, 'Nuevo', 1),
(9, 'cata-pro-reg', 'cata-pro-reg', 'VA', NULL, NULL, 1),
(10, 'cata-pro-reg', 'cata-pro-reg', 'GU', 'guardar();', NULL, 2),
(11, 'cata-pro-reg', 'cata-pro-con', 'CO', NULL, NULL, 3),
(12, 'cata-per-sis', 'cata-per-reg', 'NU', NULL, 'Nuevo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesMenusEmergentes`
--

CREATE TABLE `SisSeccionesMenusEmergentes` (
  `eCodMenuEmergente` int(11) NOT NULL,
  `tCodPadre` varchar(20) DEFAULT NULL,
  `tCodSeccion` varchar(20) DEFAULT NULL,
  `tCodPermiso` char(1) NOT NULL,
  `tTitulo` varchar(30) NOT NULL,
  `tAccion` varchar(25) DEFAULT NULL,
  `tFuncion` varchar(50) DEFAULT NULL,
  `tValor` varchar(20) DEFAULT NULL,
  `ePosicion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSeccionesMenusEmergentes`
--

INSERT INTO `SisSeccionesMenusEmergentes` (`eCodMenuEmergente`, `tCodPadre`, `tCodSeccion`, `tCodPermiso`, `tTitulo`, `tAccion`, `tFuncion`, `tValor`, `ePosicion`) VALUES
(1, 'cata-usr-sis', 'cata-usr-reg', 'A', 'Editar', 'editar', 'window.location=\'url\';', 'editar', 1),
(2, 'cata-per-sis', 'cata-per-reg', 'A', 'Editar', 'editar', 'window.location=\'url\';', 'editar', 1),
(3, 'cata-pro-con', 'cata-pro-reg', 'A', 'Editar', 'editar', 'window.location=\'url\';', 'editar', 1),
(4, 'cata-ped-con', 'cata-ped-det', 'A', 'Detalles', 'detalles', 'window.location=\'url\';', 'detalles', 1),
(5, 'inicio', 'cata-ped-det', 'A', 'Detalles', 'detalles', 'window.location=\'url\';', 'detalles', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesPerfiles`
--

CREATE TABLE `SisSeccionesPerfiles` (
  `eCodPerfil` int(11) DEFAULT NULL,
  `tCodSeccion` varchar(15) DEFAULT NULL,
  `bAll` int(11) DEFAULT NULL,
  `bDelete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSeccionesPerfiles`
--

INSERT INTO `SisSeccionesPerfiles` (`eCodPerfil`, `tCodSeccion`, `bAll`, `bDelete`) VALUES
(1, 'inicio', 1, 1),
(1, 'sis-bod-con', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesPerfilesInicio`
--

CREATE TABLE `SisSeccionesPerfilesInicio` (
  `eCodPerfil` int(11) NOT NULL,
  `tCodSeccion` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `SisSeccionesPerfilesInicio`
--

INSERT INTO `SisSeccionesPerfilesInicio` (`eCodPerfil`, `tCodSeccion`) VALUES
(1, 'inicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisSeccionesReemplazos`
--

CREATE TABLE `SisSeccionesReemplazos` (
  `eCodReemplazo` int(11) NOT NULL,
  `tBase` varchar(4) NOT NULL,
  `tNombre` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisSeccionesReemplazos`
--

INSERT INTO `SisSeccionesReemplazos` (`eCodReemplazo`, `tBase`, `tNombre`) VALUES
(1, 'cata', 'catalogo'),
(2, 'oper', 'operaciones'),
(3, 'reg', 'registrar'),
(4, 'inv', 'inventario'),
(5, 'usr', 'usuario'),
(6, 'sis', 'sistema'),
(7, 'bod', 'bodega'),
(8, 'ser', 'paquetes'),
(9, 'per', 'perfiles'),
(10, 'con', 'consultar'),
(11, 'dash', 'dashboard'),
(12, 'eve', 'eventos'),
(13, 'noti', 'notificaciones'),
(14, 'det', 'detalles'),
(15, 'del', 'eliminar'),
(16, 'log', 'logs'),
(17, 'tra', 'transacciones'),
(18, 'cit', 'citas'),
(19, 'gen', 'generar'),
(20, 'xls', 'excel'),
(21, 'pdf', 'pdf'),
(22, 'ren', 'rentas'),
(23, 'cli', 'clientes'),
(24, 'reg', 'editar'),
(25, 'xls', 'xls'),
(26, 'cot', 'crear'),
(27, 'cot', 'editar-cotizacion'),
(28, 'pro', 'productos'),
(29, 'ped', 'pedidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisUsuarios`
--

CREATE TABLE `SisUsuarios` (
  `eCodUsuario` int(11) NOT NULL,
  `eCodEntidad` int(11) DEFAULT NULL,
  `tNombre` varchar(50) DEFAULT NULL,
  `tApellidos` varchar(50) DEFAULT NULL,
  `tCorreo` varchar(100) DEFAULT NULL,
  `tPasswordAcceso` varchar(60) DEFAULT NULL,
  `tPasswordOperaciones` varchar(60) DEFAULT NULL,
  `fhFechaCreacion` datetime DEFAULT NULL,
  `eCodEstatus` int(11) DEFAULT NULL,
  `eCodPerfil` int(11) DEFAULT NULL,
  `bAll` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisUsuarios`
--

INSERT INTO `SisUsuarios` (`eCodUsuario`, `eCodEntidad`, `tNombre`, `tApellidos`, `tCorreo`, `tPasswordAcceso`, `tPasswordOperaciones`, `fhFechaCreacion`, `eCodEstatus`, `eCodPerfil`, `bAll`) VALUES
(1, NULL, 'Mario Ernesto', 'Basurto Medrano', 'babec.soluciones@gmail.com', 'MjgwMjkx', 'MjgwMjkx', '2018-07-29 00:00:00', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SisVariables`
--

CREATE TABLE `SisVariables` (
  `eCodVariable` int(11) NOT NULL,
  `tNombre` varchar(50) NOT NULL,
  `tValor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `SisVariables`
--

INSERT INTO `SisVariables` (`eCodVariable`, `tNombre`, `tValor`) VALUES
(1, 'tURL', 'http://localhost/');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `BitPedidos`
--
ALTER TABLE `BitPedidos`
  ADD PRIMARY KEY (`eCodPedido`);

--
-- Indices de la tabla `BitTransacciones`
--
ALTER TABLE `BitTransacciones`
  ADD PRIMARY KEY (`eCodTransaccion`);

--
-- Indices de la tabla `CatClientes`
--
ALTER TABLE `CatClientes`
  ADD PRIMARY KEY (`eCodCliente`),
  ADD KEY `cliente_rel_estatus_fk_idx` (`eCodEstatus`);

--
-- Indices de la tabla `CatEstatus`
--
ALTER TABLE `CatEstatus`
  ADD PRIMARY KEY (`eCodEstatus`),
  ADD UNIQUE KEY `tCodEstatus_UNIQUE` (`tCodEstatus`);

--
-- Indices de la tabla `CatEtapas`
--
ALTER TABLE `CatEtapas`
  ADD PRIMARY KEY (`eCodEtapa`);

--
-- Indices de la tabla `CatProductos`
--
ALTER TABLE `CatProductos`
  ADD PRIMARY KEY (`eCodProducto`);

--
-- Indices de la tabla `CatTiposPagos`
--
ALTER TABLE `CatTiposPagos`
  ADD PRIMARY KEY (`eCodTipoPago`);

--
-- Indices de la tabla `RelPedidosProductos`
--
ALTER TABLE `RelPedidosProductos`
  ADD PRIMARY KEY (`eCodRegistro`);

--
-- Indices de la tabla `RelPedidosProductosArchivos`
--
ALTER TABLE `RelPedidosProductosArchivos`
  ADD PRIMARY KEY (`eCodArchivo`);

--
-- Indices de la tabla `RelPedidosSeguimiento`
--
ALTER TABLE `RelPedidosSeguimiento`
  ADD PRIMARY KEY (`eCodRegistro`);

--
-- Indices de la tabla `SisBotones`
--
ALTER TABLE `SisBotones`
  ADD PRIMARY KEY (`tCodBoton`);

--
-- Indices de la tabla `SisLogs`
--
ALTER TABLE `SisLogs`
  ADD PRIMARY KEY (`eCodEvento`);

--
-- Indices de la tabla `SisPerfiles`
--
ALTER TABLE `SisPerfiles`
  ADD PRIMARY KEY (`eCodPerfil`);

--
-- Indices de la tabla `SisSecciones`
--
ALTER TABLE `SisSecciones`
  ADD PRIMARY KEY (`tCodSeccion`);

--
-- Indices de la tabla `SisSeccionesBotones`
--
ALTER TABLE `SisSeccionesBotones`
  ADD PRIMARY KEY (`eCodRegistro`),
  ADD KEY `tCodPadre_rel_fk_botones_idx` (`tCodPadre`),
  ADD KEY `tCodBoton_rel_fk_botones_idx` (`tCodBoton`);

--
-- Indices de la tabla `SisSeccionesMenusEmergentes`
--
ALTER TABLE `SisSeccionesMenusEmergentes`
  ADD PRIMARY KEY (`eCodMenuEmergente`);

--
-- Indices de la tabla `SisSeccionesPerfiles`
--
ALTER TABLE `SisSeccionesPerfiles`
  ADD KEY `perfil_rel_seccion_fk_idx` (`eCodPerfil`),
  ADD KEY `seccion_rel_perfil_idx` (`tCodSeccion`);

--
-- Indices de la tabla `SisSeccionesReemplazos`
--
ALTER TABLE `SisSeccionesReemplazos`
  ADD PRIMARY KEY (`eCodReemplazo`);

--
-- Indices de la tabla `SisUsuarios`
--
ALTER TABLE `SisUsuarios`
  ADD PRIMARY KEY (`eCodUsuario`),
  ADD KEY `SisUsuarios_rel_perfiles_fk_idx` (`eCodPerfil`),
  ADD KEY `CatEstatus_rel_usuarios_fk_idx` (`eCodEstatus`);

--
-- Indices de la tabla `SisVariables`
--
ALTER TABLE `SisVariables`
  ADD PRIMARY KEY (`eCodVariable`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `BitPedidos`
--
ALTER TABLE `BitPedidos`
  MODIFY `eCodPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `BitTransacciones`
--
ALTER TABLE `BitTransacciones`
  MODIFY `eCodTransaccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CatClientes`
--
ALTER TABLE `CatClientes`
  MODIFY `eCodCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `CatEstatus`
--
ALTER TABLE `CatEstatus`
  MODIFY `eCodEstatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `CatEtapas`
--
ALTER TABLE `CatEtapas`
  MODIFY `eCodEtapa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `CatProductos`
--
ALTER TABLE `CatProductos`
  MODIFY `eCodProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `CatTiposPagos`
--
ALTER TABLE `CatTiposPagos`
  MODIFY `eCodTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `RelPedidosProductos`
--
ALTER TABLE `RelPedidosProductos`
  MODIFY `eCodRegistro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `RelPedidosProductosArchivos`
--
ALTER TABLE `RelPedidosProductosArchivos`
  MODIFY `eCodArchivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `RelPedidosSeguimiento`
--
ALTER TABLE `RelPedidosSeguimiento`
  MODIFY `eCodRegistro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `SisLogs`
--
ALTER TABLE `SisLogs`
  MODIFY `eCodEvento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `SisPerfiles`
--
ALTER TABLE `SisPerfiles`
  MODIFY `eCodPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `SisSeccionesBotones`
--
ALTER TABLE `SisSeccionesBotones`
  MODIFY `eCodRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `SisSeccionesMenusEmergentes`
--
ALTER TABLE `SisSeccionesMenusEmergentes`
  MODIFY `eCodMenuEmergente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `SisSeccionesReemplazos`
--
ALTER TABLE `SisSeccionesReemplazos`
  MODIFY `eCodReemplazo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `SisUsuarios`
--
ALTER TABLE `SisUsuarios`
  MODIFY `eCodUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `SisVariables`
--
ALTER TABLE `SisVariables`
  MODIFY `eCodVariable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `SisSeccionesBotones`
--
ALTER TABLE `SisSeccionesBotones`
  ADD CONSTRAINT `tCodBoton_rel_fk_botones` FOREIGN KEY (`tCodBoton`) REFERENCES `SisBotones` (`tCodBoton`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tCodPadre_rel_fk_botones` FOREIGN KEY (`tCodPadre`) REFERENCES `SisSecciones` (`tCodSeccion`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
