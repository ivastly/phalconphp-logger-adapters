![wtfpl](http://www.wtfpl.net/wp-content/uploads/2012/12/wtfpl-badge-4.png)
# phalconphp-logger-adapters

This repo contains a canonical demo implementation of an Adapter for standard logger of PhalconPHP framework. 
Consider it more like a Proof Of Concept, than a production-ready code. Contributions are more than welcome (see ![CONTRIBUTE.md](CONTRIBUTE.md)) 

Tested with PhalconPHP version 3.2.4

# Requirements
* php >= 7.0
* phalconPHP >= 3.2.4

# How to use
Just install via composer
```bash
composer require biganfa/phalconphp-logger-adapters
```

And configure your Phalcon's built-in logger appropriately
```php
//somewhere in services.php

$di->setShared('logger', function() use($config) {

   $logger = new \Phalcon\Logger\Multiple();
   $logger->push(new LogglyAdapter(new LogglyClient()));
   $logger->push(new TelegramAdapter(new TelegramClient()));
}
```

# What is included
* [Telegram](https://core.telegram.org/) Telegram logger adapter for PhalconHPP
* [Loggly](http://logg.ly) Loggly logger adapter for PhalconPHP

# LICENSE information
see ![LICENSE.md](LICENSE.md)
