<?php

//common vars to be used on file
$fs_root = __DIR__; //point to the project root folder

//the configuration array - make sure it is called $c
$c = array(
  "install_path"    => $fs_root,
  "base_path" => "",
#------ logfile configuration
  'logfile_path' => __DIR__."/../_output/logs/test.log",
  'logfile_level' => "DEBUG",

#----- locale configuration
  "defaultLocale"      => "pt_PT",
  "defaultLocaleLabel" => "PT",

  "locales"            => array(
                              array("label" => "GB", "locale" => "en_GB", "flag_alt" => "English flag", "language" => "English"),
                              array("label" => "PT", "locale" => "pt_PT", "flag_alt" => "Portuguese flag", "language" => "Português"),
                              # add other languages here....
                            ),

  "locale_textdomain"  => "messages",
  "locale_path"        => __DIR__."/locale",
  "locale_cookie_name" => "locale",
  #twig parser locations
  "twig_parser_templates_path" => __DIR__."/templates",
  "twig_parser_cache_path" => __DIR__."/cache",

#---- External libraries loader --------------------
  "ext_libs_loader_service_name" => 'loader',

  "ext_libs" => array(
    "my_lib" => __DIR__."/vendor/test/lib.js"
  ),

#---- Slim Middleware loader --------------------

  "slim_middlewares" => array(
    "my_test_middleware" => new \Fccn\Tests\MyMiddleware(),
   ),

);
