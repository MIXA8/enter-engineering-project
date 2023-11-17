# Запуск

после установки запустить
1)npm run dev
2)php artisan serve
![enter image description here](https://raw.githubusercontent.com/MIXA8/foto/main/1.png)
# Первый пользователь

Для начала воспользуйтесь кнопкой 'Регистрация' в верхнем правом углу для создания своего аккаунта. Также нужно через базу изменить в таблице users строчку role, на своего аккаунта на '"directory".

## Роли

В приложение есть 3 уровня доступа
**directory**
**teacher**
**student**

directory - полный доступ
teacher - частичный доступ( просмотр групп предметов и проставление оценок)
student - просмотр расписания и оценок и отчета об своей успеваемости.

## directory
![enter image description here](https://raw.githubusercontent.com/MIXA8/foto/main/image.png)

Directory обеспечивает полный набор операций CRUD для всех типов таблиц, а также предоставляет возможность получения отчетов через REST-интерфейс.

![enter image description here](https://raw.githubusercontent.com/MIXA8/foto/main/21.png)
Чтобы получить отчет, Report->Посмотреть Отчет о группе
Report ->Посмотреть студентов ->  посмотреть отчет
также фильтрация по таблице отчетов происходит по нажатию **заголовка столбца**
![enter image description here](https://raw.githubusercontent.com/MIXA8/foto/main/333.png)

## teacher
![enter image description here](https://raw.githubusercontent.com/MIXA8/foto/main/3.png)
как показано на изображение выше teacher имеет право смотреть группы, предметы и ставить оценки а также получение отчета(REST).
Чтобы поставить оценку
Grade->посмотреть->поставить оценку или Grade->посмотреть->исправить оценку


## student

студент имеет право только смотреть средний бал по предметам и смотреть предметы

## Важно

Добавлять в данные в базу нужно Group -> Student -> Subject -> Grade 
