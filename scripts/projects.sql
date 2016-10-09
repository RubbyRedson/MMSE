-- Table: public.projects

-- DROP TABLE public.projects;

CREATE TABLE public.projects
(
    id integer NOT NULL DEFAULT nextval('projects_id_seq'::regclass),
    name character varying(255) COLLATE "default".pg_catalog NOT NULL,
    description character varying(255) COLLATE "default".pg_catalog NOT NULL,
    cost integer NOT NULL,
    start date NOT NULL,
    stop date NOT NULL,
    client integer NOT NULL,
    CONSTRAINT projects_pkey PRIMARY KEY (id),
    CONSTRAINT "clientFK" FOREIGN KEY (client)
        REFERENCES public.clients (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.projects
    OWNER to postgres;

-- Index: fki_clientFK

-- DROP INDEX public."fki_clientFK";

CREATE INDEX "fki_clientFK"
    ON public.projects USING btree
    (client)
    TABLESPACE pg_default;