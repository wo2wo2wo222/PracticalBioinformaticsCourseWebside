### PracticalBioinformaticsCourse_WebsideCode
This is a simple webside project with using html, css, boostrap,  js,  jquery, ajax, php, mysql to build. 


整个项目是课堂作业的第一部分，在这个版本中主要完成了课堂作业1的要求，建立了展示页面；功能页面；搜索页面，通过ajax连接到后端php再连接到数据库，进行查找数据的操作；通过管理页面，可以向数据库中插入数据；对于没有完成的页面有提示信息。

## Homework Readme
代码中默认运行的是本地数据库，数据内容在"LoadData.csv"中，创建表格的命令如下：
(```)
CREATE TABLE `homework1_test`.`experiment_meta_final` ( 
`File_accession` VARCHAR(50) , 
`File_assembly` VARCHAR(10) NOT NULL , 
`Experiment_accession` VARCHAR(50) NOT NULL , 
`Biosample_term_name` VARCHAR(50) NOT NULL , 
`Biosample_type` VARCHAR(50) NOT NULL , 
`Biosample_organism` VARCHAR(20) NOT NULL , 
`Experiment_target` VARCHAR(20) NOT NULL , 
`Experiment_date_released` VARCHAR(15) NOT NULL , 
`Project` VARCHAR(10) NOT NULL , 
`File_download_URL` TEXT NOT NULL , 
PRIMARY KEY (`File_accession`)) ENGINE = InnoDB;
(```)


## **课堂作业总体设想：**
Homework （HW） 1、2、3构成了这学期要完成的一个完整项目， 即：通过对多组学数据的整合分析来回答你感兴趣的生物学问题。比如“在精子发生中转录因子如何通过调控染色质结构和基因表达来进一步调控减数分裂的进程？”
这个项目的主要目标是建立一个由后台数据库驱动的网站，能够来查询和展示所存储的你感兴趣的基因家族的功能和多组学信息。

**Homework1的具体要求：**
  你必须建立项目网站。
  你必须建立后台数据库，并且利用数据库的数据驱动网站内容的动态更新。
  你必须用一个后台或网页版的php或R程序进行数据库的内容更新。
  你必须提供一个查询数据库的网页。
  你必须介绍：数据来源、数据有多少条记录、来自哪些物种。

**Homework2的具体要求：**
  这个项目的主要目标是建立一个由后台数据库驱动的网站，能够用来查询和展示所存储 的你感兴趣的基因家族的功能和表达信息。不言而喻，后台数据库的建立涉及到基因注 释信息的获得和存储（Homework 1）以及基因表达数据的获得、分析、存储（Homework 2）。
  在网站上提供利用 blast 查询序列数据；
  对查询出来的数据提供更新和删除功能；
  找到一个你选择的某一类基因（蛋白质）的一个 RNA-seq 表达数据集，利用所学的技 能计算出表达值并存储到数据库里；
  在查询出某个基因（蛋白质）后，利用其表达数据动态做出表达图（plot）。

