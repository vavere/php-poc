# ZIB dockerizētas izstrādes vides demo

Noslēgtas ZIB izstrādes vides demo variants

## Komponetes

Demo sastāv no 6 komponetēm, 2 datu mapēm un 2 tīkliem

### 1. queue

Izstrādes rabbitmq serveris.
Atrodas _back_ tīklā.

Iebūvēts _health check_ lai _sender_ un _receiver_ startētu tikai tad kad rabbitmq ir pieejams.

### 2. mariadb

mariadb datu bāze.
Atrodas _back_ tīklā.

### 3. php-fpm

php Process Manager nodrošina php izpildi ar FastCGI.
Atrodas gan _front_ gan _back_ tīklā.

### 4. proxy

nginx reverse proxy.
Atrodas _front_ tīklā.

__Vienīgā uz āru pieejmā komponente, ports 80__

### 5. sender

php kods ar nelielu aizturi sūta uz _rabbitmq_ rindu ziņojumus.
Atrods _back_ tīklā.

### 6. reader

php kods  lasa ziņojumus no _rabbitmq_ rindas un ar nelielu aizturi tos apstiprina.
Atrods _back_ tīklā.

__Tiek palaists 3 eksemplāros__





