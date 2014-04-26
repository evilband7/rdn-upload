Upload container adapter service locator
========================================

The `RdnUpload\Adapter\AdapterManager` service locator contains all upload adapters ready to be consumed by the upload container service. Adapters are any class that implements `RdnUpload\Adapter\AdapterInterface`.

## Configuration

The `rdn_upload_adapters` configuration option is used to configure the service locator.

~~~php
<?php

return array(
	'rdn_upload_adapters' => array(
		'factories' => array(),
		'invokables' => array(),
	),
);
~~~

## Local

A local filesystem adapter is provided with the module. This module uses the following configuration by default:

~~~php
<?php

return array(
	'rdn_upload_adapters' => array(
		'configs' => array(
			'Local' => array(
				'upload_path' => 'data/uploads',
				'public_path' => '/files',
			),
		),
	),
);
~~~

The `upload_path` configuration option is where uploaded files are placed, relative to the project root. Create this directory in your project root and give PHP write permissions to it via `setfacl` or `chmod`.

The `public_path` configuration option is prepended to uploaded files when generating the object's public URL. This option is also passed through the `basePath()` view helper. Symlink the `upload_path` to this location in your project's `public/` directory.

Your project root should look something like this:

~~~bash
<project_root>
 |-- config/
 |-- data/
 |    |-- cache/
 |    `-- uploads/
 |-- module/
 `-- public/
      |-- files -> ../data/uploads
      `-- index.php
~~~

## Gaufrette

This adapter will allow you to use a [Gaufrette](https://github.com/KnpLabs/Gaufrette) filesystem with any kind of adapter (local, amazon, openstack, etc.).

~~~php
<?php

return array(
	'rdn_upload_adapters' => array(
		'configs' => array(
			'Gaufrette' => array(
				'filesystem' => 'My\GaufretteService',
				'public_path' => '/files',
			),
		),
	),

	'service_manager' => array(
		'factories' => array(
			'My\GaufretteService' => function()
			{
				$adapter = new Gaufrette\Adapter\Local('data/uploads');
				return new Gaufrette\Filesystem($adapter);
			},
		),
	),
);
~~~

The `filesystem` configuration option is the name of a service that will return a Gaufrette filesystem object.

The `public_path` configuration option is prepended to uploaded files when generating the object's public URL.
