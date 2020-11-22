create table posts
(
    id      serial                              not null,
    creator varchar(100)                        not null,
    path    varchar(200)                        not null,
    times   timestamp default CURRENT_TIMESTAMP not null
);

alter table posts
    owner to php_test;

INSERT INTO public.posts (id, creator, path, times) VALUES (1, '123@123', '51q3jGWbneL._AC_UX385_.jpg', '2020-11-21 14:58:00.838434');
INSERT INTO public.posts (id, creator, path, times) VALUES (2, '123@122', 'a.jpg', '2020-11-21 14:58:00.838434');