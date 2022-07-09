Для добавления приложения:
1) Можно сделать это командой git/clone https://github.com/werewolfs1/App-Parse.git ;
2) Либо скачать архив;

Конфигурация приложения сервера должна соответствовать:
1) HTTP - Apache_2.4-PHP_7.2-7.4;
2) PHP - PHP_7.2
3) MySQL-8.0-Win 10

Определить свои данные MySQL можно в файле result.PHP
Есть возможность Импортировать настроенную таблицу из папки SQLTable

Настройка свой таблицы

1) id->INT->UNSIGNED->PRIMARY->АВТОИНКРЕМЕНИТИРОВАНИЕ
2) articul->VARCHAR(255)
3) product_name->VARCHAR(255)->NULL
4) price->VARCHAR(255)->NULL
5) remains>VARCHAR(255)->NULL
