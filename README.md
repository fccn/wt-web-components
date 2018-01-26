# Webapp tools - web components

This presents a collection of web components to integrate with the [FCCN's webapp skeleton](https://github.com/fccn/webapp-skeleton.git) project. The following components are provided:

- External libraries loader - loads external javascript libraries installed by composer and npm.
- Language Switcher Action - Controller action for switching the site language

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
"ext_libs_loader_service_name" => 'loader',  #name of the loader service in Slim container
"ext_libs" => array(
  //add libraries with the format name => path like for example:
  "headjs" => $node_mods_path."/headjs/dist/1.0.0/head.min.js",

  );
```

The example below shows how to create a new Slim service for the external library loader

```php

$app = new Slim\App();
$c = $app->container();

//setup ext libs loader
$cnt_name = \Fccn\Lib\SiteConfig::getInstance()->get('ext_libs_loader_service_name');
$c[$cnt_name] = function($cnt){
  $loader = \Fccn\WebComponents\ExtLibsLoader::getInstance();
  return $loader;
}
```

You can associate a URL path for loading external libraries using the provided controller action - LoadExternalJSAction. The example below shows how to set the *<site-url>/script/lib/{libname}* path to the action controller:

```php

$app = new Slim\App();

#set route for load library action
$app->get('/script/lib/{libname}', Fccn\WebComponents\LoadExternalJsAction::class);

```

## Usage

### External libraries loader

To load the external library just point to the URL you have configured in the Slim routes with the name of the library.

## Testing

This project uses codeception for testing. To run the tests call ``composer test`` on the root of the project folder.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fccn/wt-translate/tags).

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
