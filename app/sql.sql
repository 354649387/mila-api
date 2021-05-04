CREATE TABLE `category`(
    `id` INT (10) UNSIGNED AUTO_INCREMENT NOT NULL COMMENT '栏目id',
    `name` VARCHAR (255) NOT NULL DEFAULT '' COMMENT '栏目名称',
    `pid` INT (10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父栏目id',
    PRIMARY KEY (id)
)

CREATE TABLE `article`(

    `id` INT(10) UNSIGNED AUTO_INCREMENT NOT NULL COMMENT '文章id',
    `title` VARCHAR(255) NOT NULL COMMENT '文章标题',
    `keyword` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '文章关键字',
    `desc` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '文章描述',
    `content` MEDIUMTEXT NOT NULL COMMENT '文章内容',
    `category_id` INT(10) UNSIGNED NOT NULL COMMENt '栏目id',
    `img` VARCHAR(255) NOT NULL COMMENT '缩略图',
    `created_at` TIMESTAMP NULL DEFAULT NULL COMMENT '创建时间',
    `updated_at` TIMESTAMP NULL DEFAULT NULL COMMENT '更新时间',
    `status` int(10) NOT NULL DEFAULT '1' COMMENT '状态  1为正常',
    PRIMARY KEY (id)

)
