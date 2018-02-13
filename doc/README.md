# Documentation

This documentation will guide you to generate CRUD elements for your application. Let's begin!

## This Fork

This fork was made by Matt Libera, UNCG ITS. It does a few things to extend the base package:
- _Minor:_ Changes stubs from using `url()` and fixed paths to instead use `route()` and named routes
- _Minor:_ Addresses an issue with HTML5 validation in some browsers when the number type is float (e.g. the package would correctly use a "number" field but not apply a "step" value to it, and so HTML5 validation would fail)
- _Major:_ Adds in a plethora of additional options to generate ACL items when generating your CRUD sets. This currently requires the `santigarcor/laratrust` package, as this scaffolding is based specifically on the way this package works.

**NOTE: This fork is designed for use with UNCG ITS's CCPS Core package. You may still be able to modify the stubs, etc., for use without this package but for the moment it's not supported officially.**

## Getting Started

1. [Installation](installation.md)
2. [Configuration](configuration.md)
3. [Usage](usage.md)
4. [Fields](fields.md)
5. [Options](options.md)
6. [Templates](templates.md)
