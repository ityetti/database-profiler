ITYetti Database Profiler
=====================

Description
-----------
This extension shows sql queries and execution time in simple table view. You can see which of the SQL process take a lot of time and optimize your code.

Compatibility
-------------
- Magento v2.4.1 (Should work on previous versions. Not tested)

Installation Instructions
-------------------------
1. `composer require ityetti/database-profiler`
2. Open project config file `app/etc/env.php` and add profiler class to your configuration:
```
   'db' => [
        'connection' => [
            'default' => [
                'profiler' => [
                    'class' => '\Magento\Framework\DB\Profiler',
                    'enabled' => true
                ]
            ]
        ]
    ]
```
3. `bin/magento module:enable ITYetti_DatabaseProfiler`
4. `bin/magento setup:upgrade`
5. Go to Admin - Store - Configuration - ITYetti - Database Profiler
6. `Enable On Frontend` - Yes
6. `Enable On Backend` - Yes

![Database Profiler](![alt text](https://github.com/ityetti/database-profiler/blob/main/database-profiler.png?raw=true))

Uninstallation
--------------
1. `composer remove ityetti/database-profiler`

Support
-------
If you have any issues with this extension, open an issue on [GitHub](https://github.com/ityetti/database-profiler/issues).

Contribution
------------
Any contribution is highly appreciated. The best way to contribute code is to open a [pull request on GitHub](https://github.com/ityetti/database-profiler/pulls).

Developer
---------
Oleksii Borovyk  
[https://github.com/ityetti](https://github.com/ityetti)

License
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)
