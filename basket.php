<?php

declare(strict_types=1);

const OPERATION_EXIT = 0;
const OPERATION_ADD = 1;
const OPERATION_DELETE = 2;
const OPERATION_PRINT = 3;

$operations = [
    OPERATION_EXIT => OPERATION_EXIT . '. Завершить программу.',
    OPERATION_ADD => OPERATION_ADD . '. Добавить товар в список покупок.',
    OPERATION_DELETE => OPERATION_DELETE . '. Удалить товар из списка покупок.',
    OPERATION_PRINT => OPERATION_PRINT . '. Отобразить список покупок.',
];

$items = [];


/**
 * @param string $name название товара
 * @param array $items список товаров
 *
 * @return void
 */
function addItemToBasket(string $name, array &$items): void
{
    $items[] = $name;
}

/**
 * @param array $items список товаров
 *
 * @return string
 */
function printItemList(array $items): string
{
    return 'Ваш список покупок: ' . PHP_EOL .
        implode(PHP_EOL, $items) . PHP_EOL .
        'Всего ' . count($items) . ' позиций. ' . PHP_EOL;
}

/**
 * @param string $name название товара
 * @param array $items список товаров
 *
 * @return void
 */
function removeItemFromBasket(string $name, array &$items): void
{
    if (in_array($name, $items, true) !== false) {
        while (($key = array_search($name, $items, true)) !== false) {
            unset($items[$key]);
        }
    }
}

/**
 * @param array $operations список операций
 *
 * @return int
 */
function getOperationNumber(array $operations, array $items): int
{
    do {
        echo 'Выберите операцию для выполнения: ' . PHP_EOL;
        // Проверить, есть ли товары в списке? Если нет, то не отображать пункт про удаление товаров
        foreach ($operations as $operationCode => $operation) {
            if (count($items) === 0 && $operationCode === OPERATION_DELETE) {
                continue;
            }

            echo $operation . PHP_EOL;
        }
        echo PHP_EOL . '> ';
        $operationNumber = trim(fgets(STDIN));

        if (!array_key_exists($operationNumber, $operations)) {
            system('clear');

            echo '!!! Неизвестный номер операции, повторите попытку.' . PHP_EOL;
        }

    } while (!array_key_exists($operationNumber, $operations));

    return (int)$operationNumber;
}

/**
 * Выведет заголовок
 * @param array $items список товаров
 *
 * @return string
 */
function getTitle(array $items): string
{
    $result = '';
    if (count($items)) {
        $result .= 'Ваш список покупок: ' . PHP_EOL;
        $result .= implode("\n", $items) . "\n";
    } else {
        $result .= 'Ваш список покупок пуст.' . PHP_EOL;
    }

    return $result;
}

do {
    system('clear');

    echo getTitle($items);
    $operationNumber = getOperationNumber($operations, $items);

    echo 'Выбрана операция: ' . $operations[$operationNumber] . PHP_EOL;

    switch ($operationNumber) {
        case OPERATION_ADD:
            echo "Введение название товара для добавления в список: \n> ";
            $itemName = trim(fgets(STDIN));
            addItemToBasket($itemName, $items);
            break;

        case OPERATION_DELETE:
            echo printItemList($items);

            echo 'Введение название товара для удаления из списка:' . PHP_EOL . '> ';
            $itemName = trim(fgets(STDIN));
            removeItemFromBasket($itemName, $items);
            break;

        case OPERATION_PRINT:
            echo printItemList($items);
            echo 'Нажмите enter для продолжения';
            fgets(STDIN);
            break;
    }

    echo "\n ----- \n";
} while ($operationNumber > 0);

echo 'Программа завершена' . PHP_EOL;
