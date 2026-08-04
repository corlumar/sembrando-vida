# MEF - Modular ERP Framework

<p align="center">
  <img src="docs/assets/logo-mef.png" alt="MEF Logo" width="180">
</p>

<p align="center">

**Modular ERP Framework**

*Build enterprise applications with a modular architecture powered by Laravel.*

![Version](https://img.shields.io/badge/version-v0.2.0--alpha-blue)
![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4)
![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20)
![License](https://img.shields.io/badge/license-Proprietary-red)

</p>

---

# What is MEF?

**MEF (Modular ERP Framework)** is an enterprise application framework built on top of Laravel.

Its goal is to provide a solid foundation for developing scalable, modular, maintainable ERP systems using Domain-Driven Design, modular architecture and reusable business components.

Instead of building a single ERP, MEF provides the infrastructure to build many ERP solutions from the same framework.

---

# Vision

Create a modern, modular and extensible ERP Framework that allows organizations to rapidly develop enterprise software through reusable modules.

---

# Main Features

- Modular Architecture
- Automatic Module Discovery
- Module Registry
- Service Providers
- Dependency Injection
- Template Engine
- Builder System
- File System Abstractions
- JSON Manifest Engine
- CLI Tools
- PHPUnit Support
- Architecture Decision Records (ADR)

---

# Architecture

```
Applications
        │
        ▼

Business Modules
        │
        ▼

Platform Services
        │
        ▼

MEF Core
```

The Core never contains business logic.

Business functionality lives inside independent modules.

---

# Project Structure

```
app/

Core/
Platform/
Modules/

config/

docs/

templates/

tests/

artisan
```

---

# Current Components

## Core

- ERPKernel
- Module Registry
- Auto Discovery

## FileSystem

- DirectoryManager
- FileWriter
- JsonWriter
- StubWriter
- GitKeepGenerator

## Builders

- ModuleBuilder

---

# Installation

```bash
git clone https://github.com/corlumar/modular-erp-framework.git

cd modular-erp-framework

composer install

cp .env.example .env

php artisan key:generate
```

---

# Verify Installation

```bash
php artisan erp:status
```

(Currently `erp:*` commands are maintained for compatibility. They will evolve to `mef:*` in a future release.)

---

# Create your first module

```bash
php artisan erp:make-module CRM
```

Generated structure:

```
Modules/

CRM/

Application/
Domain/
Infrastructure/
Presentation/
Providers/
Tests/

module.json
README.md
```

---

# Development Workflow

Every contribution follows the same workflow.

```
Design

↓

Implementation

↓

Tests

↓

Documentation

↓

Commit
```

---

# Documentation

The documentation lives inside:

```
docs/
```

Main sections:

- Architecture
- ADR
- Development
- Roadmap
- Release Notes

---

# Roadmap

## v0.2

- Core
- Builders
- CLI

## v0.3

- Manifest Engine
- Registry Engine
- Dependency Resolver

## v0.4

- Event Bus
- Marketplace
- Installer

## v0.5

- Business Modules

## v1.0

Stable Framework

---

# Contributing

Every contribution should include:

- Tests
- Documentation
- PHPDoc
- Clean Architecture

Please read:

```
CONTRIBUTING.md
```

---

# License

Currently proprietary.

Future Open Source licensing is under evaluation.

---

# Author

**CorLumar**

MEF - Modular ERP Framework

2026