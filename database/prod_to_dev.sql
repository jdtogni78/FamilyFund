-- Active: 1736629003981@@127.0.0.1@3306@familyfund_dev

update accounts set email_cc = SUBSTR(email_cc, 1, INSTR(email_cc, '@') - 1);
update accounts set email_cc = concat(email_cc, '@dstrader.com');

-- restore pw
update users set password = '$2y$10$pQnyQtnYUDe5JObhrKQJkOjFyCHUagUJEItv6iNykfXU/K5Dsg4YC' where email = 'jdtogni@gmail.com';

select * from accounts;

