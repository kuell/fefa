<?php

    /**
     * Created by PhpStorm.
     * User: root
     * Date: 06/03/17
     * Time: 14:37
     */
    class Empresa extends Eloquent
    {
        protected $table = 'empresas';


        public function fefas(){
            return $this->hasMany('Fefa', 'empresa_id');
        }
    }