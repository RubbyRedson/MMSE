-- Table: public.roles

-- DROP TABLE public.roles;

CREATE TABLE public.roles
(
    id integer NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
    title character varying(255) COLLATE "default".pg_catalog NOT NULL,
    description character varying(255) COLLATE "default".pg_catalog NOT NULL,
    auth integer NOT NULL,
    CONSTRAINT roles_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.roles
    OWNER to postgres;