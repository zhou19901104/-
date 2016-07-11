insert into ch_category values(null,'PHP',0,0);

insert into ch_category values(null,'PHP基础',1,1);
insert into ch_category values(null,'PHP进阶',1,1);
insert into ch_category values(null,'PHP常见问题',1,1);
insert into ch_category values(null,'PHP社区',1,1);




insert into ch_category values(null,'Linux',0,0);

insert into ch_category values(null,'linux基础命令',2,1);
insert into ch_category values(null,'lamp安装',2,1);
insert into ch_category values(null,'lamp问题',2,1);
insert into ch_category values(null,'lnmp安装',2,1);
insert into ch_category values(null,'lnmp问题',2,1);

insert into ch_category values(null,'Apache',0,0);

insert into ch_category values(null,'Apache下载',3,1);
insert into ch_category values(null,'Apache常见问题',3,1);


insert into ch_category values(null,'DB',0,0);

insert into ch_category values(null,'Mysql',4,1);
insert into ch_category values(null,'DB2',4,1);
insert into ch_category values(null,'Oracle',4,1);
insert into ch_category values(null,'Access',4,1);
insert into ch_category values(null,'SqlServer',4,1);

insert into ch_category values(null,'ThinkPHP',0,0);

insert into ch_category values(null,'ThinkPHP基础',5,1);
insert into ch_category values(null,'ThinkPHP小案例',5,1);
insert into ch_category values(null,'ThinkPHP实用操作',5,1);
insert into ch_category values(null,'ThinkPHP社区',5,1);

insert into ch_category values(null,'Yii',0,0);

insert into ch_category values(null,'Yii基础',6,1);
insert into ch_category values(null,'Yii小案例',6,1);
insert into ch_category values(null,'Yii实用操作',6,1);
insert into ch_category values(null,'Yii中文社区',6,1);

insert into ch_category values(null,'Laravel',0,0);

insert into ch_category values(null,'laravel基础',7,1);
insert into ch_category values(null,'laravel视频分享',7,1);
insert into ch_category values(null,'laravel社区',7,1);


insert into ch_category values(null,'Echarts',0,0);
insert into ch_category values(null,'echarts实用分享',8,1);
insert into ch_category values(null,'echarts',8,1);

insert into ch_category values(null,'友情链接',0,0);

insert into ch_category values(null,'百度一下',9,1);
insert into ch_category values(null,'新浪首页',9,1);

<div id="addBox" style="display:none;">保存成功</div>
点击添加后显示，过一段时间后隐藏
$("$addBox").show();
setTimeout($("$addBox").hide(),3000)