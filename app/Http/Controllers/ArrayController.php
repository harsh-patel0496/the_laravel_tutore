<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ArrayController extends Controller
{
    public $arr = ['a' => 1, 'b' => 2];

    public function index(){
        dump(Arr::accessible($this->arr));

        $this->arr = Arr::add($this->arr,'price',100);
        dump($this->arr);

        $this->arr = Arr::collapse([[1,2,3],[4,5,6],[7,8,9]]);
        dump('collapse',$this->arr);

        $matrix = Arr::crossJoin([1,2],['a','b']);
        dump('Cross Join',$matrix);

        [$keys,$values] = Arr::divide($matrix);
        dump("Keys",$keys,"Values",$values);
    }
}
