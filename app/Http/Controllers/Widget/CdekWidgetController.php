<?php

namespace App\Http\Controllers\Widget;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CdekWidget\Controller as CdekWidget;
use App\Services\CdekWidget\Settings as CdekWidgetSetting;

class CdekWidgetController extends Controller
{
    public function index()
    {
        return view('widget.cdek');
    }

    public function info(Request $request) {
        return CdekWidget::processRequest(
            CdekWidgetSetting::factory(
            /** Настройте приоритет тарифов курьерской доставки */
            /** Set up the priority of courier delivery tariffs */
                array(233, 137, 139, 16, 18, 11, 1, 3, 61, 60, 59, 58, 57, 83),
                /** Настройте приоритет тарифов доставки до пунктов выдачи */
                /** Set the priority of delivery tariffs to pick-up points */
                array(234, 136, 138, 15, 17, 10, 12, 5, 62, 63),
                /** Вставьте свой аккаунт\идентификатор для интеграции */
                /** Put your account for integration here */
                'ywlpBpmoczbBquYnskgSNx0fIlXX4obs',
                /** Вставьте свой пароль для интеграции */
                /** Put your password for integration here */
                'CvPyAQxQHAWW0C816CT4n0N6nyfWWrh8'
            ),
            $request->all()
        );
    }

    public function init() {
        return view('widget.cdek');
    }

    public function template() {
        return [
          'address' => (string)view('widget.parts.address'),
          'city' => (string)view('widget.parts.city'),
          'd_courier' => (string)view('widget.parts.d_courier'),
          'd_pickup' => (string)view('widget.parts.d_pickup'),
          'd_post' => (string)view('widget.parts.d_post'),
          'delivery_button' => (string)view('widget.parts.delivery_button'),
          'image_c' => (string)view('widget.parts.image_c'),
          'panel_details' => (string)view('widget.parts.panel_details'),
          'panel_list' => (string)view('widget.parts.panel_list'),
          'point' => (string)view('widget.parts.point'),
          'popup' => (string)view('widget.parts.popup'),
          'sidebar' => (string)view('widget.parts.sidebar'),
          'widget' => (string)view('widget.parts.widget'),
        ];
    }
}
