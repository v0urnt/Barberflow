CREATE DATABASE Barberflow;

CREATE TABLE barberia(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    descripcion TEXT,
    logo VARCHAR(255),
    estado BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    estado BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE permisos(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_permiso VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    estado BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE estados_cita(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    estado BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE metodos_pago(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_metodo VARCHAR(50) NOT NULL UNIQUE,
    descripcion TEXT,
    estado BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE estados_pago(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nombre_estado VARCHAR(60) NOT NULL UNIQUE,
    descripcion TEXT,
    estado BOOLEAN NOT NULL DEFAULT TRUE
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
    estado BOOLEAN NOT NULL DEFAULT TRUE,
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
    estado BOOLEAN NOT NULL DEFAULT TRUE,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMPTZ NULL,
    CONSTRAINT fk_clientes_barberia_id FOREIGN KEY (barberia_id) references barberia(id)
);

CREATE TABLE categorias_servicio(
    id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    barberia_id BIGINT NOT NULL,
)