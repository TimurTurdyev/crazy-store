<?php

namespace App\Services_off\CdekWidget;

class I18nAction extends BaseAction
{
    /**
     * @return array with translations
     */
    public function run()
    {
        return array('LANG' => $this->controller->getValue(
            $translate = array(
                'rus' => array(
                    'YOURCITY' => 'Ваш город',
                    'COURIER' => 'Курьер',
                    'PICKUP' => 'Самовывоз',
                    'TERM' => 'Срок',
                    'PRICE' => 'Стоимость',
                    'DAY' => 'дн.',
                    'RUB' => ' руб.',
                    'KZT' => 'KZT',
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                    'GBP' => 'GBP',
                    'CNY' => 'CNY',
                    'BYN' => 'BYN',
                    'UAH' => 'UAH',
                    'KGS' => 'KGS',
                    'AMD' => 'AMD',
                    'TRY' => 'TRY',
                    'THB' => 'THB',
                    'KRW' => 'KRW',
                    'AED' => 'AED',
                    'UZS' => 'UZS',
                    'MNT' => 'MNT',
                    'NODELIV' => 'Нет доставки',
                    'CITYSEARCH' => 'Поиск города',
                    'ALL' => 'Все',
                    'PVZ' => 'Пункты выдачи',
                    'POSTOMAT' => 'Постаматы',
                    'MOSCOW' => 'Москва',
                    'RUSSIA' => 'Россия',
                    'COUNTING' => 'Идет расчет',

                    'NO_AVAIL' => 'Нет доступных способов доставки',
                    'CHOOSE_TYPE_AVAIL' => 'Выберите способ доставки',
                    'CHOOSE_OTHER_CITY' => 'Выберите другой населенный пункт',

                    'TYPE_ADDRESS' => 'Уточните адрес',
                    'TYPE_ADDRESS_HERE' => 'Введите адрес доставки',

                    'L_ADDRESS' => 'Адрес пункта выдачи заказов',
                    'L_TIME' => 'Время работы',
                    'L_WAY' => 'Как к нам проехать',
                    'L_CHOOSE' => 'Выбрать',

                    'H_LIST' => 'Список пунктов выдачи заказов',
                    'H_PROFILE' => 'Способ доставки',
                    'H_CASH' => 'Расчет картой',
                    'H_DRESS' => 'С примеркой',
                    'H_POSTAMAT' => 'Постаматы СДЭК',
                    'H_SUPPORT' => 'Служба поддержки',
                    'H_QUESTIONS' => 'Если у вас есть вопросы, можете<br> задать их нашим специалистам',
                    'ADDRESS_WRONG' => 'Невозможно определить выбранное местоположение. Уточните адрес из выпадающего списка в адресной строке.',
                    'ADDRESS_ANOTHER' => 'Ознакомьтесь с новыми условиями доставки для выбранного местоположения.'
                ),
                'eng' => array(
                    'YOURCITY' => 'Your city',
                    'COURIER' => 'Courier',
                    'PICKUP' => 'Pickup',
                    'TERM' => 'Term',
                    'PRICE' => 'Price',
                    'DAY' => 'days',
                    'RUB' => 'RUB',
                    'KZT' => 'KZT',
                    'USD' => 'USD',
                    'EUR' => 'EUR',
                    'GBP' => 'GBP',
                    'CNY' => 'CNY',
                    'BYN' => 'BYN',
                    'UAH' => 'UAH',
                    'KGS' => 'KGS',
                    'AMD' => 'AMD',
                    'TRY' => 'TRY',
                    'THB' => 'THB',
                    'KRW' => 'KRW',
                    'AED' => 'AED',
                    'UZS' => 'UZS',
                    'MNT' => 'MNT',
                    'NODELIV' => 'Not delivery',
                    'CITYSEARCH' => 'Search for a city',
                    'ALL' => 'All',
                    'PVZ' => 'Points of self-delivery',
                    'POSTOMAT' => 'Postamats',
                    'MOSCOW' => 'Moscow',
                    'RUSSIA' => 'Russia',
                    'COUNTING' => 'Calculation',

                    'NO_AVAIL' => 'No shipping methods available',
                    'CHOOSE_TYPE_AVAIL' => 'Choose a shipping method',
                    'CHOOSE_OTHER_CITY' => 'Choose another location',

                    'TYPE_ADDRESS' => 'Specify the address',
                    'TYPE_ADDRESS_HERE' => 'Enter the delivery address',

                    'L_ADDRESS' => 'Adress of self-delivery',
                    'L_TIME' => 'Working hours',
                    'L_WAY' => 'How to get to us',
                    'L_CHOOSE' => 'Choose',

                    'H_LIST' => 'List of self-delivery',
                    'H_PROFILE' => 'Shipping method',
                    'H_CASH' => 'Payment by card',
                    'H_DRESS' => 'Dressing room',
                    'H_POSTAMAT' => 'Postamats CDEK',
                    'H_SUPPORT' => 'Support',
                    'H_QUESTIONS' => 'If you have any questions,<br> you can ask them to our specialists',

                    'ADDRESS_WRONG' => 'Impossible to define address. Please, recheck the address.',
                    'ADDRESS_ANOTHER' => 'Read the new terms and conditions.'
                )
            ),
            $this->controller->getRequestValue('lang', 'rus'),
            $translate['rus']
        ));
    }
}
