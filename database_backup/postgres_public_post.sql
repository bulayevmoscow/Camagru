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

INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (1, false, '123@123', '123213', '2020-11-21 22:32:18.106116', 26);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (1, false, '123@123', '123123', '2020-11-21 22:32:19.887343', 27);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (1, false, '1@1', 'asd', '2020-11-21 22:37:04.063949', 28);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, false, '1@1', 'second img', '2020-11-22 18:37:58.722035', 29);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (1, true, '1@1', null, '2020-11-22 19:39:17.682276', 39);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (3, true, '123@123', null, '2020-11-22 19:41:58.369332', 41);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (1, true, '123@123', null, '2020-11-22 20:23:56.035503', 56);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (1, true, '4@4', null, '2020-11-22 20:24:27.594769', 57);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, false, '4@4', 'kek', '2020-11-22 20:26:24.494537', 58);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, false, '4@4', 'sadsd', '2020-11-22 20:26:28.632358', 59);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, false, '4@4', 'asdasd', '2020-11-22 20:26:31.769544', 60);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, true, '4@4', null, '2020-11-22 20:42:28.275422', 61);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, false, '123@123', '1', '2020-11-23 19:04:55.201354', 94);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, false, '2@2', 'fsdfsdf', '2020-11-24 22:57:57.091058', 97);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, true, '2@2', null, '2020-11-25 18:58:59.936052', 100);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (2, true, '123@123', null, '2020-11-27 22:43:54.035969', 101);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (31, true, '1@1', null, '2020-11-28 22:01:50.215106', 103);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (32, true, '1@1', null, '2020-11-28 22:01:52.305286', 104);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (32, true, '123@123', null, '2020-11-28 22:02:12.866048', 105);
INSERT INTO public.post (id, is_like, by, message, times, id_post)
VALUES (31, true, '123@123', null, '2020-11-28 22:02:14.287175', 106);