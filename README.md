# Webapp tools - web components

This presents a collection of web components to integrate with the [FCCN's webapp skeleton](https://github.com/fccn/webapp-skeleton.git) project. The following components are provided:

- External libraries loader - loads external javascript libraries installed by composer and npm.

## Installation

You can install this collection in your project using composer:
```
composer require fccn/webapp-tools-web-components

```

## Configuration

The site configuration loader from the [Webapp Tools - common](https://github.com/fccn/wt-common) project is used to centralize the configuration of each of component. You need to add a specific set of key-value pairs to the site configuration file, as described in the sections below.

Some of the web components provide twig views to render HTML content. All the twig template files are located in the **templates** folder. To load them in your project you need to register a twig namespace for this directory. When integrating with the [FCCN's webapp skeleton project](https://github.com/fccn/webapp-skeleton.git) you need to add the following line to the *templates_path* variable in the site configuration:
```
$templates_path =  array(
  ...
  'web_components' => $fs_root.'/vendor/fccn/webapp-tools/web-components/templates' #add this line
  ...
  );
```

### External libraries loader

For cleaner paths it is advised to create variables for the node modules and vendor folders in the configuration file:
```php
 $node_mods_path = $fs_root.'/node_modules/';
 $vendor_path = $fs_root.'/vendor/';

```
You can than add the following key-value pairs to the config file's *$c* array:
```php
//---- External libraries loader --------------------
"ext_libs" => array(
  //add libraries with the format name => path like for example:
  "headjs" => $node_mods_path."/headjs/dist/1.0.0/head.min.js",

  );


```


## Usage
