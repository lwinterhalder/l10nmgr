# Localization Manager

The Localization Manager (l10nmgr) is a localization management extension for TYPO3 supporting a variety of
online and offline translation workflows.

## Makefile
The extension comes with a Makefile to provide a unified interface for some developer related tasks.

Run `make` without any parameters to get the help which shows all available tasks:

```
$ make
 help                          List available tasks on this project
 lint                          Lints all PHP files of the project
 fix                           Adjust the code to the CGL via PHP-CS-Fixer
 stan                          Run PHPStan on the files
 stan-baseline                 Creates a new PHPStan baseline
 docs_render                   Render the documentation
 docs_serve                    Serve the rendered documentation
```
