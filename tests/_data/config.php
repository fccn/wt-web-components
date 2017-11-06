<?php

//common vars to be used on file
$fs_root = __DIR__; //point to the project root folder

//the configuration array - make sure it is called $c
$c = array(
  "install_path"    => $fs_root,
#------ logfile configuration
  'logfile_path' => __DIR__."/../_output/logs/test.log",
  'logfile_level' => "DEBUG",

#---- External libraries loader --------------------
  "ext_libs" => array(
    "my_lib" => __DIR__."/vendor/test/lib.js"
  ),
);
