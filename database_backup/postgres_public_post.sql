create table post
(
    id      integer                             not null,
    is_like boolean                             not null,
    by      varchar(100)                        not null,
    message varchar(1000),
    times   timestamp default CURRENT_TIMESTAMP not null,
    id_post serial                              not null
);

alter table post
    owner to php_test;

create unique index post_id_post_uindex
    on post (id_post);

INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (1, false, '123@123', '123213', '2020-11-21 22:32:18.106116', 26);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (1, false, '123@123', '123123', '2020-11-21 22:32:19.887343', 27);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (1, false, '1@1', 'asd', '2020-11-21 22:37:04.063949', 28);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (2, false, '1@1', 'second img', '2020-11-22 18:37:58.722035', 29);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (1, true, '1@1', null, '2020-11-22 19:39:17.682276', 39);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (3, true, '123@123', null, '2020-11-22 19:41:58.369332', 41);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (2, true, '123@123', null, '2020-11-22 19:58:34.715276', 54);
INSERT INTO public.post (id, is_like, by, message, times, id_post) VALUES (1, true, '123@123', null, '2020-11-22 19:58:36.741969', 55);