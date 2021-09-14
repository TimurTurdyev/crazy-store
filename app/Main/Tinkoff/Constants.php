<?php

namespace App\Main\Tinkoff;

class Constants
{
    const API_URL = 'https://securepay.tinkoff.ru/v2/';             // Боевая
    const API_TEST_URL = 'https://rest-api-test.tinkoff.ru/v2/';    // Тестовая

    const TAXATION = [
        'osn' => 'osn',                                 // Общая СН
        'usn_income' => 'usn_income',                   // Упрощенная СН (доходы)
        'usn_income_outcome' => 'usn_income_outcome',   // Упрощенная СН (доходы минус расходы)
        'envd' => 'envd',                               // Единый налог на вмененный доход
        'esn' => 'esn',                                 // Единый сельскохозяйственный налог
        'patent' => 'patent'                            // Патентная СН
    ];

    const PAYMENT = [
        'full_prepayment' => 'full_prepayment', //Предоплата 100%
        'prepayment' => 'prepayment',           //Предоплата
        'advance' => 'advance',                 //Аванc
        'full_payment' => 'full_payment',       //Полный расчет
        'partial_payment' => 'partial_payment', //Частичный расчет и кредит
        'credit' => 'credit',                   //Передача в кредит
        'credit_payment' => 'credit_payment',   //Оплата кредита
    ];

    const ENTITY = [
        'commodity' => 'commodity',                         //Товар
        'excise' => 'excise',                               //Подакцизный товар
        'job' => 'job',                                     //Работа
        'service' => 'service',                             //Услуга
        'gambling_bet' => 'gambling_bet',                   //Ставка азартной игры
        'gambling_prize' => 'gambling_prize',               //Выигрыш азартной игры
        'lottery' => 'lottery',                             //Лотерейный билет
        'lottery_prize' => 'lottery_prize',                 //Выигрыш лотереи
        'intellectual_activity' => 'intellectual_activity', //Предоставление результатов интеллектуальной деятельности
        'payment' => 'payment',                             //Платеж
        'agent_commission' => 'agent_commission',           //Агентское вознаграждение
        'composite' => 'composite',                         //Составной предмет расчета
        'another' => 'another',                             //Иной предмет расчета
    ];

    const VAT = [
        'none' => 'none',   // Без НДС
        'vat0' => 'vat0',   // НДС 0%
        'vat10' => 'vat10', // НДС 10%
        'vat20' => 'vat20'  // НДС 20%
    ];
}
