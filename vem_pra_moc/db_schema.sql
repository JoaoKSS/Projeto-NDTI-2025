-- Tabela de Usuários 
CREATE TABLE Usuario (
    id SERIAL PRIMARY KEY, 
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo_usuario VARCHAR(20) NOT NULL CHECK (tipo_usuario IN ('Atendente', 'Medico', 'Cliente', 'Administrador')),
    data_cadastro TIMESTAMP WITH TIME ZONE DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Administradores 
CREATE TABLE Administrador (
    id_administrador INT PRIMARY KEY REFERENCES Usuario(id) ON DELETE CASCADE
);

-- Tabela de Recepcionistas 
CREATE TABLE Recepcionista (
    id_recepcionista INT PRIMARY KEY REFERENCES Usuario(id) ON DELETE CASCADE
);

-- Tabela de Pacientes 
CREATE TABLE Paciente (
    id SERIAL PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL,
    sexo CHAR(1) CHECK (sexo IN ('M', 'F', 'O')),
    rua VARCHAR(255) NOT NULL,
    numero VARCHAR(10) NOT NULL,
    complemento VARCHAR(255),
    bairro VARCHAR(50) NOT NULL,
    cidade VARCHAR(50) NOT NULL,
    estado CHAR(2) NOT NULL,
    cep CHAR(9) NOT NULL,
    telefone_primario VARCHAR(15) NOT NULL,
    telefone_secundario VARCHAR(15),
    email VARCHAR(100) UNIQUE,
    cpf VARCHAR(11) UNIQUE NOT NULL,
    nome_emergencia VARCHAR(100),
    contato_emergencia VARCHAR(15),
    id_usuario INT UNIQUE REFERENCES Usuario(id) ON DELETE CASCADE 
);

-- Tabela de Histórico Médico 
CREATE TABLE HistoricoMedico (
    id SERIAL PRIMARY KEY,
    historico_cirurgias TEXT, 
    paciente_id INT NOT NULL REFERENCES Paciente(id) ON DELETE CASCADE 
);

-- Tabelas de Alergias, Doenças e Medicamentos 
CREATE TABLE Alergia ( 
    id SERIAL PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    historico_medico_id INT NOT NULL REFERENCES HistoricoMedico(id) ON DELETE CASCADE 
);

CREATE TABLE Doenca ( 
    id SERIAL PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    historico_medico_id INT NOT NULL REFERENCES HistoricoMedico(id) ON DELETE CASCADE 
);

CREATE TABLE Medicamento ( 
    id SERIAL PRIMARY KEY,
    nome_medicamento VARCHAR(255) NOT NULL, 
    historico_medico_id INT NOT NULL REFERENCES HistoricoMedico(id) ON DELETE CASCADE 
);

-- Tabela de Médicos 
CREATE TABLE Medico (
    id SERIAL PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    crm VARCHAR(20) UNIQUE NOT NULL,
    telefone_primario VARCHAR(15) NOT NULL,
    telefone_secundario VARCHAR(15),
    email VARCHAR(100) UNIQUE NOT NULL,
    horario_atendimento TEXT NOT NULL,
    id_usuario INT UNIQUE REFERENCES Usuario(id) ON DELETE CASCADE 
);

-- Tabela de Especialidades Médicas 
CREATE TABLE Especialidade (
    id SERIAL PRIMARY KEY,
    nome_especialidade VARCHAR(100) UNIQUE NOT NULL
);

-- Associação entre Médicos e Especialidades 
CREATE TABLE MedicoEspecialidade (
    medico_id INT NOT NULL,
    especialidade_id INT NOT NULL,
    CONSTRAINT PK_medico_especialidade PRIMARY KEY (medico_id, especialidade_id),
    CONSTRAINT FK_medico_especialidade_medico FOREIGN KEY (medico_id) REFERENCES Medico(id) ON DELETE CASCADE,
    CONSTRAINT FK_medico_especialidade_especialidade FOREIGN KEY (especialidade_id) REFERENCES Especialidade(id) ON DELETE CASCADE
);

-- Tabela de Consultas/Agendamentos 
CREATE TABLE Consulta (
    id SERIAL PRIMARY KEY,
    paciente_id INT NOT NULL REFERENCES Paciente(id) ON DELETE CASCADE,
    medico_id INT NOT NULL REFERENCES Medico(id) ON DELETE CASCADE,
    especialidade_id INT NOT NULL REFERENCES Especialidade(id) ON DELETE CASCADE,
    hora_consulta TIME NOT NULL, 
    status VARCHAR(20) DEFAULT 'Agendado' CHECK (status IN ('Agendado', 'Cancelado', 'Realizado')),
    disponibilidade_id INT NOT NULL REFERENCES DisponibilidadeHorario(id) ON DELETE CASCADE -- Relacionamento com disponibilidade
);

-- Tabela de Prontuário 
CREATE TABLE Prontuario (
    id SERIAL PRIMARY KEY,
    paciente_id INT NOT NULL REFERENCES Paciente(id) ON DELETE CASCADE,
    medico_id INT NOT NULL REFERENCES Medico(id) ON DELETE CASCADE,
    data_consulta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    diagnostico TEXT NOT NULL,
    prescricao TEXT,
    exames TEXT
);


-- Tabela de Disponibilidade de Horário para Médicos
CREATE TABLE DisponibilidadeHorario (
    id SERIAL PRIMARY KEY,
    medico_id INT NOT NULL REFERENCES Medico(id) ON DELETE CASCADE,
    dia_da_semana VARCHAR(9) NOT NULL CHECK (dia_da_semana IN ('Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado', 'Domingo')),
    horario_inicio TIME NOT NULL,
    horario_fim TIME NOT NULL,
    CONSTRAINT unique_dia_medico UNIQUE (medico_id, dia_da_semana)
);
