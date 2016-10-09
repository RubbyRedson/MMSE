-- Table: public.users

-- DROP TABLE public.users;

CREATE TABLE public.users
(
    id integer NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    username character varying(255) COLLATE "default".pg_catalog NOT NULL,
    password character varying(255) COLLATE "default".pg_catalog NOT NULL,
    role integer,
    CONSTRAINT users_pkey PRIMARY KEY (id),
    CONSTRAINT "roleFK" FOREIGN KEY (role)
        REFERENCES public.roles (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.users
    OWNER to postgres;

-- Index: fki_roleFK

-- DROP INDEX public."fki_roleFK";

CREATE INDEX "fki_roleFK"
    ON public.users USING btree
    (role)
    TABLESPACE pg_default;