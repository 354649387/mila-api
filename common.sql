/**
管理员表
 */
CREATE TABLE `admin` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员id',
    `username` varchar(255) NOT NULL COMMENT '用户名',
    `password` varchar(32) NOT NULL COMMENT '密码',
    `nickname` varchar(255) NOT NULL COMMENT '昵称',
    `created_at` timestamp NULL COMMENT '创建时间',
    `updated_at` timestamp NULL COMMENT '更新时间',
    `deleted_at` timestamp NULL COMMENT '删除时间',
    `last_login_time` timestamp NULL COMMENT '最后登录时间',
    `status` tinyint(10) NOT NULL DEFAULT 0 COMMENT '状态 0：正常 1：非正常',
    PRIMARY KEY (`id`)
)

/**
路由规则表
 */
CREATE TABLE `rule` (
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '路由组id',
    `desc` varchar(255) COMMENT '路由描述',
    `created_at` timestamp NULL COMMENT '创建时间',
    `updated_at` timestamp NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
)

/**
角色表
 */
CREATE TABLE role(
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色id',
    `name` varchar(255) NOT NULL DEFAULT '' COMMENT '角色名称',
    `rules` varchar(255) NOT NULL DEFAULT '' COMMENT '可执行的路由规则id，多个用逗号隔开',
    `created_at` timestamp NULL COMMENT '创建时间',
    `updated_at` timestamp NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
)


/**
管理员对应角色表
 */

CREATE TABLE admin_role(
    `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '管理员对应角色表id',
    `admin_id` int(10) COMMENT '管理员id',
    `role_id` int(10) COMMENT '角色id',
    `created_at` timestamp NULL COMMENT '创建时间',
    `updated_at` timestamp NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
)
