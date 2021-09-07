<?php

namespace App\Main\Cdek;

class Constants
{
    /**
     * Хук: статусы
     */
    public const HOOK_TYPE_STATUS = 'ORDER_STATUS';

    /**
     * Хук: печатные формы
     */
    public const HOOK_PRINT_STATUS = 'PRINT_FORM';

    /**
     * Хук: задел на будущее
     */
    public const HOOK_TYPE_OTHER = 'ANYTHING_OTHER';

    /**
     * Печатная форма - штрих коды для упаковки
     */
    public const PRINT_TYPE_BARCODE = 'barcode';

    /**
     * Печатная форма - накладная для заказа
     */
    public const PRINT_TYPE_INVOICE = 'receipt';

    /**
     * Ошибка авторизации
     */
    public const AUTH_FAIL = 'Authentication is failed, please check your account and secure';

    /**
     * Страхование
     */
    public const SERVICE_INSURANCE = 'INSURANCE';

    /**
     * Доставка в выходной день
     */
    public const SERVICE_WEEKEND_DELIVERY = 'DELIV_WEEKEND';

    /**
     * Опасный груз.
     */
    public const SERVICE_DANGEROUS_GOODS = 'DANGER_CARGO';

    /**
     * Забор в городе отправителе.
     */
    public const SERVICE_PICKUP = 'TAKE_SENDER';

    /**
     * Доставка в городе получателе.
     */
    public const SERVICE_DELIVERY_TO_DOOR = 'DELIV_RECEIVER';

    /**
     * Упаковка 1 310*215*280мм
     */
    public const SERVICE_PACKAGE_1 = 'PACKAGE_1';

    /**
     * Примерка на дому.
     */
    public const SERVICE_TRY_AT_HOME = 'TRYING_ON';

    /**
     * Частичная доставка.
     */
    public const SERVICE_PARTIAL_DELIVERY = 'PART_DELIV';

    /**
     * Осмотр вложения.
     */
    public const SERVICE_CARGO_CHECK = 'INSPECTION_CARGO';

    /**
     * Реверс.
     */
    public const SERVICE_REVERSE = 'REVERSE';

    /**
     * Статус: Принят
     */
    public const STATUS_ACCEPTED = 'ACCEPTED';

    /**
     * Статус: Создан
     */
    public const STATUS_CREATED = 'CREATED';

    /**
     * Статус: Удален
     */
    public const STATUS_DELETED = 'REMOVED';

    /**
     * Статус: Принят на склад отправителя
     */
    public const STATUS_TAKE_IN = 'RECEIVED_AT_SENDER_WAREHOUSE';

    /**
     * Статус: Выдан на отправку в городе отправителе
     */
    public const STATUS_READY_FOR_SHIPMENT_IN_SENDER_CITY = 'READY_FOR_SHIPMENT_IN_SENDER_CITY';

    /**
     * Статус: Возвращен на склад отправителя
     */
    public const STATUS_RETURNED_TO_SENDER_CITY_WAREHOUSE = 'RETURNED_TO_SENDER_CITY_WAREHOUSE';

    /**
     * Статус: Сдан перевозчику в городе отправителе
     */
    public const STATUS_TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY = 'TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY';

    /**
     * Статус: Отправлен в г. транзит
     */
    public const STATUS_SENT_TO_TRANSIT_CITY = 'SENT_TO_TRANSIT_CITY';

    /**
     * Статус: Встречен в г. транзите
     */
    public const STATUS_ACCEPTED_IN_TRANSIT_CITY = 'ACCEPTED_IN_TRANSIT_CITY';

    /**
     * Статус: Принят на склад транзита
     */
    public const STATUS_ACCEPTED_AT_TRANSIT_WAREHOUSE = 'ACCEPTED_AT_TRANSIT_WAREHOUSE';

    /**
     * Статус: Возвращен на склад транзита
     */
    public const STATUS_RETURNED_TO_TRANSIT_WAREHOUSE = 'RETURNED_TO_TRANSIT_WAREHOUSE';

    /**
     * Статус: Выдан на отправку в г. транзите
     */
    public const STATUS_READY_FOR_SHIPMENT_IN_TRANSIT_CITY = 'READY_FOR_SHIPMENT_IN_TRANSIT_CITY';

    /**
     * Статус: Сдан перевозчику в г. транзите
     */
    public const STATUS_TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY = 'TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY';

    /**
     * Статус: Отправлен в г. получатель
     */
    public const STATUS_SENT_TO_RECIPIENT_CITY = 'SENT_TO_RECIPIENT_CITY';

    /**
     * Статус: Встречен в г. получателе
     */
    public const STATUS_ARRIVED_AT_RECIPIENT_CITY = 'ARRIVED_AT_RECIPIENT_CITY';

    /**
     * Статус: Принят на склад доставки
     */
    public const STATUS_ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE = 'ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE';

    /**
     * Статус: Принят на склад до востребования
     */
    public const STATUS_ACCEPTED_AT_PICK_UP_POINT = 'ACCEPTED_AT_PICK_UP_POINT';

    /**
     * Статус: Выдан на доставку
     */
    public const STATUS_TAKEN_BY_COURIER = 'TAKEN_BY_COURIER';

    /**
     * Статус: Возвращен на склад доставки
     */
    public const STATUS_RETURNED_TO_RECIPIENT_CITY_WAREHOUSE = 'RETURNED_TO_RECIPIENT_CITY_WAREHOUSE';

    /**
     * Статус: Вручен
     */
    public const STATUS_DELIVERED = 'DELIVERED';

    /**
     * Статус: Не вручен
     */
    public const STATUS_NOT_DELIVERED = 'NOT_DELIVERED';

    /**
     * Параметр типа аутентификации
     */
    public const AUTH_PARAM_CREDENTIAL = 'client_credentials';

    /**
     * Ключ авторизации: тип аутентификации, доступное значение: client_credentials
     */
    public const AUTH_KEY_TYPE = 'grant_type';

    /**
     * Ключ авторизации: идентификатор клиента, равен Account
     */
    public const AUTH_KEY_CLIENT_ID = 'client_id';

    /**
     * Ключ авторизации: секретный ключ клиента, равен Secure password
     */
    public const AUTH_KEY_SECRET = 'client_secret';

    /**
     * Настройки таймаута для запросов
     */
    public const CONNECTION_TIMEOUT = 10;

    /**
     * Адрес сервиса интеграции
     */
    public const API_URL = 'https://api.cdek.ru/v2/';

    /**
     * Адрес сервиса интеграции для тестов
     */
    public const API_URL_TEST = 'https://api.edu.cdek.ru/v2/';

    /**
     * Аккаунт для тестовой среды
     */
    public const TEST_ACCOUNT = 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI';

    /**
     * Секретный ключ для тестовой среды
     */
    public const TEST_SECURE = 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';

    /**
     * Тип связанной сущности: возвратный заказ
     * (возвращается для прямого, если заказ не вручен и по нему уже был сформирован возвратный заказ)
     */
    public const RELATION_RETURN_ORDER = 'return_order';

    /**
     * Тип связанной сущности: прямой заказ (возвращается для возвратного)
     */
    public const RELATION_DIRECT_ORDER = 'direct_order';

    /**
     * Тип связанной сущности: заявка на вызов курьера
     */
    public const RELATION_INTAKE = 'intake';

    /**
     * Тип связанной сущности: квитанция к заказу
     */
    public const RELATION_RECEIPT = 'receipt';

    /**
     * Тип связанной сущности: ШК-место к заказу
     */
    public const RELATION_BARCODE = 'barcode';

    /**
     * Тип связанной сущности: договоренность о доставке (актуальная)
     */
    public const RELATION_DELIVERY = 'delivery';

    /**
     * Код материала товара: Полиэстер
     */
    public const MATERIAL_POLYESTER = 1;

    /**
     * Код материала товара: Нейлон
     */
    public const MATERIAL_NYLON = 2;

    /**
     * Код материала товара: Флис
     */
    public const MATERIAL_FLEECE = 3;

    /**
     * Код материала товара: Хлопок
     */
    public const MATERIAL_COTTON = 4;

    /**
     * Код материала товара: Текстиль
     */
    public const MATERIAL_TEXTILES = 5;

    /**
     * Код материала товара: Лён
     */
    public const MATERIAL_FLAX = 6;

    /**
     * Код материала товара: Вискоза
     */
    public const MATERIAL_VISCOSE = 7;

    /**
     * Код материала товара: Шелк
     */
    public const MATERIAL_SILK = 8;

    /**
     * Код материала товара: Шерсть
     */
    public const MATERIAL_WOOL = 9;

    /**
     * Код материала товара: Кашемир
     */
    public const MATERIAL_CASHMERE = 10;

    /**
     * Код материала товара: Кожа
     */
    public const MATERIAL_LEATHER = 11;

    /**
     * Код материала товара: Кожзам
     */
    public const MATERIAL_LEATHERETTE = 12;

    /**
     * Код материала товара: Искусственный мех
     */
    public const MATERIAL_FAUX_FUR = 13;

    /**
     * Код материала товара: Замша
     */
    public const MATERIAL_SUEDE = 14;

    /**
     * Код материала товара: Полиуретан
     */
    public const MATERIAL_POLYURETHANE = 15;

    /**
     * Код материала товара: Спандекс
     */
    public const MATERIAL_SPANDEX = 16;

    /**
     * Код материала товара: Резина
     */
    public const MATERIAL_RUBBER = 17;
}
