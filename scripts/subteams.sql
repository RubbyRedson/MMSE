-- Table: public.subteams

-- DROP TABLE public.subteams;

CREATE TABLE public.subteams
(
    id integer NOT NULL DEFAULT nextval('subteams_id_seq'::regclass),
    name character varying(255) COLLATE "default".pg_catalog NOT NULL,
    description character varying(255) COLLATE "default".pg_catalog NOT NULL,
    "numberofpeople" integer NOT NULL,
    CONSTRAINT subteams_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.subteams
    OWNER to postgres;