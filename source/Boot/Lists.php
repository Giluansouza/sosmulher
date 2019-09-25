<?php

/**
 * ####################
 * ###   LISTS   ###
 * ####################
 */
function status(): array
{
    return [
        'MORTO',
        'LIBERDADE',
        'FORAGIDO',
        'EVADIDO',
        'PRESO',
        'SEMIABERTO',
        'SAÍDA TEMPORÁRIA'
    ];
}

function source(): array
{
    $array = [
        "ROP",
        "CIDE",
        "OUTROS",
        "NI"
    ];
    return $array;
}

function zone(): array
{
    $array = [
        "URBANA",
        "RURAL"
    ];
    return $array;
}

function weapon(): array
{
    $array = [
        "ARMA DE FOGO",
        "ARMA BRANCA",
        "OUTROS",
        "NI"
    ];
    return $array;
}

function caliber(): array
{
    return [
        '.32',
        '.36',
        '.38',
        '.380',
        '.357',
        '9mm',
        '.40',
        '.44',
        '.45',
        '5.56',
        '7.62',
        '12'
    ];
}

function timeInterval(): array
{
    return $array = [
        "00h-02h",
        "02h-04h",
        "04h-06h",
        "06h-08h",
        "08h-10h",
        "10h-12h",
        "12h-14h",
        "14h-16h",
        "16h-18h",
        "18h-20h",
        "20h-22h",
        "22h-00h"
    ];
}

function vehicle(): array
{
    $array = [
        "CARRO",
        "MOTO",
        "A PE",
        "OUTROS",
        "NI"
    ];
    return $array;
}

function motivation(): array
{
    $array = [
        "OUTROS",
        "PASSIONAL",
        "TRÁFICO DE DROGAS",
        "RIXA",
        "VINGANÇA",
        "DISPUTA ENTRE FACÇÕES",
        "EXECUÇÃO",
        "ROUBO"
    ];
    return $array;
}

function gender(): array
{
    $array = [
        "MASCULINO",
        "FEMININO",
        "NI"
    ];
    return $array;
}

function skinColor(): array
{
    $array = [
        "NI",
        "BRANCA",
        "PARDA",
        "PRETA"
    ];
    return $array;
}

function criminalRecord(): array
{
    $array = [
        "NI",
        "SIM",
        "NAO"
    ];
    return $array;
}

function orcrim(): array
{
    return $array = [
        "BDM",
        "CP",
        "KATIARA",
        "BONDE DO CURRALINHO"
    ];
}

function months(): array
{
    return $array = [
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Março',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Setembro',
        '10' => 'Outubro',
        '11' => 'Novembro',
        '12' => 'Dezembro'
    ];
}

function level(): array
{
    return $array = [
        1,
        2,
        3,
        4,
        5,
        10
    ];
}
