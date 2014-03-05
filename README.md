# Twitter bootstrap installer

[![Build Status](http://ci.homecomputing.fr/twitter-bootstrap-installer/build/status)](http://ci.homecomputing.fr/twitter-bootstrap-installer)

## Installation

In your composer project:

    $ composer require sanpi/twitter-bootstrap-installer

And append this configuration in `composer.json`:

    "scripts": {
        "post-install-cmd": "Sanpi\\TwitterBootstrap\\Composer\\ScriptHandler::postInstall",
        "post-update-cmd": "Sanpi\\TwitterBootstrap\\Composer\\ScriptHandler::postUpdate"
    },
    "extra": {
        "symfony-web-dir": "web"
    }
