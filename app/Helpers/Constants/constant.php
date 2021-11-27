<?php

if (!defined('DEFINE_CONSTANT')) {
    define('DEFINE_CONSTANT', 'DEFINE_CONSTANT');

    define('PAGE_SIZE', 20);
    define('FORM_INPUT_MAX_LENGTH', 255);

    /**
     * List roles of application
     */
    define('SUPER_ADMIN_ROLE', 0); //Supper Admin - No identifier needed in table user_roles
    define('ADMIN_ROLE', 1); // Admin of Organization
    define('USER_ROLE', 5); // Normal user
}
