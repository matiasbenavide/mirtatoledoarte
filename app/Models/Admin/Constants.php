<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constants extends Model
{
    const ERROR = 'La operación no pudo ser realizada';
    const PRODUCT_SUCCESS = 'Producto listado con éxito';
    const COMBO_SUCCESS = 'Combo listado con éxito';
    const PRODUCT_UPDATE_SUCCESS = 'Producto actualizado con éxito';
    const COMBO_UPDATE_SUCCESS = 'Combo actualizado con éxito';

    const VACATIONS_SUCCESS = '¡El modo vacaciones se ha actualizado!';
    const PRICE_UPDATE_SUCCESS = '¡El aumento se ha aplicado exitosamente!';

    const EMPTY_CART = 'El carrito de compras se encuentra vacío';
    const SUCCESSFUL_BUY = 'La compra se ha realizado con éxito';
    const BUY_ERROR = 'No se ha podido completar la compra';
}
