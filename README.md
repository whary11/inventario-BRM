## David Raga Renteria

# BRM_test
En el archivo <strong> modelo_datos.jpeg </strong> se evidencia el modelo de base de datos que realicé para afrontar esta prueba

Instalar las dependencias
*     npm install
*     composer install

Configurar el <strong>.env</strong> con la informacion de la base de datos

ejecutar las migraciones
*     php artisan migrate:refresh
El sistema consta de varias partes

## menú Basicos:
### sub Menú: nuevo producto 
en este se crearan los productos

### <strong>sub Menú: proveer producto: </strong> 
en este cada proveedor surtira de productos al sistema
#### Nota: cabe resaltar que los basicos son indeispensables para que funcione el resto del software

## menú comprar:
En está parte es donde se realizará la venta del producto al cliente

## menú consultar:

### <strong>sub Menú: Historial de facturas: </strong> 
en este se muestra el historial de las facturas, aquí se puede cancelar una factura y generar un pdf con la factura
