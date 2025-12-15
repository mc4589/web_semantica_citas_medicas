# README.md - Proyecto: Aplicación de Web Semántica (JSON-LD) en API REST con Laravel

## Resumen del Proyecto

Este proyecto consiste en la implementación de **Web Semántica** mediante el formato **JSON-LD** en una **API REST** desarrollada con el framework **Laravel**. El tema elegido es un **sistema de gestión de citas médicas**, con los modelos principales: `Cita`, `Médico`, `Paciente` y `Especialidad`.

La actividad cumple con los requisitos obligatorios (integración de JSON-LD en todos los modelos y respuestas de API) y añade un valor agregado opcional para obtener **2 puntos extras**: una **aplicación web interactiva** (HTML + JavaScript vanilla + Fetch API) que consume la propia API REST, mostrando dinámicamente los datos y las respuestas JSON-LD sin necesidad de herramientas externas como Postman.

* **Fecha de entrega**: 16 de diciembre de 2025  
* **Framework**: Laravel 12.x  
* **Tecnologías adicionales**: Vite, JavaScript (ES6), CSS personalizado

## Conceptos Teóricos

### Web Semántica
La Web Semántica es una extensión de la Web actual propuesta por Tim Berners-Lee, cuyo objetivo es que la información tenga un significado bien definido para que las máquinas (computadoras e IA) puedan procesarla y razonar con ella de manera más eficaz. En lugar de presentar datos solo para humanos, se enfoca en hacerlos comprensibles para sistemas automatizados.

### JSON-LD (JSON for Linking Data)
JSON-LD es un formato ligero para representar datos vinculados basado en JSON. Permite incrustar metadatos semánticos directamente en objetos JSON utilizando vocabularios estándar como **Schema.org**.

Claves principales:
* `@context`: Define el vocabulario utilizado (en este proyecto: `http://schema.org`).
* `@type`: Indica el tipo de entidad según el vocabulario (ej. `Physician`, `Patient`, `MedicalAppointment`, `MedicalSpecialty`).
* Propiedades semánticas: Se utilizan términos estándar (ej. `name`, `telephone`, `medicalSpecialty`) en lugar de nombres internos de la base de datos.

### Beneficios en este proyecto
* Las respuestas de la API incluyen tanto los datos crudos como un objeto `json_ld` semántico.
* En las vistas web se inyecta JSON-LD mediante `<script type="application/ld+json">` para mejorar el SEO y la indexación por crawlers (Google, Bing).
* La aplicación interactiva demuestra consumo real máquina-a-máquina de datos semánticos.

