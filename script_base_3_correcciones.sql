-- ==============================================================
-- BASE DE DATOS SIGECH (PostgreSQL)
-- Versión con Estándares, Auditoría y Nombres de Constraints
-- Autor: Elías Pérez Saldaña
-- Fecha: Actualizado Noviembre 2025
-- ==============================================================

-- ==============================================================
-- TABLA: usuarios
-- ==============================================================
CREATE TABLE usuarios (
    id_usuario SERIAL,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contrasena_hash VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL,
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,
    CONSTRAINT PK_usuarios_id_usuario PRIMARY KEY (id_usuario),
    CONSTRAINT UQ_usuarios_correo UNIQUE (correo),
    CONSTRAINT CK_usuarios_rol CHECK (rol IN ('cliente', 'analista', 'admin'))
);

-- No FK a usuarios aquí porque la tabla usuarios es raíz.


-- ==============================================================
-- TABLA: solicitudes
-- ==============================================================
CREATE TABLE solicitudes (
    id_solicitud SERIAL,
    id_usuario_cliente INT NOT NULL,
    folio_unico VARCHAR(30) NOT NULL,
    estatus VARCHAR(20) NOT NULL,
    monto_solicitado DECIMAL(15,2),
    ingreso_declarado DECIMAL(15,2),
    observaciones TEXT,
    fecha_aprobacion TIMESTAMP,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_solicitudes_id_solicitud PRIMARY KEY (id_solicitud),
    CONSTRAINT UQ_solicitudes_folio_unico UNIQUE (folio_unico),
    CONSTRAINT CK_solicitudes_estatus 
        CHECK (estatus IN ('registrada', 'en_revision', 'aprobada', 'rechazada')),
    CONSTRAINT FK_solicitudes_usuario_cliente 
        FOREIGN KEY (id_usuario_cliente) REFERENCES usuarios(id_usuario),

    -- Auditoría FK
    CONSTRAINT FK_solicitudes_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_solicitudes_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- TABLA: documentos_solicitud
-- ==============================================================
CREATE TABLE documentos_solicitud (
    id_documento SERIAL,
    id_solicitud INT NOT NULL,
    nombre_archivo VARCHAR(150) NOT NULL,
    tipo_documento VARCHAR(50),
    ruta_almacenamiento VARCHAR(255),
    cifrado BOOLEAN DEFAULT TRUE,

    usuario_responsable INT,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_documentos_solicitud PRIMARY KEY (id_documento),
    CONSTRAINT FK_documentos_solicitud_id_solicitud 
        FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud) ON DELETE CASCADE,
    CONSTRAINT FK_documentos_solicitud_usuario_responsable 
        FOREIGN KEY (usuario_responsable) REFERENCES usuarios(id_usuario),

    -- Auditoría FK
    CONSTRAINT FK_documentos_solicitud_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_documentos_solicitud_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- TABLA: simulaciones_credito
-- ==============================================================
CREATE TABLE simulaciones_credito (
    id_simulacion SERIAL,
    id_solicitud INT NOT NULL,
    tasa DECIMAL(5,2) NOT NULL,
    plazo_meses INT NOT NULL,
    monto_autorizado DECIMAL(15,2) NOT NULL,
    fecha_calculo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_simulaciones_credito PRIMARY KEY (id_simulacion),
    CONSTRAINT CK_simulaciones_credito_plazo 
        CHECK (plazo_meses > 0),
    CONSTRAINT FK_simulaciones_credito_id_solicitud 
        FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud) ON DELETE CASCADE,

    -- Auditoría FK
    CONSTRAINT FK_simulaciones_credito_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_simulaciones_credito_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- TABLA: tabla_amortizacion
-- ==============================================================
CREATE TABLE tabla_amortizacion (
    id_amortizacion SERIAL,
    id_simulacion INT NOT NULL,
    numero_pago INT NOT NULL,
    fecha_pago DATE NOT NULL,
    capital DECIMAL(15,2) NOT NULL,
    interes DECIMAL(15,2) NOT NULL,
    saldo_restante DECIMAL(15,2) NOT NULL,

    usuario_responsable INT,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_tabla_amortizacion PRIMARY KEY (id_amortizacion),
    CONSTRAINT CK_tabla_amortizacion_numero_pago CHECK (numero_pago > 0),
    CONSTRAINT FK_tabla_amortizacion_id_simulacion 
        FOREIGN KEY (id_simulacion) REFERENCES simulaciones_credito(id_simulacion) ON DELETE CASCADE,
    CONSTRAINT FK_tabla_amortizacion_usuario_responsable 
        FOREIGN KEY (usuario_responsable) REFERENCES usuarios(id_usuario),

    -- Auditoría FK
    CONSTRAINT FK_tabla_amortizacion_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_tabla_amortizacion_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- TABLA: contratos
-- ==============================================================
CREATE TABLE contratos (
    id_contrato SERIAL,
    id_solicitud INT NOT NULL,
    ruta_contrato_generado VARCHAR(255),
    ruta_contrato_firmado VARCHAR(255),
    fecha_carga_cliente TIMESTAMP,
    aceptado BOOLEAN DEFAULT FALSE,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_contratos PRIMARY KEY (id_contrato),
    CONSTRAINT UQ_contratos_id_solicitud UNIQUE (id_solicitud),
    CONSTRAINT FK_contratos_id_solicitud 
        FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud) ON DELETE CASCADE,

    -- Auditoría FK
    CONSTRAINT FK_contratos_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_contratos_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- TABLA: pagos
-- ==============================================================
CREATE TABLE pagos (
    id_pago SERIAL,
    id_solicitud INT NOT NULL,
    fecha_pago DATE NOT NULL,
    monto_pagado DECIMAL(15,2) NOT NULL,
    capital_pagado DECIMAL(15,2),
    interes_pagado DECIMAL(15,2),
    saldo_posterior DECIMAL(15,2),

    usuario_responsable INT,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_pagos PRIMARY KEY (id_pago),
    CONSTRAINT FK_pagos_id_solicitud 
        FOREIGN KEY (id_solicitud) REFERENCES solicitudes(id_solicitud) ON DELETE CASCADE,
    CONSTRAINT FK_pagos_usuario_responsable 
        FOREIGN KEY (usuario_responsable) REFERENCES usuarios(id_usuario),

    -- Auditoría FK
    CONSTRAINT FK_pagos_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_pagos_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- TABLA: reportes_generados
-- ==============================================================
CREATE TABLE reportes_generados (
    id_reporte SERIAL,
    id_usuario INT NOT NULL,
    tipo_reporte VARCHAR(50),
    formato VARCHAR(10),
    ruta_archivo VARCHAR(255),
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Auditoría
    estado_registro VARCHAR(20) DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    creado_por INT,
    modificado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado_por INT,

    CONSTRAINT PK_reportes_generados PRIMARY KEY (id_reporte),
    CONSTRAINT CK_reportes_generados_formato CHECK (formato IN ('pdf', 'excel')),
    CONSTRAINT FK_reportes_generados_id_usuario 
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),

    -- Auditoría FK
    CONSTRAINT FK_reportes_generados_creado_por 
        FOREIGN KEY (creado_por) REFERENCES usuarios(id_usuario),
    CONSTRAINT FK_reportes_generados_modificado_por 
        FOREIGN KEY (modificado_por) REFERENCES usuarios(id_usuario)
);


-- ==============================================================
-- ÍNDICES
-- ==============================================================
CREATE INDEX idx_solicitudes_estatus ON solicitudes(estatus);
CREATE INDEX idx_pagos_fecha ON pagos(fecha_pago);
CREATE INDEX idx_reportes_fecha ON reportes_generados(fecha_reporte);


-- ==============================================================
-- VISTA
-- ==============================================================
CREATE VIEW vista_resumen_creditos AS
SELECT 
    s.id_solicitud,
    u.nombre AS cliente,
    s.estatus,
    s.monto_solicitado,
    s.monto_solicitado - COALESCE(SUM(p.monto_pagado), 0) AS saldo_actual
FROM solicitudes s
LEFT JOIN usuarios u ON s.id_usuario_cliente = u.id_usuario
LEFT JOIN pagos p ON s.id_solicitud = p.id_solicitud
GROUP BY s.id_solicitud, u.nombre, s.estatus, s.monto_solicitado;
