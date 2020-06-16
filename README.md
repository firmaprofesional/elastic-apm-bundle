# Elastic APM Bundle
The package was originally created by Burak Bolat (@goksagun). This is a fork of the latest.

Our goals with this fork are:
* improve doc
* add exclusions on translations

# Installation


### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require firmaprofesional/elastic-apm-bundle
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require firmaprofesional/elastic-apm-bundle
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new FP\ElasticApmBundle\ElasticApmBundle(),
        ];

        // ...
    }

    // ...
}
```

#### Step 3: Add the Bundle config file

Then, add the bundle configuration yml file `elastic_apm.yml` into 
`app/config` directory:

```yml
elastic_apm:
    enabled: true
    appName: 'raplus' #Name of this application, Required
    serverUrl: 'https://a59dc3e8594447f388925d220e41230e.apm.eu-west-1.aws.cloud.es.io/' #APM Server Endpoint, Default: 'http://127.0.0.1:8200'
    secretToken: 'KeZHykP8nsRi8bJ0QH' #Secret token for APM Server, Default: null
    transactions:
        enabled: true
        exclude:
            - web_profiler.controller.profiler::toolbarAction
            - web_profiler.controller.profiler::panelAction
    errors:
        enabled: true
```

Import new config file to `config.yml` into `app/config` directory:

```yml
imports:
    ...
    - { resource: elastic_apm.yml }
```
