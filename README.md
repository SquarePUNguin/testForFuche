# testForFuche

INDEX.html:'
главная страница на ней можно вывести список всех контактов(collector.php)
или отфильтровать контакты по ключевому слову(collector.php).
И перейти на страницы создания нового контакта и 
страницу одного контакта(при выводе всех или поиске нажать на контакт)'
connect.php:',
файл с двумя функциями 
1я функция connect() выводет новый объект класса mysli();
2я функция imageUPLOAD() пытеется сохранить изображение в папке "SERVER/notebook/PB_img/" в случае успеха выдаёт путь, в случае провала NULL.',
collector.php:'Файл выводящий контакты все или по ключевому слову.',
monoDISPLAY.php:'страница выводящая один контакт на ней можно отредактировать или удалить выведенный контакт.',
create.html:'страница создания нового контакта',
manipulator.php:'файл реализующий создание,удаление,редактирование контакта на серверной стороне.',
SERVER/notebook/PB_img/NONE.png:'файл для контактов без фото хранится в фапке с фото для всех контактов',
SCRIPTS_CLIENT/ajax.js:'
класс AJAXpigeon() для AJAX запросов',
SCRIPTS_CLIENT/INDEXs.js:'скрипты для главной страницы',
https://code.jquery.com/jquery-3.6.0.js:'JQUERY',