<?php

namespace Uasoft\Badaso\Interfaces;

/**
 * @author Sulfano Agus Fikri
 */
interface WidgetInterface
{

    const TABELA = "tabela";
    const GRAFICO = "grafica";
    const PADRAO = "padrao";


    public function getPermissions();

    public function getType():string;

    public function run($params = null);
}
