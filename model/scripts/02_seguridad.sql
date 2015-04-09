--
-- core
--

CREATE TABLE _bp_roles(
	id_rol serial PRIMARY KEY,
	rol text NOT NULL,
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_roles (rol, _id_usuario, _estado) VALUES ('Super Usuario', 1, 'A');


CREATE TABLE _bp_grupos(
	id_grupo serial PRIMARY KEY,
	grupo text NOT NULL,
	imagen text DEFAULT '',
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_grupos (grupo, imagen, _id_usuario, _estado) VALUES ('ACCESO', '', 1, 'A');
INSERT INTO _bp_grupos (grupo, imagen, _id_usuario, _estado) VALUES ('SEGURIDAD', '', 1, 'A');
INSERT INTO _bp_grupos (grupo, imagen, _id_usuario, _estado) VALUES ('GENERAL', '', 1, 'A');
--
-- grillas de ejemplo
--
INSERT INTO _bp_grupos (grupo, imagen, _id_usuario, _estado) VALUES ('GRILLAS', '', 1, 'A');


CREATE TABLE _bp_opciones(
	id_opcion serial PRIMARY KEY,
	id_grupo integer NOT NULL,
	opcion text NOT NULL,
	contenido text DEFAULT '',
	adicional text DEFAULT '',
	orden integer NOT NULL,
	imagen text DEFAULT '',
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (1, 'Admin. Grupos', 'app_lite/Grupos/', '', 10, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (1, 'Admin. Opciones', 'app_lite/Opciones/', '', 20, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (1, 'Admin. Accesos (Menú)', 'app_lite/Accesos/', '', 30, '', 1, 'A');

INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (2, 'Admin. Roles', 'app_lite/Roles/', '', 20, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (2, 'Admin. Usuarios', 'app_lite/Usuarios/', '', 30, '', 1, 'A');

INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (2, 'Admin. Usuarios - Roles', 'app_lite/Usuarios_Roles/', '', 40, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (2, 'Cambiar Clave (falta)', '/', '', 50, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (2, 'Admin. Usuarios - IP (falta)', '/', '', 60, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (2, 'Reporte Accesos al Sistema (falta)', '/', '', 70, '', 1, 'A');

INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (3, 'Admin. Personas', 'app_lite/Personas/', '', 10, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (3, 'Admin. Ubicaciones Geográficas', 'app_lite/UbicacionesGeograficas/', '', 20, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (3, 'Admin. Ubicaciones Orgánicas', 'app_lite/UbicacionesOrganicas/', '', 30, '', 1, 'A');

--
-- grillas de ejemplo
--
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (4, 'Usuarios', '../administracion/usuarios.html', '', 10, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (4, 'Personas', '../administracion/personas.html', '', 20, '', 1, 'A');
INSERT INTO _bp_opciones (id_grupo, opcion, contenido, adicional, orden, imagen, _id_usuario, _estado) VALUES (4, 'Roles', '../administracion/roles.html', '', 30, '', 1, 'A');



CREATE TABLE _bp_accesos(
	id_acceso serial PRIMARY KEY,
	id_opcion integer NOT NULL,
	id_rol integer NOT NULL,
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (1, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (2, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (3, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (4, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (5, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (6, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (7, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (8, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (9, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (10, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (11, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (12, 1, 1, 'A');
--
-- grillas de ejemplo
--
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (13, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (14, 1, 1, 'A');
INSERT INTO _bp_accesos (id_opcion, id_rol, _id_usuario, _estado) VALUES (15, 1, 1, 'A');

CREATE TABLE _bp_estados_civiles (
	id_estado_civil serial PRIMARY KEY,
	estado_civil text not null,
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_estados_civiles (estado_civil, _id_usuario, _estado) VALUES ('Soltero/a', 1, 'A');
INSERT INTO _bp_estados_civiles (estado_civil, _id_usuario, _estado) VALUES ('Casado/a', 1, 'A');
INSERT INTO _bp_estados_civiles (estado_civil, _id_usuario, _estado) VALUES ('Divorciado/a', 1, 'A');
INSERT INTO _bp_estados_civiles (estado_civil, _id_usuario, _estado) VALUES ('Viudo/a', 1, 'A');
INSERT INTO _bp_estados_civiles (estado_civil, _id_usuario, _estado) VALUES ('Persona Jurídica', 1, 'A');


CREATE TABLE _bp_personas (
	id_persona serial PRIMARY KEY,
	id_estado_civil integer NOT NULL,
	id_archivo_cv integer,
	ci text NOT NULL,
	nombres text NOT NULL,
	paterno text NOT NULL,
	materno text NOT NULL,
	direccion text NOT NULL,
	direccion2 text DEFAULT '',
	telefono text DEFAULT '',
	telefono2 text DEFAULT '',
	celular text DEFAULT '',
	empresa_telefonica text DEFAULT '',
	correo text DEFAULT '',
	sexo char(1) DEFAULT 'F',
	fec_nacimiento date NOT NULL,
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_personas (id_estado_civil, id_archivo_cv, ci, nombres, paterno, materno, direccion, direccion2, telefono, telefono2, celular, empresa_telefonica, correo, sexo, fec_nacimiento, _id_usuario, _estado) VALUES (1, 0, 1, 'Administrador', 'Admin', 'Admin', '', '', '', '', '', '', '', 'M', '2015-01-01', 1, 'A');


CREATE TABLE _bp_usuarios (
	id_usuario serial PRIMARY KEY,
	id_persona integer NOT NULL DEFAULT '1',
	usuario text NOT NULL,
	clave text NOT NULL,
	controlar_ip char(1) NOT NULL DEFAULT 'S',
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_usuarios (id_persona, usuario, clave, controlar_ip, _id_usuario, _estado) VALUES ( 1, 'admin', 'admin', 'N', 1, 'A');


CREATE TABLE _bp_logs_usuarios (
	id_log_usuario serial PRIMARY KEY,
	id_usuario integer NOT NULL,
	ip text NOT NULL,
	tipo char(1) NOT NULL,
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);


CREATE TABLE _bp_usuarios_roles (
	id_usuario_rol serial PRIMARY KEY,
	id_usuario integer NOT NULL,
	id_rol integer NOT NULL,
	_registrado date NOT NULL,
	_modificado timestamp NOT NULL DEFAULT now(),
	_id_usuario integer NOT NULL,
	_estado char(1) NOT NULL DEFAULT 'A'
);

INSERT INTO _bp_usuarios_roles (id_usuario, id_rol, _id_usuario, _estado) VALUES (1, 1, 1, 'A');


