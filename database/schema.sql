CREATE DATABASE Barberflow;

CREATE TABLE barberia(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    descripcion TEXT,
    logo VARCHAR(255),
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE permisos(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_permiso VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE estados_cita(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE metodos_pago(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_metodo VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE estados_pago(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_estado VARCHAR(60) NOT NULL UNIQUE,
    descripcion TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE usuarios(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barberia_id BIGINT NOT NULL,
    rol_id BIGINT NOT NULL,
    nombre_usuario VARCHAR(40) NOT NULL,
    apellido_usuario VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password_hash TEXT NOT NULL,
    telefono VARCHAR(20),
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_usuarios_barberia_email UNIQUE(barberia_id, email),
    CONSTRAINT fk_usuarios_barberia_id FOREIGN KEY (barberia_id) references barberia(id),
    CONSTRAINT fk_usuarios_rol_id FOREIGN KEY (rol_id) references roles(id)
);

CREATE TABLE clientes(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barberia_id BIGINT NOT NULL,
    nombre_cliente VARCHAR(40) NOT NULL,
    apellido_cliente VARCHAR(50) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    fecha_nacimiento DATE,
    observaciones TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMPTZ NULL,
    CONSTRAINT fk_clientes_barberia_id FOREIGN KEY (barberia_id) references barberia(id)
);

CREATE TABLE categorias_servicio(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barberia_id BIGINT NOT NULL,
    nombre VARCHAR(60) NOT NULL,
    descripcion TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT fk_categorias_barberia_id FOREIGN KEY (barberia_id) references barberia(id)
);

CREATE TABLE barberos(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    usuario_id BIGINT NOT NULL,
    especialidad VARCHAR(50),
    biografia TEXT,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_barberos_usuario_id UNIQUE(usuario_id),
    CONSTRAINT fk_barberos_usuario_id FOREIGN KEY (usuario_id) references usuarios(id)
);

CREATE TABLE servicios(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barberia_id BIGINT NOT NULL,
    categorias_servicio_id BIGINT NOT NULL,
    nombre_servicio VARCHAR(50) NOT NULL,
    descripcion TEXT,
    precio NUMERIC(12,2) NOT NULL,
    duracion_minutos SMALLINT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_servicio_barberia_nombre_servicio UNIQUE(barberia_id, nombre_servicio),
    CONSTRAINT chk_servicio_precio CHECK(precio > 0),
    CONSTRAINT chk_servicio_duracion_minutos CHECK(duracion_minutos > 0 AND duracion_minutos % 5 = 0),
    CONSTRAINT fk_servicio_barberia_id FOREIGN KEY (barberia_id) references barberia(id),
    CONSTRAINT fk_servicio_categoria_servicio_id FOREIGN KEY (categorias_servicio_id) references categorias_servicio(id)
);

CREATE TABLE rol_permiso(
    rol_id BIGINT NOT NULL,
    permiso_id BIGINT NOT NULL,
    CONSTRAINT pk_rol_permiso PRIMARY KEY(rol_id, permiso_id),
    CONSTRAINT fk_rol_permiso_rol_id FOREIGN KEY (rol_id) REFERENCES roles(id),
    CONSTRAINT fk_rol_permiso_permiso_id FOREIGN KEY (permiso_id) REFERENCES permisos(id)
);

CREATE TABLE barbero_servicio(
    barbero_id BIGINT NOT NULL,
    servicio_id BIGINT NOT NULL,
    precio_personalizado NUMERIC(12,2),
    duracion_personalizada SMALLINT,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT fk_barbero_servicio_barbero_id FOREIGN KEY (barbero_id) references barberos(id),
    CONSTRAINT fk_barbero_servicio_servicio_id FOREIGN KEY (servicio_id) references servicios(id),
    CONSTRAINT uq_barbero_servicio UNIQUE (barbero_id, servicio_id),
    CONSTRAINT chk_barbero_servicio_precio CHECK(precio_personalizado IS NULL OR precio_personalizado > 0),
    CONSTRAINT chk_barbero_servicio_duracion_personalizada CHECK(duracion_personalizada IS NULL OR (duracion_personalizada > 0 AND duracion_personalizada % 5 = 0))
);

CREATE TABLE horarios_barbero(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barbero_id BIGINT NOT NULL,
    dia_semana SMALLINT NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_horario_barbero_barbero_id FOREIGN KEY(barbero_id) references barberos(id),
    CONSTRAINT chk_horarios_barbero_dia_semana CHECK(dia_semana BETWEEN 1 AND 7),
    CONSTRAINT chk_horarios_barbero_hora_inicio_hora_fin CHECK(hora_fin > hora_inicio)
);

CREATE TABLE bloqueos_horario(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barbero_id BIGINT NOT NULL,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    motivo VARCHAR(100) NOT NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_bloqueos_horario_barbero_id FOREIGN KEY (barbero_id) references barberos(id),
    CONSTRAINT chk_bloqueos_horario_hora_inicio_hora_fin CHECK(hora_fin > hora_inicio)
);

CREATE TABLE citas(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barberia_id BIGINT NOT NULL,
    cliente_id BIGINT NOT NULL,
    barbero_id BIGINT NOT NULL,
    estado_cita_id BIGINT NOT NULL,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    observaciones TEXT,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_citas_barberia_id FOREIGN KEY(barberia_id) references barberia(id),
    CONSTRAINT fk_citas_cliente_id FOREIGN KEY(cliente_id) references clientes(id),
    CONSTRAINT fk_citas_barbero_id FOREIGN KEY(barbero_id) references barberos(id),
    CONSTRAINT fk_citas_estado_cita FOREIGN KEY(estado_cita_id) references estados_cita(id),
    CONSTRAINT chk_citas_hora_inicio_hora_fin CHECK(hora_fin > hora_inicio)
);

CREATE TABLE cita_servicio(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cita_id BIGINT NOT NULL,
    servicio_id BIGINT NOT NULL,
    precio NUMERIC(12,2) NOT NULL,
    duracion_minutos SMALLINT NOT NULL,
    subtotal NUMERIC(12,2) NOT NULL,
    CONSTRAINT fk_cita_servicio_cita_id FOREIGN KEY(cita_id) references citas(id),
    CONSTRAINT fk_cita_servicio_servicio_id FOREIGN KEY(servicio_id) references servicios(id),
    CONSTRAINT uq_cita_servicio_cita_id_servicio_id UNIQUE(cita_id, servicio_id),
    CONSTRAINT chk_cita_servicio_precio CHECK(precio > 0),
    CONSTRAINT chk_cita_servicio_duracion_minutos CHECK(duracion_minutos > 0),
    CONSTRAINT chk_cita_servicio_subtotal CHECK(subtotal >= 0)
);

CREATE TABLE pagos(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    cita_id BIGINT NOT NULL,
    metodo_pago_id BIGINT NOT NULL,
    estado_pago_id BIGINT NOT NULL,
    monto NUMERIC(12,2) NOT NULL,
    fecha_pago TIMESTAMPTZ,
    referencia VARCHAR(30),
    observaciones TEXT,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_pagos_cita_id FOREIGN KEY(cita_id) references citas(id),
    CONSTRAINT fk_pagos_metodo_pago_id FOREIGN KEY(metodo_pago_id) references metodos_pago(id),
    CONSTRAINT fk_pagos_estado_pago_id FOREIGN KEY(estado_pago_id) references estados_pago(id),
    CONSTRAINT chk_pagos_monto CHECK(monto > 0)
);