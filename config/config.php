<?php

define('BASE_URL', 'http://localhost/payroll_management/');
define('SITE_NAME', 'Payroll Management System');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Authentication settings
define('AUTH_SALT', 'your_random_salt_here');
define('SESSION_TIMEOUT', 1800); // 30 minutes

// Pagination
define('ITEMS_PER_PAGE', 20);