<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::edit($userId, $name, $password);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

}
