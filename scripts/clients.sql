-- Table: public.clients

-- DROP TABLE public.clients;

CREATE TABLE public.clients
(
    id integer NOT NULL DEFAULT nextval('clients_id_seq'::regclass),
    name character varying(255) COLLATE "default".pg_catalog NOT NULL,
    phone character varying(255) COLLATE "default".pg_catalog NOT NULL,
    discount integer NOT NULL,
    CONSTRAINT clients_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.clients
    OWNER to postgres;