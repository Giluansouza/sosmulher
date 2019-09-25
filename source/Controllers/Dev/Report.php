<?php

namespace DevBoot\Controllers\App;

use DevBoot\Repository\OccurrenceRepository;
use DevBoot\Repository\PoliceUnitRepository;
use DevBoot\Repository\AddressRepository;
use DevBoot\Repository\CityRepository;
use DevBoot\Repository\DistrictRepository;
use DevBoot\Repository\UnitCityRepository;
use DevBoot\Repository\TypeOccurrenceRepository;
use DevBoot\Support\Pager;

use DevBoot\Models\Relationship;

class Report extends App
{

    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Diagnose por periodo
     * @param  array  $data
     * @return void
     */
    public function diagnosis(array $data): void
    {
        $filter = [
            'start' => date('Y-m-01'),
            'final' => date('Y-m-d', strtotime('-1 day')),
            'city' => "",
            'unit' => ""
        ];
        $filterPre = [
            'start' => date('Y-m-01', strtotime('-1 year')),
            'final' => date('Y-m-d', strtotime('-1 day, -1 year')),
            'city' => "",
            'unit' => ""
        ];

        $listUnits = (new PoliceUnitRepository)->list();
        $period = $this->oRepository->total($filter, "count(rel.id) as total", [], "total");
        $previous = $this->oRepository->total($filterPre, "count(rel.id) as total", [], "total");

        $weekday = $this->oRepository->total($filter, "dayname(date_fact) as name, count(rel.id) as total", ['name'], "total");

        $units = $this->oRepository->total($filter, "pu.name, count(rel.id) as total", ['occurrences.police_unit_id'], "total");
        $unitsPrevious = $this->oRepository->total($filterPre, "pu.name, count(rel.id) as total", ['occurrences.police_unit_id'], "total");

        $total = [
            'total' => $period[0]->total,
            'tprev' => $previous[0]->total
        ];
        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url('/admin/diagnose'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/reports/diagnosis", [
            'head' => $head,
            'user' => $this->user,
            'total' => $total,
            'units' => $units,
            'unitsPrevious' => $unitsPrevious,
            'weekday' => $weekday,
            'date' => $filter,
            'listUnits' => $listUnits
        ]);
    }

    public function diagnosisFilter(array $data): void
    {
        if (!empty($data['startDate']) && !empty($data['finalDate'])) {
            echo json_encode(["redirect" => url("{$this->user->url}/diagnose/{$data['startDate']}/{$data['finalDate']}")]);
            return;
        }

        $filter = [
            'start' => $data['start'],
            'final' => $data['final'],
            'city' => "",
            'unit' => ""
        ];
        $filterPre = [
            'start' => date('Y-m-d', strtotime('-1 year', strtotime($data['start']))),
            'final' => date('Y-m-d', strtotime('-1 year', strtotime($data['final']))),
            'city' => "",
            'unit' => ""
        ];

        $listUnits = (new PoliceUnitRepository)->list();
        $total = $this->oRepository->countRelationship($filter);
        $totalPrevious = $this->oRepository->countRelationship($filterPre);
        $weekday = $this->oRepository->total($filter, "dayname(date_fact) as name, count(rel.id) as total", ['name'], "total");
        $units = $this->oRepository->countWith($filter, 'occurrences.police_unit_id, count(relationship_people_occurrences.id) AS total', ['occurrences.police_unit_id'], 'total');
        $unitsPrevious = $this->oRepository->countWith($filterPre, 'occurrences.police_unit_id, count(relationship_people_occurrences.id) AS total', ['occurrences.police_unit_id'], 'total');

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url('/dev/diagnose'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/reports/diagnosis", [
            'head' => $head,
            'user' => $this->user,
            'total' => $total,
            'totalPrevious' => $totalPrevious,
            'units' => $units,
            'unitsPrevious' => $unitsPrevious,
            'weekday' => $weekday,
            'date' => $filter,
            'listUnits' => $listUnits
        ]);
    }

    public function cvliExtract(array $data): void
    {
        $filter = [
            'start' => date('Y-m-01'),
            'final' => date('Y-m-d'),
            'unit' => "",
            'city' => "",
            'page' => $data['page']??0,
            'url' => "{$this->user->url}/extrato-cvli/p/"
        ];

        $units = (new PoliceUnitRepository)->list();
        $cities = (new UnitCityRepository)->getUnitCity($filter, 0, false);
        $lists = $this->oRepository->getOccurrences($filter, 10, true);

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url('/dev'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/reports/cvli-extract", [
            'head' => $head,
            'user' => $this->user,
            'units' => $units,
            'lists' => $lists,
            'cities' => $cities,
            'filter' => $filter,
            'paginator' => $this->oRepository->pager()->render()
        ]);
    }

    public function cvliExtractFilter(array $data): void
    {

        if (!empty($data['startDate']) && !empty($data['finalDate'])) {
            echo json_encode(["redirect" => url("dev/extrato-cvli/{$data['unit']}/{$data['city']}/{$data['startDate']}/{$data['finalDate']}")]);
            return;
        }

        $filter = [
            'start' => $data['start'],
            'final' => $data['final'],
            'unit' => $data['unit'],
            'city' => $data['city']
        ];

        $units = (new PoliceUnitRepository)->list();
        $cities = (new CityRepository)->listUnitCity();
        $page = $this->oRepository->count($filter);
        $pager = new Pager(url("/dev/extrato-cvli/{$filter['unit']}{$filter['city']}//{$filter['start']}/{$filter['final']}/p/"));
        $pager->pager($page, 15, ($data['page'] ?? 1));
        $lists = $this->oRepository->list($filter, $pager->limit(), $pager->offset());

        $head = $this->seo->render(
            "Administração - ".CONF_SITE_NAME,
            CONF_SITE_DESC,//descrição do site
            url('/dev'),//link home
            theme("/assets/images/share.jpg")//imagem de compartilhamento
        );

        echo $this->view->render("views/reports/cvli-extract", [
            'head' => $head,
            'user' => $this->user,
            'units' => $units,
            'lists' => $lists,
            'cities' => $cities,
            'filter' => $filter,
            'paginator' => $pager->render()
        ]);
    }

    /**
     * Monitoramento de CVLI
     * @param  array  $data
     * @return void
     */
    public function cvliMonitoring(array $data): void
    {

        $filter = [
            'start' => date('Y-m-01'),
            'final' => date('Y-m-d', strtotime('-1 day')),
            'month' => date('m'),
            'city' => '',
            'unit' => $this->getUnitId,
        ];
        $filterPre = [
            'start' => date('Y-m-01', strtotime('-1 year')),
            'final' => date('Y-m-d', strtotime('-1 day, -1 year')),
            'city' => '',
            'unit' => ''
        ];
        $period = ['start' => date('Y-01-01'), 'final' => date('Y-m-d', strtotime('-1 day')),'city' => '',
            'unit' => ''];
        $previousPeriod = ['start' => date('Y-01-01', strtotime('-1 year')), 'final' => date('Y-m-d', strtotime('-1 day, -1 year')),'city' => '',
            'unit' => ''];

        $units = (new PoliceUnitRepository)->list($this->getUnitId,'CPRN','aisp');
        $cities = (new UnitCityRepository)->getUnitCity($filter, 10, false);

        $total = $this->oRepository->total($filter, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');
        $totalPre = $this->oRepository->total($filterPre, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');
        $year = $this->oRepository->total($period, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');
        $yearPre = $this->oRepository->total($previousPeriod, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');

        $totalDaylePre = $this->oRepository->dayleTable($filterPre);
        $totalDayle    = $this->oRepository->dayleTable($filter);
        $arrDayle = arrDayleTable($units, $totalDayle, $totalDaylePre, $filter['start']);
        $arrDayle = ordena_array($arrDayle, 'name');

        $lists = objUnit($units, $total, $totalPre, $year, $yearPre);

        $head = $this->seo->render(
            CONF_SITE_NAME.' - '.CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url('/dev/monitoramento-cvli'),
            theme("/assets/image/share.jpg")
        );

        echo $this->view->render("views/reports/cvli-monitoring", [
            'head' => $head,
            'user' => $this->user,
            'units' => $units,
            'lists' => $lists,
            'filter' => $filter,
            'period' => $period,
            'arrDayle' => $arrDayle
        ]);
    }

    /**
     * Monitoramento de CVLI com filtro
     * @param  array  $data
     * @return void
     */
    public function cvliMonitoringFilter(array $data): void
    {
        if (!empty($data['startDate']) && !empty($data['finalDate'])) {
            echo json_encode(["redirect" => url("{$this->user->url}/monitoramento-cvli/{$data['month']}/{$data['startDate']}/{$data['finalDate']}")]);
            return;
        }

        $filter = [
            'start' => date("Y-{$data['month']}-01"),
            'final' => date("Y-{$data['month']}-t"),
            'month' => $data['month'],
            'city' => '',
            'unit' => $this->getUnitId,
        ];
        $filterPre = [
            'start' => date("Y-{$data['month']}-01", strtotime('-1 year')),
            'final' => date("Y-{$data['month']}-t", strtotime('-1 year')),
            'city' => '',
            'unit' => ''
        ];
        $period = [
            'start' => $data['start'],
            'final' => $data['final'],
            'city' => '',
            'unit' => ''
        ];
        $previousPeriod = [
            'start' => date('Y-m-d', strtotime('-1 year', strtotime($data['start']))),
            'final' => date('Y-m-d', strtotime('-1 year', strtotime($data['final']))),
            'city' => '',
            'unit' => ''
        ];

        $units = (new PoliceUnitRepository)->list($this->getUnitId,'CPRN','aisp');
        $cities = (new UnitCityRepository)->getUnitCity($filter, 10, false);

        $total = $this->oRepository->total($filter, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');
        $totalPre = $this->oRepository->total($filterPre, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');
        $year = $this->oRepository->total($period, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');
        $yearPre = $this->oRepository->total($previousPeriod, "occurrences.police_unit_id, count(rel.id) as total", ['occurrences.police_unit_id'], 'occurrences.police_unit_id');

        $lists = objUnit($units, $total, $totalPre, $year, $yearPre);

        $totalDaylePre = $this->oRepository->dayleTable($filterPre);
        $totalDayle    = $this->oRepository->dayleTable($filter);
        $arrDayle = arrDayleTable($units, $totalDayle, $totalDaylePre, $filter['start']);
        $arrDayle = ordena_array($arrDayle, 'name');

        $head = $this->seo->render(
            CONF_SITE_NAME.' - '.CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url('/dev/quantitativo-cvli'),
            theme("/assets/image/share.jpg")
        );

        echo $this->view->render("views/reports/cvli-monitoring", [
            'head' => $head,
            'user' => $this->user,
            'units' => $units,
            'lists' => $lists,
            'filter' => $filter,
            'period' => $period,
            'arrDayle' => $arrDayle
        ]);
    }
}
