insert into ecs_shop_config(code, type, parent_id, store_range, store_dir, value) values('kjb2c_id', 'text', '1', '', '',  '');
insert into ecs_shop_config(code, type, parent_id, store_range, store_dir, value) values('kjb2c_secret', 'text', '1', '', '',  '');

alter table ecs_users add kjb2c_binded tinyint(1) unsigned not null default '0', add key kjb2c_binded(kjb2c_binded);


insert into ecs_shop_config(code, type, parent_id, store_range, store_dir, value) values('kjb2c_custom_code', 'text', '1', '', '',  '');
insert into ecs_shop_config(code, type, parent_id, store_range, store_dir, value) values('kjb2c_org_name', 'text', '1', '', '',  '');

alter table ecs_order_info add kjb2c_sent tinyint(1) unsigned not null default '0' comment '是否已经发送到外贸', add key kjb2c_sent(kjb2c_sent);


drop table if exists ecs_tbl;
CREATE TABLE if not exists ecs_tbl (
  id mediumint(8) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (id)
)engine=MyISAM default charset=utf8;