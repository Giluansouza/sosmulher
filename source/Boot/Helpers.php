<?php

use Illuminate\Container\Container;
/**
 * ####################
 * ###   VALIDATE   ###
 * ####################
 */
if (! function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string  $abstract
     * @param  array   $parameters
     * @return mixed|\Illuminate\Foundation\Application
     */
    function app($abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }
        return Container::getInstance()->make($abstract, $parameters);
    }
}

/**
 * @param string $email
 * @return bool
 */
function is_email(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * @param string $password
 * @return bool
 */
function is_passwd(string $password): bool
{
    if (password_get_info($password)['algo'] || (mb_strlen($password) >= CONF_PASSWD_MIN_LEN && mb_strlen($password) <= CONF_PASSWD_MAX_LEN)) {
        return true;
    }

    return false;
}

/**
 * Valida o formato do E-mail e a existencia do dominio
 * @param  string $mail
 * @return bool
 */
function valid_email($email){
    //verifica se e-mail esta no formato correto de escrita
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$email)){
        return false;
    }
    else{
        //Valida o dominio
        list($user, $host) = explode('@',$email);
        if(!checkdnsrr($host,'MX')){
            return false;
        }
        else {
            return true;
        }
    }
}

/**
 * @param  string $cpf
 * @return bool
 */
function is_cpf(string $cpf): bool
{
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf);

    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d) {
            return false;
        }
    }
    return true;
}

/**
 * ##################
 * ###   STRING   ###
 * ##################
 */

/**
 * @param string $string
 * @return string
 */
function str_slugui(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["-----", "----", "---", "--"], "-",
        str_replace(" ", "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_space(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["     ", "    ", "   ", "  "], " ",
        str_replace("-", "",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string
{
    $string = str_slug($string);
    $studlyCase = str_replace(" ", "",
        mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
    );

    return $studlyCase;
}

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string
{
    return lcfirst(str_studly_case($string));
}

/**
 * @param string $string
 * @return string
 */
function str_title(string $string): string
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(" ", $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(" ", array_slice($arrWords, 0, $limit));
    return "{$words}{$pointer}";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
    return "{$chars}{$pointer}";
}

/**
 * ###############
 * ###   URL   ###
 * ###############
 */

/**
 * @param string $path
 * @return string
 */
function url(string $path = null): string
{
    if (strpos($_SERVER['HTTP_HOST'], "localhost")) {//se existit a palavra localhost eu estou em ambiente de teste
        if ($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }
        return CONF_URL_TEST;
    }

    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE;
}

/**
 * @return string
 */
function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());//mostrar a ultima pagina utilizada
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

/**
 * ##################
 * ###   ASSETS   ###
 * ##################
 */

/**
 * @param string|null $path
 * @return string
 */
function theme(string $path = null): string
{
    if (strpos($_SERVER['HTTP_HOST'], "localhost")) {
        if ($path) {
            return CONF_URL_TEST . "/themes/" . CONF_VIEW_WAR . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return CONF_URL_TEST . "/themes/" . CONF_VIEW_WAR;
    }

    if ($path) {
        return CONF_URL_BASE . "/themes/" . CONF_VIEW_WAR . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return CONF_URL_BASE . "/themes/" . CONF_VIEW_WAR;
}

/**
 * @param string $image
 * @param int $width
 * @param int|null $height
 * @return string
 */
function image(?string $image, int $width, int $height = null): ?string
{
    if ($image) {
        return url() . "/" . (new \DevBoot\Support\Thumb())->make($image, $width, $height);
    }

    return null;
}

/**
 * ################
 * ###   DATE   ###
 * ################
 */

/**
 * @param string $date
 * @param string $format
 * @return string
 */
function date_fmt(string $date = "now", string $format = "d/m/Y"): string//formatação da data
{
    return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @return string
 */
function date_fmt_br(string $date = "now"): string//formatação do brasil
{
    return (new DateTime($date))->format(CONF_DATE_BR);
}

/**
 * @param string $date
 * @return string
 */
function date_fmt_app(string $date = "now"): string
{
    return (new DateTime($date))->format(CONF_DATE_APP);
}

/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    if (!empty(password_get_info($password)['algo'])) {
        return $password;
    }

    return password_hash($password, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * @param string $hash
 * @return bool
 */
function passwd_rehash(string $hash): bool
{
    return password_needs_rehash($hash, CONF_PASSWD_ALGO, CONF_PASSWD_OPTION);
}

/**
 * ###################
 * ###   REQUEST   ###
 * ###################
 */

/**
 * @return string
 */
function csrf_input(): string
{
    $session = new \DevBoot\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
}

/**
 * @param $request
 * @return bool
 */
function csrf_verify($request): bool
{
    $session = new \DevBoot\Core\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }
    return true;
}

/**
 * @return null|string
 */
function flash(): ?string
{
    $session = new \DevBoot\Core\Session();
    if ($flash = $session->flash()) {
        return $flash;
    }
    return null;
}

/**
 * @param string $key
 * @param int $limit
 * @param string $email
 * @return bool
 */
function request_limit(string $key, int $limit = 5, string $email): bool
{
    $session = new \DevBoot\Core\Session();
    if ($session->has($key) && $session->$key->requests <= $limit) {
        $session->set($key, [
            "requests" => $session->$key->requests + 1,
            "email" => $email
        ]);
        return false;
    }

    if ($session->has($key) && $session->$key->requests >= $limit) {
        return true;
    }

    $session->set($key, [
        "requests" => 1,
        "email" => $email
    ]);

    return false;
}

/**
 * @param string $field
 * @param string $value
 * @return bool
 */
function request_repeat(string $field, string $value): bool
{
    $session = new \DevBoot\Core\Session();
    if ($session->has($field) && $session->$field == $value) {
        return true;
    }

    $session->set($field, $value);
    return false;
}

/**
 * Calculo de idade
 * @param  string $date_birth
 * @return int
 */
function age(string $date_birth): int
{
    list($year, $month, $day) = explode('-', $date_birth);
    $today = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    $birth = mktime( 0, 0, 0, $month, $day, $year);
    return $age = floor((((($today - $birth) / 60) / 60) / 24) / 365.25);
}
// -->

/**
 * ###################
 * ###   STYLES   ###
 * ###################
 */
// Função para mudança de classe CSS (background das tabelas)
function classChange(int $dividend, int $divisor): string
{
    // if () {

    // }
    if ($divisor == $dividend)
        return 'class="bg-warning"';
    else if ($divisor == 0) {
        return 'class="bg-danger"';
    } else {
        if (($dividend/$divisor-1) <= -0.06)
            return 'class="bg-success"';
        if (($dividend/$divisor-1) > -0.06 && ($dividend/$divisor-1) <= 0)
            return 'class="bg-warning"';
        else
            return 'class="bg-danger"';
    }
}

/**
 * ###################
 * ###   ARRAYS   ###
 * ###################
 */

function objUnit(object $units, object $total, object $total2, object $year, object $year2): object
{
    foreach($units AS $key => $value) {
        $units[$key]->total = 0;
        $units[$key]->totalPre = 0;
        $units[$key]->totalYear = 0;
        $units[$key]->totalYearPre = 0;
        foreach($total as $k => $val) {
            if($value->id == $val->police_unit_id) {
                $units[$key]->total = $val->total;
            }
        }
        foreach($total2 as $k => $val) {
            if($value->id == $val->police_unit_id) {
                $units[$key]->totalPre = $val->total;
            }
        }
        foreach($year as $k => $val) {
            if($value->id == $val->police_unit_id) {
                $units[$key]->totalYear = $val->total;
            }
        }
        foreach($year2 as $k => $val) {
            if($value->id == $val->police_unit_id) {
                $units[$key]->totalYearPre = $val->total;
            }
        }

        $units[$key]->abs = $units[$key]->total - $units[$key]->totalPre;
        $units[$key]->perc = ($units[$key]->totalPre > 0 ) ? round(($units[$key]->total/$units[$key]->totalPre-1)*100) : 0;
        $units[$key]->absY = $units[$key]->totalYear - $units[$key]->totalYearPre;
        $units[$key]->percY = ($units[$key]->totalYearPre > 0 ) ? round(($units[$key]->totalYear/$units[$key]->totalYearPre-1)*100) : 0;
    }

    return $units;
}

// Compara se $a é maior que $b
function ordena_array($array, $campo) {
    usort($array, function ($a, $b) use ($campo) {
        return $a[$campo] > $b[$campo];
    });
    return $array;
}

// Array para tabela de acompanhamento diario
function arrDayleTable(object $units, object $total, object $totalPrevious, string $date): array
{

    foreach ($units as $key => $value) {
        $array[$key]['id'] = $value->id;
        $array[$key]['name'] = $value->name;
        $array[$key]['risp'] = $value->risp;
        $array[$key]['total'] = 0;
        $array[$key]['totalPre'] = 0;
        for ($i = 1; $i <= date('t', strtotime($date)); $i++) {
            $array[$key][$i] = 0;
        }
    }

    foreach ($array as $key => $value) {
        foreach ($total as $tk => $tv) {
            if ($tv->police_unit_id == $value['id']) {
                if ($tv->relation_count != 0) {
                    $array[$key][date('j', strtotime($tv->date_fact))] += $tv->relation_count;
                }
                $array[$key]['total'] += $tv->relation_count;
            }
        }
        foreach ($totalPrevious as $tk => $tv) {
            if ($tv->police_unit_id == $value['id']) {
                $array[$key]['totalPre'] += $tv->relation_count;
            }
        }
        $array[$key]['abs'] = $array[$key]['total']-$array[$key]['totalPre'];
        $array[$key]['perc'] = ($array[$key]['totalPre'] != 0) ? round(($array[$key]['total']/$array[$key]['totalPre']-1)*100) : 0;
        $array[$key]['daysmonth'] = date('t', strtotime($date));
    }

    return $array;
}

function arrMap(object $units, object $total, object $total2): array
{
    foreach ($units as $key => $value) {
        $array[$key]['id'] = $value->id;
        $array[$key]['name'] = $value->name;
        $array[$key]['total'] = 0;
        $array[$key]['total2'] = 0;
    }

    foreach ($array as $key => $value) {
        foreach ($total as $tk => $tv) {
            if ($tv->police_unit_id == $value['id']) {
                $array[$key]['total'] = $tv->total;
            }
        }
        foreach ($total2 as $tk => $tv) {
            if ($tv->police_unit_id == $value['id']) {
                $array[$key]['total2'] = $tv->total;
            }
        }
        $array[$key]['perc'] = ($array[$key]['total'] != 0) ? round(($array[$key]['total2']/$array[$key]['total'])*100) : 0;
    }

    return $array;
}
