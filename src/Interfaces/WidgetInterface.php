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
    const CALENDARIO = "calendario";
    const NOME = "Widget";


    public function getPermissions();

    public function getType():string;

    public function getNome():string;

    public function getDados();

    public function isDados();

    public function getNomeDisplay():string;

    public function run($params = null);
}
