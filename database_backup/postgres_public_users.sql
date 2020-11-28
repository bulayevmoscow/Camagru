create table users
(
    id            serial       not null,
    login         varchar(100) not null,
    password      varchar(100) not null,
    register_date date,
    email_check   boolean,
    email_message varchar(100)
);

comment on table users is 'table of users';

alter table users
    owner to kupsyloc;

INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (57, '2@2', '$2y$10$9O23hjGGN7ZxNx3JGClE1euoW.erUAp8xFvgKBJtdBC/H7V8ekPPa', '2020-11-20', false, '0');
INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (59, '1@3', '$2y$10$PmLNQouGl3qvKqlZ2EslgevOnEuK7.Af.V3mrWtpc.DUCDFWJqjIS', '2020-11-20', true, '29872');
INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (56, '123@123', '$2y$10$qK7iTicXPb7XBQnHhQm9m.wTWbzoEC/4Kg40reCM8WR/TZrceJl56', '2020-11-20', false, '0');
INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (60, '1@4', '$2y$10$2lY3T8Q1aP/GmfBG9iW8OOIUQGq/bMJlO0xji3Qtvwk./f5WH.G1a', '2020-11-21', false, '0');
INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (55, '1@1', '$2y$10$dKdEW1Z/iyBqk/mSMOF/7efWrHxa3F89AItYFYlATmDHYy4sxK9Ji', '2020-11-20', false, '0');
INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (61, '4@4', '$2y$10$XYv37OCvUtC/cyJtlDxB6e1v4BBlJ2F76SzJXHjJ2dneCiWc3c4Eq', '2020-11-22', false, '0');
INSERT INTO public.users (id, login, password, register_date, email_check, email_message)
VALUES (58, '1@2', '$2y$10$g7k2y/vtLOnJCJpCnBAcrOB3hab8QbYz/QiOrlFw5bTEx9Bd1Moyy', '2020-11-20', true, '0');