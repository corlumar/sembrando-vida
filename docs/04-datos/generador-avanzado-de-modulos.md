# DEV-004 - Generador Avanzado de Módulos

## Objetivo

Desarrollar un generador de módulos para el ERP Framework que permita crear una estructura completa siguiendo la arquitectura modular establecida.

## Comando

```bash
php artisan erp:make-module NombreModulo
```

## Resultado esperado

El comando generará automáticamente:

- Domain
- Application
- Infrastructure
- Presentation
- Providers
- Config
- Policies
- Tests
- module.json
- README.md

## Beneficios

- Uniformidad en todos los módulos.
- Menor tiempo de desarrollo.
- Arquitectura consistente.
- Facilita el mantenimiento.