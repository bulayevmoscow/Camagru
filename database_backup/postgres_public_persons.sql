create table persons
(
    id        serial not null,
    firstname varchar(100),
    lastname  varchar(100),
    age       integer
);

alter table persons
    owner to kupsyloc;

INSERT INTO public.persons (id, firstname, lastname, age) VALUES (1, 'Bane', 'kek', 19);
INSERT INTO public.persons (id, firstname, lastname, age) VALUES (2, 'Bane', 'kek', 19);
INSERT INTO public.persons (id, firstname, lastname, age) VALUES (3, 'Bane', 'kek', 99);