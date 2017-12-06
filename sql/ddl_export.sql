--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.10
-- Dumped by pg_dump version 9.5.10

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: escom_sseis; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE escom_sseis WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';


ALTER DATABASE escom_sseis OWNER TO postgres;

\connect escom_sseis

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: asistencia_evento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE asistencia_evento (
    tipo text NOT NULL,
    boleta text NOT NULL,
    asiste boolean DEFAULT false,
    num_acompanantes integer DEFAULT 0,
    encuesta_realizada boolean DEFAULT false
);


ALTER TABLE asistencia_evento OWNER TO postgres;

--
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rol (
    tipo character varying(10) NOT NULL
);


ALTER TABLE rol OWNER TO postgres;

--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    nom_usuario text NOT NULL,
    nom text,
    ap text,
    am text,
    contrasena text NOT NULL,
    rol_usuario character varying(10),
    email text NOT NULL,
    activo boolean DEFAULT true NOT NULL,
    num_intentos integer DEFAULT 0
);


ALTER TABLE usuario OWNER TO postgres;

--
-- Data for Name: asistencia_evento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY asistencia_evento (tipo, boleta, asiste, num_acompanantes, encuesta_realizada) FROM stdin;
generacion	2016630123	f	0	f
\.


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rol (tipo) FROM stdin;
alumno
admin
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (nom_usuario, nom, ap, am, contrasena, rol_usuario, email, activo, num_intentos) FROM stdin;
2016529434	Linus	Brown	Sanchez	password	alumno	correoejemplo@alumno.ipn.mx	t	0
2016630123	Alberto	Moreno	Gutierrez	password	alumno	correoejemplo@alumno.ipn.mx	t	0
becas2017	Miguel	Hernandez	Santiago	123	admin	becas@escom.ipn.mx	t	0
\.


--
-- Name: pk_asistencia_evento; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asistencia_evento
    ADD CONSTRAINT pk_asistencia_evento PRIMARY KEY (tipo, boleta);


--
-- Name: pk_rol; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT pk_rol PRIMARY KEY (tipo);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (nom_usuario);


--
-- Name: fk_alumno; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asistencia_evento
    ADD CONSTRAINT fk_alumno FOREIGN KEY (boleta) REFERENCES usuario(nom_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_rol; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_rol FOREIGN KEY (rol_usuario) REFERENCES rol(tipo) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

