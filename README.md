# Test task for zakupka.com

## Install and run

1. Clone: `git clone https://bitbucket.org/atoumus/test_zakupka.com.git && cd ./test_zakupka.com`
1. Run: `php -S 0.0.0.0:8000 -t public`
1. Go to browser: `http://{your-ip-address}:8000`

## Task description

Написать набор классов для валидации форм. Код должен быть только вашим (не скопированным).
Набор должен содержать не менее 2х абстрактных классов/интерфейсов (AbstractValidator и AbstractForm).
Реализовать несколько разных валидаторов, и несколько форм (форма должна уметь валидировать себя). 
Рендеринг формы делать не надо, только бизнес логику. Код должен быть гибкий и простой в использовании.

---

Некоторые объяснения по тому как делал:

1. Правильно было бы сделать контроллеры и рендеринг видов, но этого в ТЗ не требовалось, 
поэтому для упрощения сделал несколько PHP файлов: contact.php index.php register.php ... 
(но так конечно в реальном проекте нельзя т.к. это хардкод).
1. Если бы использовался composer, то автозагрузку классов можно было сделать через него. 
Но в рамках данного тестового задания composer был бы излишним, 
поэтому автозагрузку сделал через spl_autoload_register().