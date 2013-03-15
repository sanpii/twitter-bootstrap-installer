# Twitter bootstrap installer

## Installation

In your composer project:

    $ composer require 'sanpi/twitter-bootstrap-installer *@dev'

And append this configuration in `composer.json`:

    "scripts": {
        "post-install-cmd": "Sanpi\\TwitterBootstrap\\Composer\\ScriptHandler::postInstall",
        "post-update-cmd": "Sanpi\\TwitterBootstrap\\Composer\\ScriptHandler::postUpdate"
    },
    "extra": {
        "symfony-web-dir": "web"
    }
